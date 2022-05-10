<?php
require_once "master.php";
error_reporting(E_WARNING);

class Procedures extends Master
{
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
        return "Nan";
    }

    public function deleteRegister($object){
        $con = Master::conexion();
        if ($con == 3)
            return 'err';
        
        $tbl = $object['tbl'];
        $campo = $object['campo'];
        
        $sql = "DELETE FROM $tbl WHERE $campo = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s',$object['id']);
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
            $media = self::getLastAct() + 1 . "." . $data[1];
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
}
