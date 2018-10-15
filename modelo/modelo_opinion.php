<?php
    /**
    * Obtiene los totales de las noticias por categoria
    *
    * @param int Categoria para obtener el total
    * @return int que contiene el total de las noticias de la categoria del parametro
    */
    function get_opiniones($idNoticia)
    {
        $link = conectar_bd();

        $sql = "SELECT usuarios.*, comentarios.* FROM comentarios INNER JOIN usuarios ON comentarios.idUsuario = usuarios.idUsuario WHERE comentarios.idNoticia = " . $idNoticia; 
        
        $resultados = mysqli_query($link, $sql);	

        $todas_opiniones = array();
	
        while($opinion=mysqli_fetch_assoc($resultados)) {
            $todas_opiniones[] = $opinion;
        }
        
        desconectar_bd($link);

        return $todas_opiniones;
    }
    
    /**
    * Obtiene los totales de las noticias por categoria
    *
    * @param int Categoria para obtener el total
    * @return int que contiene el total de las noticias de la categoria del parametro
    */
    function get_respuestas($idComentario)
    {
        $link = conectar_bd();

        $sql = "SELECT usuarios.*, respuestas.* FROM respuestas INNER JOIN usuarios ON respuestas.idUsuario = usuarios.idUsuario WHERE respuestas.idComentario = " . $idComentario; 
        
        $resultados = mysqli_query($link, $sql);	

        $todas_respuestas = array();
	
        while($respuesta=mysqli_fetch_assoc($resultados)) {
            $todas_respuestas[] = $respuesta;
        }
        
        desconectar_bd($link);

        return $todas_respuestas;
    }
    
    /**
    * Obtiene los totales de las noticias por categoria
    *
    * @param int Categoria para obtener el total
    * @return int que contiene el total de las noticias de la categoria del parametro
    */
    function set_opinion($idNoticia, $idUsuario, $valoracion, $comentario)
    {        
        $link = conectar_bd();

        //Inserto los datos de los campos de registro con Rol=usuario y Ban=False 
        $sql="INSERT INTO `comentarios` (`idNoticia`, `idUsuario`, `Comentario`, `Valoracion`, `Aprobado`) 
            VALUES (" . $idNoticia . ", " . $idUsuario . ", '" . $comentario . "', " . $valoracion . ", b'" . "1" . "');";
        
        //Actualizo la valoracion en la tabla noticias
        if ($link->query($sql) === TRUE) 
        {
            $sql="UPDATE noticias SET valoracion = (SELECT SUM(Valoracion) / COUNT(*) FROM comentarios WHERE IdNoticia = " . $idNoticia . ") WHERE IdNoticia = " . $idNoticia;            
            $link->query($sql);
            
            desconectar_bd($link);			
            return true;		
        } else {
            desconectar_bd($link);
            return false;
        }        
    }
    
    /**
    * Obtiene los totales de las noticias por categoria
    *
    * @param int Categoria para obtener el total
    * @return int que contiene el total de las noticias de la categoria del parametro
    */
    function set_respuesta($idOpinion, $idUsuario, $respuesta)
    {  
        $link = conectar_bd();
         
        $sql = "INSERT INTO `respuestas` (`idComentario`, `idUsuario`, `Comentario`, `Aprobado`) VALUES";
        $sql .= "(" . $idOpinion . ", " . $idUsuario . ", '" . $respuesta . "', 1);";
        
        mysqli_query($link, $sql);	
    
        desconectar_bd($link);
    
        return;                 
    }
    
?>