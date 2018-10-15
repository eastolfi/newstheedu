<?php
/**
* Obtiene todas las noticias de la tabla
*
* @param void
* @return array[] Array que contiene todas las noticias cargadas
*/	
function get_noticias($categoria, $aprobado)
{
    //Obtengo la conexión a la base de datos de MySQL    
    $link = conectar_bd();
    
    //Recupero todas las noticias aprobadas
    $query = "SELECT IdNoticia, IdCategoria, Titulo, TituloOriginal, Ano, SUBSTRING(Resumen, 1, 250) AS Resumen, ImagenUrl, ";
    $query .= "MetaAutor, MetaEditorial, MetaDirector, MetaProtagonistas, Valoracion, Visitas, FechaAlta, ";
    $query .= "FechaCaducidad, FechaRevision, Aprobado FROM noticias";
        
    if($categoria > 0) 
    {
        $query .= " WHERE idcategoria = " . $categoria;
        if($aprobado == 1) 
            $query .= " AND Aprobado = 1";
    } elseif($aprobado == 1) 
        $query .= " WHERE Aprobado = 1";
    
    $query .= " ORDER BY FechaAlta;";
    
    $resultados = mysqli_query($link, $query);	

    //Creo el array que guardara la informacion de los libros
    $todas_noticias = array();
	
    //Guardo cada libro en un elemento del array    
    while($noticia=mysqli_fetch_assoc($resultados)) {
        $todas_noticias[] = $noticia;
    }

    //Desconectamos la BBDD
    desconectar_bd($link);
	
	//Retorno el array con los libros
    return $todas_noticias;	
}

