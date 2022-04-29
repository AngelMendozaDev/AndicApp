<?php
require_once "master.php";

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

    public function getPicture($person){
        $conn = Master::conexion();
        if ($conn == 3)
            return 'err';
        
        $query = $conn->prepare('SELECT picture FROM angeles WHERE id_angel = ?');
        $query->bind_param('s', $person);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($result->num_rows > 0){
            $data = $result->fetch_assoc();
            return $data['picture'];
        }

        return -1;
    }
}
