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
}
