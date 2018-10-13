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
</head>
          
    <body cz-shortcut-listen="true">
        <!-- HEADER -->		
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
		        
        <?php
            if($noticia[0]['IdCategoria'] == 1) {
                $descripcion = "Libro";
                $imagen = "/imagenes/libro.png";
                $titulo = $noticia[0]['Titulo'] . " - " .  $noticia[0]['MetaAutor'];
            } else if($noticia[0]['IdCategoria'] == 2) {
                $descripcion = "Película";
                $imagen = "/imagenes/peli.png";
                $titulo = $noticia[0]['Titulo'] . " (" . $noticia[0]['Ano'] . ")";
            }
            
            //Obtengo el total de votos de esta noticia
            $totalVotos = get_total_votos($noticia[0]['IdNoticia']);
            if($totalVotos == 1) $litTotalVotos = "(" . $totalVotos . " voto)";
            else $litTotalVotos = "(" . $totalVotos . " votos)";
        ?>
        
       <main id="single" class="container" role="main">
            <!-- MIGA DE PAN -->
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= __URL__ . '/vistas/presentacion.php'; ?>">Presentación</a></li>	
                            <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php/noticias'; ?>">Noticias</a></li>	


                            <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php/noticias?cat=' . $noticia[0]['IdCategoria'] ?>"><?= $descripcion . 's' ?></a></li>
                            <li class='breadcrumb-item active' aria-current='page'><?= $titulo ?></li>                            						
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
                    <!-- DETALLE DE LA NOTICIA -->  
                    <div class="content">
                        <h1 style="font-size: 1.5em">
                        <img src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
                        <?= $titulo ?>                                   
                        </h1>
                        <p style="text-align: center;" >
                            <img class="aligncenter size-full wp-image-6330" src="<?= __URL__ . $noticia[0]['ImagenUrl']; ?> " alt="<?= $noticia[0]['Titulo'] ?>" title="<?= $noticia[0]['Titulo'] ?>" width="150" height="225">
                        </p>
                        <p style="text-align: left;" >
                            <b><font color="#0085CF">Titulo original:&nbsp;</font></b> <?= $noticia[0]['TituloOriginal'] ?>
                        </p>
                        
                        <p style="text-align: left;" >
                            <b><font color="#0085CF">Año:&nbsp;</font></b> <?= $noticia[0]['Ano'] ?>
                        </p>
                        
                        <?php
                            if($noticia[0]['IdCategoria'] == 1) { ?>
                                <p style="text-align: left;" >
                                    <b><font color="#0085CF">Editorial:&nbsp;</font></b> <?= $noticia[0]['MetaEditorial'] ?>
                                </p>
                                
                        <?php  } else if($noticia[0]['IdCategoria'] == 2) { ?>
                                <p style="text-align: left;" >
                                    <b><font color="#0085CF">Director:&nbsp;</font></b> <?= $noticia[0]['MetaDirector'] ?>
                                </p>
                                <p style="text-align: left;" >
                                    <b><font color="#0085CF">Protagonistas:&nbsp;</font></b> <?= $noticia[0]['MetaProtagonistas'] ?>
                                </p>
                        <?php }
                        ?>
            
                        <p style="text-align: left"><b><font color="#0085CF">Resumen:&nbsp;</font></b>                        
                        <?= $noticia[0]['Resumen'] ?></p>
                        
                        <p  align="left">
                        <b><font color="#0085CF">Valoración: &nbsp;</font></b> <img width="72" height="15" src="/imagenes/val<?=                                 
                                round($noticia[0]['Valoracion']) 
                                        ?>.jpg" alt="Valoración" title="<?= $noticia[0]['Valoracion'] ?> sobre 5"><?= $litTotalVotos ?>
                        </p>
                    </div>				                    
                        
                    
                    <!-- COMENTARIO Y OPINIONES -------------------------------------------------------------------------- -->                                        
                    <br/>
                    
                    <?php if($estaLogin) { 
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/foroopinion/opiniones.php');
                    
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/foroopinion/comentario.php');
                    } else { ?>
                        <div class="author_post" style="text-align: center;">
                            <h3 style="text-align: center;">No estas registrado</h3>
                             Si quieres valorar la noticia y leer o escribir comentarios, es necesario hacer <a href="<?= __URL__ . '/index.php/login'; ?>">login</a> o <a href="<?= __URL__ . '/index.php/registro'; ?>">regístrarse</a>
                        </div>
                    <?php
                    }
                    ?>
                  
                    <!-- FIN COMENTARIO Y VALORACION ---------------------------------------------------------------------- -->                                       
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