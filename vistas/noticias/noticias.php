<?php 
/**
*
* Vista principal de noticias. Muestra las novedades
*
* @author Eduardo Astolfi
* @copyright Copyright © 2018 
* @version 1.0.0
*/
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
		
    <title>TIME TRAVEL. Todas las novedades en libros y películas sobre viajes en el tiempo</title>
          
    <body cz-shortcut-listen="true">
        <!-- HEADER -->		
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
		        
       <main id="single" class="container" role="main">
            <!-- MIGA DE PAN -->
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= __URL__ . '/vistas/presentacion.php'; ?>">Presentación</a></li>	
                            <?php
                                if($cat == null || $cat == 0) {
                                    echo "<li class='breadcrumb-item active' aria-current='page'>Noticias</li>";
                                }
                                elseif($cat > 0) {
                                    echo "<li class='breadcrumb-item'><a href='" . __URL__ . "'/index.php/noticias';>Noticias</a></li>";
                                    
                                    if($cat == 1) {
                                        echo "<li class='breadcrumb-item active' aria-current='page'>Libros</li>";
                                    }
                                    else if($cat == 2) {
                                        echo "<li class='breadcrumb-item active' aria-current='page'>Películas</li>";
                                    }
                                }
                            ?>
                        </ol>
                    </nav>
                </div>
            </div>	   
            <!-- COLUMNA DE LA IZQUIERDA -->
            <div class="row">
                <div id="sidebar_left" class="col-md-12 col-lg-3 order-2 order-lg-1">					
                    <!-- CARGO EL MODULO DE ARCHIVO -->
                    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/modulos/archivo.php'); ?>
					
                    <!-- CARGO EL MODULO DE CATEGORIAS -->
                    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/modulos/categorias.php'); ?>                        				
                </div>

                <!-- COLUMNA DEL CENTRO 					 -->
                <div class="col-md-12 col-lg-6 order-1 order-lg-2">
                    <?php
                        $paramCategoria = "&cat=" . $cat;                                               
                    ?>
                    <p align="right" class="tipo-vista-noticias">
                        <a href="<?= __URL__ . '/index.php/noticias?vw=0' . $paramCategoria ?> ">                        
                          <img src="<?= __URL__ . '/imagenes/default.png' ?> " alt="Vista de noticias por defecto" title="Vista de noticias por defecto">
                        </a>
                        <a href="<?= __URL__ . '/index.php/noticias?vw=1' . $paramCategoria ?> ">
                          <img src="<?= __URL__ . '/imagenes/th.png'; ?> " alt="Vista de noticias como miniaturas" title="Vista de noticias como miniaturas">
                        </a>
                        <a href="<?= __URL__ . '/index.php/noticias?vw=2' . $paramCategoria ?>">
                          <img src="<?= __URL__ . '/imagenes/list.png'; ?> " alt="Vista de noticias como lista" title="Vista de noticias como lista">
                        </a>
                    </p>
					
                    <!-- LISTA POR DEFECTO DE NOTICIAS -->                   
                    <?php
                        if($vw == 0)
                            require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/noticias/noticiasdefault.php'); 
                        elseif($vw == 1)
                            require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/noticias/noticiasth.php');
                        elseif($vw == 2)
                            require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/noticias/noticiaslst.php');
                     ?>                                         
                    <!-- FIN LISTA POR DEFECTO DE NOTICIAS -->
                    
                </div>

                <!-- COLUMNA DE LA DERECHA -->
                <div id="sidebar_right" class="col-md-12 col-lg-3 order-3 order-lg-3">
                   <!-- CARGO EL MODULO DE LAS MAS VOTADAS -->
                    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/modulos/votadas.php'); ?>

					<!-- CARGO EL MODULO DE LAS MAS COMENTADAS -->
                    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/modulos/visitadas.php'); ?>

                    <!-- CARGO EL MODULO DE SUSCRIPCION AL BOLETIN -->
                    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/suscripcion/suscripcion.php'); ?>
                </div>
            </div>

            <br/>
            <br/>
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