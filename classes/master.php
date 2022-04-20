<?php
    class Master {
        public function conexion(){
            $host = 'localhost';
            $user = 'root';
            $pass = 'LuisA5841@&';
            $db = 'andic';

            $conexion = mysqli_connect($host,$user,$pass,$db);
            mysqli_set_charset($conexion,'utf8');

            if(!$conexion)
                return 3;
            return $conexion;
        }
    }
