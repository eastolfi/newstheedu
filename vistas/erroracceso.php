<?php 
    if($_SERVER['SERVER_NAME'] == "localhost") 
        define('__URL__', 'http://localhost:8081');
    elseif($_SERVER['SERVER_NAME'] == "news.theedu") 
        define('__URL__', 'http://news.theedu:8081');
    else 
        define('__URL__', 'http://news.theedu.es'); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
        
    <title>TIME TRAVEL. Blog de novedades en libros y peliculas sobre viajes en el tiempo</title>	
	<body cz-shortcut-listen="true">
            <!-- HEADER -->		
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
            <!-- FIN HEADER -->
		
            <main id="single" class="container" role="main">	
                <br/>
                <br/>
                <br/>
                
                <div class="contenedor">
                    <h3 id="comments" align="center">No dispone de los permisos necesarios para acceder a la seccion solicitada.<br />Sentimos las molestias.</h3>
                </div>

                <br/>
                <br/>
                <br/>
                <br/>
                
                <!-- PIE -->		
                <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/aceptacookie.php'); ?> 
                <!-- FIN PIE -->
			
	   </main>		
		<!-- PIE -->		
		<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/pie.php'); ?> 
		<!-- FIN PIE -->
		
        </body>
</html>

