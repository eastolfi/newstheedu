<?php 
    if($_SERVER['SERVER_NAME'] == "localhost") 
        define('__URL__', 'http://localhost:8081');
    elseif($_SERVER['SERVER_NAME'] == "news.theedu") 
        define('__URL__', 'http://news.theedu:8081');
    else 
        define('__URL__', 'http://news.theedu.es'); 
    
    if (empty($_SESSION['sesion_time'])) { 
        session_start();        
        $_SESSION['sesion_time'] = time();
        
        if (isset($_COOKIE["login"])) {
            //Obtener los datos para mantener en la sesion
            $_SESSION['sesion_rol'] = $_COOKIE["cookie_rol"];
            $_SESSION['sesion_user'] = $_COOKIE["cookie_user"];
        }        
    } else if($_SESSION['sesiom_time'] < time() - 180) {
        session_start();
        session_destroy();        
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
    
    <!-- INCLUDES HEADER -->  
    <script type="text/javascript" charset="utf-8" src="../jquery/jquery-1.4.2.js"></script>
    <script type="text/javascript" charset="utf-8" src="../jquery/jquery.ui.core.js"></script>
    <script type="text/javascript" charset="utf-8" src="../jquery/jquery.ui.widget.js"></script>
    <script type="text/javascript" charset="utf-8" src="../jquery/jquery.welslider.js"></script>
    <link rel="stylesheet" type="text/css" href="../estilos/welslider.css"  media="screen" charset="utf-8" />
	
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $("#mygallery").welSlider({
                    autoSlide: 3000
            });
        }); 
    </script>
	
    <title>TIME TRAVEL. Blog de novedades en libros y peliculas sobre viajes en el tiempo </title>	
	<body cz-shortcut-listen="true">
            <!-- HEADER -->		
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
            <!-- FIN HEADER -->
		
            <main id="single" class="container" role="main">			
                <!-- PRESENTACION ------------------------------------------------------>		
                <div class="contenedor">
                    <h3 id="comments" align="center">El blog que te presenta todas las novedades en libros y películas sobre viajes en el tiempo</h3>
                </div>

                <!-- ---------------------------------------- 
                <p><img class="aligncenter size-full wp-image-6330" src="imagenes/gallimg2.jpg" alt="Cuadro de Aldo Astolfi" width="800" height="172"></p>						
                -->

                <br/>
                <div class="contenedor" align="center">
                    <ul id="mygallery" width="100%">
                        <li><img style="width:100%;"  src="<?= __URL__ . '/imagenes/slider_01.jpg'; ?>" alt="" width="873" height="518" ></li> 
                        <li><img style="width:100%;" src="<?= __URL__ . '/imagenes/slider_02.jpg'; ?>" alt="" width="873" height="518"></li> 
                        <li><img style="width:100%;" src="<?= __URL__ . '/imagenes/slider_03.jpg'; ?>" alt="" width="873" height="518"></li> 
                    </ul>
                </div>
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