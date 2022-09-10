<?php
require_once "master.php";
error_reporting(E_WARNING | E_ERROR);

class Procedures extends Master
{
    public function generatePass()
    {
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ0123456789';
        $long = 10;
        $pass = substr(str_shuffle($caracteres), 0, $long);
        return $pass;
    }
    public function login($us, $pass)
    {
        $conn = Master::conexion();
        if ($conn == 3)
            return 'err';

        $query = $conn->prepare('SELECT p.id_p, p.nombre, p.app, a.perfil FROM persona AS p INNER JOIN angeles AS a ON a.id_angel = p.id_p WHERE p.correo = ? AND a.pass = ?');
        $query->bind_param('ss', $us, $pass);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0)
            return $result;

        return -1;
    }

    public function getPicture($person)
    {
        $conn = Master::conexion();
        if ($conn == 3)
            return 'err';

        $query = $conn->prepare('SELECT picture FROM angeles WHERE id_angel = ?');
        $query->bind_param('s', $person);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['picture'];
        }

        return -1;
    }

    public function getCols($code)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('SELECT c.n_registro, c.col, c.mun, e.estado_n FROM cp_col AS c INNER JOIN estado AS e ON e.id_estado = c.estado WHERE c.cp = ?');
        $query->bind_param('s', $code);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0)
            return $result->fetch_all();
        return -1;
    }

    public function deleteRegister($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $tbl = $object['tbl'];
        $campo = $object['campo'];

        $sql = "DELETE FROM $tbl WHERE $campo = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $object['id']);
        $result = $query->execute();
        $query->close();
        return $result;
    }

    /**************************
        Actions Crud
     */
    public function getActions()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("select * from getAllActions");
        $query->execute();
        $result = $query->get_result();
        $query->close();

        return $result;
    }

    public function getAction($action)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("SELECT * FROM acciones WHERE id_accion = ?");
        $query->bind_param('s', $action);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return "Nan";
    }

    public function setAction($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        if ($object['multimedia'] == 'N') {
            $media = "NoImage";
        } else {
            $nameFoto = $_FILES['media']['name'];
            $data = explode(".", $nameFoto);
            $media = self::getLastAct() + 1 . "." . $data[1];
        }

        $query = $con->prepare("CALL newAction(?,?,?,?,?)");
        $query->bind_param('sssss', $object['año'], strtoupper($object['title']), $object['multimedia'], $media, $object['coment']);
        $response = $query->execute();
        $query->close();
        return $response;
    }

    public function updateAction($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        if ($object['multimedia'] == 'N') {
            $media = "NoImage";
        } else {
            $nameFoto = $_FILES['media']['name'];
            $data = explode(".", $nameFoto);
            $media = $object['folioAction'] . "." . $data[1];
        }

        $query = $con->prepare("CALL updateAction(?,?,?,?,?,?)");
        $query->bind_param('ssssss', $object['año'], strtoupper($object['title']), $object['multimedia'], $media, $object['coment'], $object['folioAction']);
        $response = $query->execute();
        $query->close();
        return $response;
    }

    public function getLastAct()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("SELECT *  FROM getLastAct");
        $query->execute();
        $data = $query->get_result()->fetch_assoc();
        $query->close();
        return $data['id_accion'];
    }


    /***********************
     * *** CRUD EVENTOS
     ********************************************/
    public function getEvents()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("select * from getAllEvents");
        $query->execute();
        $result = $query->get_result();
        $query->close();

        return $result;
    }

    public function getAgenda()
    {
        $colores = array("#52BE80", "#3498DB", "#8E44AD", "#1ABC9C");
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("select * from getAllEvents");
        $query->execute();
        $result = $query->get_result();
        $cont = 0;
        while ($data = $result->fetch_assoc()) {
            $aux = explode(" ", $data['fecha_inicio']);
            $aux2 = explode(" ", $data['fecha_final']);
            $json[] = array(
                "id" => $data['id_evento'],
                "start" => $aux[0] . "T" . $aux[1],
                "end" => $aux2[0] . "T" . $aux2[1],
                "title" => $data['titulo'],
                "color" => $colores[$cont]
            );
            if ($cont >= 3)
                $cont = 0;
            else
                $cont++;
        }
        $query->close();

        return $json;
    }

    public function getEvent($event)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("SELECT * FROM evento WHERE id_evento = ?");
        $query->bind_param('s', $event);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return "Nan";
    }

    public function setEvent($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $nameFoto = $_FILES['picture']['name'];
        $data = explode(".", $nameFoto);
        $media = self::getLastEvent() + 1 . "." . $data[1];

        $auxDate = explode("T", $object['dateStart']);
        $dateStart = $auxDate[0] . " " . $auxDate[1];

        $auxDate = explode("T", $object['dateEnd']);
        $dateEnd = $auxDate[0] . " " . $auxDate[1];

        $registro = !isset($object['register']) ? 0 : 1;

        $query = $con->prepare("CALL newEvent(?,?,?,?,?,?,?)");
        $query->bind_param('sssssss', strtoupper($object['titleEvent']), $dateStart, $dateEnd, $object['horario'], $media, $registro, $object['textEvent']);
        $response = $query->execute();
        $query->close();
        return $response;
    }

    public function updateEvent($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $nameFoto = $_FILES['picture']['name'];
        $data = explode(".", $nameFoto);
        $media = $object['idEvent'] . "." . $data[1];

        $auxDate = explode("T", $object['dateStart']);
        $dateStart = $auxDate[0] . " " . $auxDate[1];

        $auxDate = explode("T", $object['dateEnd']);
        $dateEnd = $auxDate[0] . " " . $auxDate[1];

        $registro = !isset($object['register']) ? 0 : 1;

        $query = $con->prepare("CALL updateEvent(?,?,?,?,?,?,?,?)");
        $query->bind_param('ssssssss', strtoupper($object['titleEvent']), $dateStart, $dateEnd, $object['horario'], $media, $registro, $object['textEvent'], $object['idEvent']);
        $response = $query->execute();
        $query->close();
        return $response;
    }

    public function getLastEvent()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        $query = $con->prepare("SELECT *  FROM getLastEvent");
        $query->execute();
        $data = $query->get_result()->fetch_assoc();
        $query->close();
        return $data['id_evento'];
    }

    /**********************
     *  Comunity
     ********************************/
    public function existPerson($number, $mail)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('SELECT id_p FROM persona WHERE correo = ? OR correo = ?');
        $query->bind_param('ss', $mail, $number);
        $query->execute();
        $response = $query->get_result();

        $query->close();

        if ($response->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function setPerson($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        if (self::existPerson($object['phone'], $object['mail']) == true) {
            return -1;
        }

        $query = $con->prepare("call newPerson(?,?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param('sssssssssss', $object['name'], $object['app'], $object['apm'], $object['sex'], $object['date'], $object['mail'], $object['phone'], $object['street'], $object['cp'], $object['pass'], $object['perfil']);
        $response = $query->execute();

        $query->close();

        return $response;
    }

    public function updatePerson($object)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("call updatePerson(?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param('ssssssssss', $object['name'], $object['app'], $object['apm'], $object['sex'], $object['date'], $object['mail'], $object['phone'], $object['street'], $object['cp'], $object['person']);
        $response = $query->execute();

        $query->close();

        return $response;
    }

    public function getPersons()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('SELECT * FROM getAllPerson');
        $query->execute();
        $data = $query->get_result();

        $query->close();

        return $data;
    }

    public function getComunity()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('SELECT * FROM getComunity');
        $query->execute();
        $data = $query->get_result();

        $query->close();

        return $data;
    }

    public function getPerson($folio)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("SELECT p.*, a.pass, a.picture, a.perfil, d.calle, d.cp as col, c.cp, c.mun, e.estado_n FROM persona AS p INNER JOIN angeles AS a ON a.id_angel = p.id_p INNER JOIN domicilio AS d ON d.id_dom = p.id_p INNER JOIN cp_col AS c ON d.cp = c.n_registro INNER JOIN estado as e ON e.id_estado = c.estado WHERE p.id_p = ?");
        $query->bind_param('s', $folio);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();

        $query->close();

        return $result;
    }

    public function setImage($image, $person)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("CALL updateImage(?,?)");
        $query->bind_param('ss', $image, $person);
        $response = $query->execute();

        $query->close();

        return $response;
    }

    public function getImage($person)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('SELECT picture FROM angeles WHERE id_angel = ?');
        $query->bind_param('s', $person);
        $query->execute();
        $response = $query->get_result();

        $query->close();

        return $response->fetch_assoc();
    }

    public function deletePerson($person)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('CALL deletePerson(?)');
        $query->bind_param('s', $person);
        $response = $query->execute();

        $query->close();

        return $response;
    }


    /****************************
     * Convenios
     *****************************************************/

    public function existInts($clave, $phone)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("SELECT clave FROM institucion WHERE clave = ? OR phone = ?");
        $query->bind_param('ss', $clave, $phone);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0)
            return true;

        return false;
    }

    public function setInst($data)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        if (self::existInts(strtoupper($data['clave']), $data['phone']) == false) {
            $query = $con->prepare('INSERT INTO institucion (clave,nombre_ins, tipo_ins, repre, sub, phone, direc) VALUES (?,?,?,?,?,?,?)');
            $query->bind_param('sssssss', strtoupper($data['clave']), strtoupper($data['name_ins']), $data['tipo_ins'], strtoupper($data['jefe']), strtoupper($data['repre']), $data['phone'], strtoupper($data['dir']));
            $res = $query->execute();

            $query->close();

            if (isset($data['servicio'])) {
                for ($i = 0; $i < count($data['servicio']); $i++) {
                    $query = $con->prepare('INSERT INTO servicios (inst, service) VALUES (?,?)');
                    $query->bind_param('ss', strtoupper($data['clave']), strtoupper($data['servicio'][$i]));
                    $res = $query->execute();
                }
            }
            $query->close();
        } else {
            $res = -1;
        }

        return $res;
    }

    public function getInstituciones(){
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        
        $query = $con->prepare("SELECT * FROM institucion");
        $query->execute();
        $res = $query->get_result();

        $query->close();

        return $res;
    }

    public function getInstitucion($data){
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        
        $query = $con->prepare("SELECT * FROM institucion where clave = ?");
        $query->bind_param('s',$data);
        $query->execute();
        $res = $query->get_result();

        $query->close();
        if($res->num_rows > 0){
            //return $res->fetch_assoc();
            $obj = array(
                'info' => $res->fetch_assoc(),
                'serv' => self::getServices($data)
            );

            return $obj;
        }

        return $res;
    }

    public function getServices($clave){
        $con = Master::conexion();
        if($con == 3)
            return 'err';
        
        $query = $con->prepare("SELECT registro_c, service FROM servicios WHERE inst = ?");
        $query->bind_param('s',$clave);
        $query->execute();
        $aux = $query->get_result();
        while($data = $aux->fetch_assoc()){
            $json[] = array(
                "id" => $data['registro_c'],
                "serv" => $data['service']
            );
        }

        $query->close();

        return $json;
    }


    


    /******************************
     * Practicas
     ************************************************/
    public function serchSchool($data)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("SELECT escuela FROM practicas WHERE escuela LIKE '%$data%' GROUP BY escuela");
        $query->execute();

        $res = $query->get_result();

        if ($res->num_rows > 0) {
            return $res->fetch_all();
        }
        return "...";
    }

    public function serchCarrera($data)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("SELECT carrera FROM practicas WHERE carrera LIKE '%$data%' GROUP BY carrera");
        $query->execute();

        $res = $query->get_result();

        if ($res->num_rows > 0) {
            return $res->fetch_all();
        }
        return "...";
    }

    public function newResidente($object)
    {
        $pass = self::generatePass();
        $tipo = 3;
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("CALL newResidente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param('sssssssssssssss', strtoupper($object['nombre']), strtoupper($object['app']), strtoupper($object['apm']), $object['sex'], $object['nacimiento'], $object['mail'], $object['phone'], strtoupper($object['calle']), $object['colonia'], $pass, $tipo, strtoupper($object['escuela']), strtoupper($object['carrera']), $object['grado'], $object['tram']);
        $res = $query->execute();
        $query->close();

        return $res;
    }

    public function getPracticas()
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare('SELECT * FROM getAllPracticas');
        $query->execute();
        $res = $query->get_result()->fetch_all();

        $query->close();

        return $res;
    }

    public function aceptado($obj)
    {
        $con = Master::conexion();
        if ($con == 3)
            return 'err';

        $query = $con->prepare("UPDATE practicas SET estado = ?, inicio = ?, fin = ? WHERE id_servicio = ?");
        $query->bind_param('ssss', $obj['edo'], $obj['inicio'], $obj['fin'], $obj['folio']);
        $res = $query->execute();

        $query->close();

        return $res;
    }
}
