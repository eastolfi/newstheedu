<?php
    /**
    * @author Eduardo Astolfi
    * @param void
    * @return  $link Devuelve el objeto conexion
    */
    function conectar_bd()
    {
        //Conexión con la base de datos;	
//        if($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "news.theedu")
          $link = mysqli_connect('127.0.0.1', 'otro', 'otro', 'theedunews');	
//        elseif($_SERVER['SERVER_NAME'] == "news.theedu.es") {                    
//            $host_name = 'db729732652.db.1and1.com';
//            $database = 'db729732652';
//            $user_name = 'dbo729732652';
//            $password = 'tareaglobaldwes';
//            $link = mysqli_connect($host_name, $user_name, $password, $database);
//        }
        
        /*
        $host_name = 'localhost';
        $database = 'id7339734_theedunews';
        $user_name = 'id7339734_edu1200';
        $password = 'indiana123';
        $link = mysqli_connect($host_name, $user_name, $password, $database);
        */

        mysqli_set_charset($link, "utf8");

        return $link;
    }

    /**
    *@author Eduardo Astolfi
    *@param conexion $link Conexion establecida con MySQL
    *@return void
    */
    function desconectar_bd($link)
    {
        //Desconexión con la base de datos;
        mysqli_close($link);
    }
?>