/**
* Obtiene el detalle de la noticia
*
* @param int Id de la noticia a recuperar
* @return array[] Array que contiene la noticia cargada
*/	
function get_noticia_detalle($id)
{
    $link = conectar_bd();
    
//Recupero todos los libros
    $query = "SELECT IdNoticia, IdCategoria, Titulo, TituloOriginal, Ano, Resumen, ImagenUrl, ";
    $query .= "MetaAutor, MetaAutor, MetaEditorial, MetaDirector, MetaProtagonistas, Valoracion, Visitas, FechaAlta, ";
    $query .= "FechaCaducidad, FechaRevision, Aprobado FROM noticias";
    $query .= " WHERE IdNoticia = " . $id . ";";
    
    $resultados = mysqli_query($link, $query);	

    //Creo el array que guardara la informacion de los libros
    $noticia_detalle = array();
	
    //Guardo cada libro en un elemento del array    
    while($noticia=mysqli_fetch_assoc($resultados)) {
        $noticia_detalle[] = $noticia;
    }

    //var_dump($todas_noticias);

    //Desconectamos la BBDD
    desconectar_bd($link);
	
    //Retorno el array con los libros
    return $noticia_detalle;    
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function get_total_noticias($categoria)
{
    $link = conectar_bd();
    
    $query = "SELECT COUNT(idCategoria) As total FROM `noticias` WHERE idCategoria = " . $categoria . " AND Aprobado = 1";
    
    $resultados = mysqli_query($link, $query);	
    
    while($noticia=mysqli_fetch_assoc($resultados)) {
         $total = $noticia["total"];
    }
    
    desconectar_bd($link);
    
    return $total;
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function get_mas_visitadas_noticias()
{
    $link = conectar_bd();
    
    $query = "SELECT * FROM `noticias` WHERE Aprobado = 1 ORDER BY Visitas DESC LIMIT 5;";
    
    $noticias_mas_visitadas = array();
    $resultados = mysqli_query($link, $query);	
    
    //Guardo cada libro en un elemento del array    
    while($noticia=mysqli_fetch_assoc($resultados)) {
        $noticias_mas_visitadas[] = $noticia;
    }
       
    desconectar_bd($link);
    
    return $noticias_mas_visitadas;
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function get_mas_votadas_noticias()
{
    $link = conectar_bd();
        
    $query = "SELECT idNoticia FROM `comentarios` GROUP BY(idNoticia) ORDER BY COUNT(idNoticia) DESC LIMIT 5;";    
    $noticias_mas_votadas = array();
    $resultados = mysqli_query($link, $query);	
    
    //Guardo cada noticia en un elemento del array    
    while($idsNoticias = mysqli_fetch_assoc($resultados)) {
        $subQuery = "SELECT * FROM `noticias` WHERE idNoticia = " . $idsNoticias["idNoticia"]  . " AND Aprobado = 1";
        $subResultados = mysqli_query($link, $subQuery);
        
        while($noticias = mysqli_fetch_assoc($subResultados)) {
            $noticias_mas_votadas[] = $noticias;
        }        
    }
       
    desconectar_bd($link);
    
    return $noticias_mas_votadas;
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function get_archivo_noticias($mes, $ano)
{
    $link = conectar_bd();
    
    $query = "SELECT IdNoticia, IdCategoria, Titulo FROM noticias WHERE YEAR(FechaAlta) = " . $ano . " AND MONTH(FechaAlta) = " . $mes . " AND Aprobado = 1;";
    $resultados = mysqli_query($link, $query);	    
    $archivo_noticias = array();
	
    //Guardo cada nnoticia en un elemento del array    
    while($noticia = mysqli_fetch_assoc($resultados)) {
        $archivo_noticias[] = $noticia;
    }
    
    desconectar_bd($link);
    
    return $archivo_noticias;
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function get_total_votos($idNoticia)
{
    $link = conectar_bd();
    
    $query = "SELECT COUNT(*) As total FROM `comentarios` WHERE idNoticia = " . $idNoticia;
    
    $resultados = mysqli_query($link, $query);	
    
    while($noticia=mysqli_fetch_assoc($resultados)) {
         $total = $noticia["total"];
    }
    
    desconectar_bd($link);
    
    return $total;   
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function set_incremento_visitas($idNoticia, $ip)
{
    $link = conectar_bd();
        
    $query = "SELECT Visitas + 1 As Visitas FROM noticias WHERE IdNoticia = " . $idNoticia;       
    $resultados = mysqli_query($link, $query);	
    
    while($noticia=mysqli_fetch_assoc($resultados)) {
         $totVisitas = $noticia["Visitas"];
    }
    
    $query="UPDATE noticias SET Visitas = " . $totVisitas . " WHERE IdNoticia = " . $idNoticia;    
    mysqli_query($link, $query);	
    
    desconectar_bd($link);
    
    return;   
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function get_total_noticias_mes_ano($mes, $ano)
{
    $link = conectar_bd();
    
    $query = "SELECT COUNT(*) As total FROM `noticias` WHERE YEAR(FechaAlta) = " . $ano . " AND MONTH(FechaAlta)= " . $mes  . " AND Aprobado = 1";
    
    $resultados = mysqli_query($link, $query);	
    
    while($noticia=mysqli_fetch_assoc($resultados)) {
         $total = $noticia["total"];
    }
    
    desconectar_bd($link);
    
    return $total;   
}

/**
* Obtiene los totales de las noticias por categoria
*
* @param int Categoria para obtener el total
* @return int que contiene el total de las noticias de la categoria del parametro
*/
function set_edit_noticia($noticia_detalle, $actualizacion)
{
    $link = conectar_bd();
    
    $idCategoria = $noticia_detalle['IdCategoria'];
    $titulo = $noticia_detalle['Titulo'] ;
    $tituloOriginal = $noticia_detalle['TituloOriginal'];
    $ano = $noticia_detalle['Ano'];
    $resumen = $noticia_detalle['Resumen'];
    $imgUrl = $noticia_detalle['ImagenUrl'] ;

    $autor = $noticia_detalle['MetaAutor'];
    $editorial = $noticia_detalle['MetaEditorial'];
    $director = $noticia_detalle['MetaDirector'] ;
    $protagonistas = $noticia_detalle['MetaProtagonistas'];

    $aprobado = $noticia_detalle['Aprobado'];
    
    if($aprobado == "true")
        $chkAprobado = 1;
    else
        $chkAprobado = 0;
   
    if($actualizacion == 0) {
        $query = "INSERT INTO `noticias` (`IdCategoria`, `Titulo`, `TituloOriginal`, `Ano`, `Resumen`, `ImagenUrl`, `MetaAutor`, `MetaEditorial`, `MetaDirector`, `MetaProtagonistas`, `Valoracion`, `Visitas`, `Aprobado`) VALUES ";
        $query .= "(1, " . $idCategoria . ", '" . $titulo . "', '" . $tituloOriginal . "', " . $ano . ", '" . $resumen . "', '" . $imgUrl . "', '" . $autor . "', '" . $editorial . "', '" . $director . "', '" . $protagonistas . "', '0.0', 0, 1)";
    } else {
        $idNoticia = $noticia_detalle['IdNoticia'];
        
        $query = "UPDATE `noticias` SET `Titulo` = '" . $titulo . "',`TituloOriginal` = '" . $tituloOriginal . "',`Ano` = " . $ano . ",`Resumen` = '" . $resumen . "',`ImagenUrl` = '" . $imgUrl . "',`MetaAutor` = '" . $autor . "',`MetaEditorial` = '" . $editorial . "',`MetaDirector` = '" . $director . "',`";
        $query .= "MetaProtagonistas` = '" . $protagonistas . "',`Valoracion` = '0.0',`Visitas` = 0, `FechaRevision` = '0000-00-00',`Aprobado` = " . $chkAprobado . " WHERE `noticias`.`IdNoticia` = " . $idNoticia . ";";
    }
    
    mysqli_query($link, $query);
    
    desconectar_bd($link);
}
?>
