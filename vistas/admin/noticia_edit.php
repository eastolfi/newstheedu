<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
				
    <title>TIME TRAVEL. Administración de noticias</title>	
    <script type="text/javascript">
        function muestraEditaLibro() {
            var divLibro = document.getElementById("divLibro");
            divLibro.style.display = "block";
        }
        
        function muestraEditaPelicula() {
            var divPelicula = document.getElementById("divPelicula");
            divPelicula.style.display = "block";
        }        
        
        function cambiaPaneles() {
            var divLibro = document.getElementById("divLibro");
            var divPeli = document.getElementById("divPelicula");
         
            var drop = document.getElementById("categoria");
            var valor = drop.options[drop.selectedIndex].value;
            
            if(valor == "1") {
                divLibro.style.display = "block";
                divPeli.style.display = "none";
            }
            else if(valor == "2") {
                divLibro.style.display = "none";
                divPeli.style.display = "block";                
            } 
            else {
                divLibro.style.display = "none";
                divPeli.style.display = "none";                
            }            
        }
        
        function ponerImagen() {
            var divImg = document.getElementsByClassName("file-caption-name")[0];
            var opcion = '<?php echo $editNoticia;?>';
            
            if(opcion) {
                var imagen = '<?php echo __URL__ . $noticia_detalle[0]['ImagenUrl'];?>';
                divImg.innerHTML = "<img class='kv-preview-data file-preview-image' src='" + imagen + "'>";
            }
            else {
                var imagenVacia = '<?php echo __URL__ . '/imagenes/vacio.png' ?>';
                divImg.innerHTML = "<img class='kv-preview-data file-preview-image' src='" + imagenVacia + "'>";
            }
              
            var divAspa = document.getElementsByClassName("close fileinput-remove text-right")[0];  
            divAspa.innerHTML = "";                                                  
        }
        
        function validarEditaNoticia() {
            var divImg = document.getElementsByClassName("file-caption-name")[0];
            var originalImg = '<?php echo $noticia_detalle[0]['ImagenUrl'];?>';
            var opcion = '<?php echo $editNoticia;?>';
            
            var divChk = document.getElementById("chkNoticiaActiva");
            var hidChk = document.getElementById("chkEstado");
            hidChk.value = divChk.checked;
            
            if(divImg.innerHTML.indexOf("vacio.png") !== -1) {                
                //Es un nuevo documento y no se ha puesto imagen
                return false;
            } else if(divImg.innerHTML.indexOf(originalImg) !== -1) {
                //Esta en edicion y no ha cambiado la imagen
                //var divImg = document.getElementsByClassName("file-caption-name")[0];
                //document.getElementById("path_imagen").value = "";  
                document.getElementById("datos_imagen").value = "";
                return true;
            } else {                
                //Se ha cambiado la imagen
                var datImg = document.getElementsByClassName("file-preview-image")[0].src;
                document.getElementById("datos_imagen").value = datImg;
                var divImg = document.getElementsByClassName("file-caption-name")[0];
                document.getElementById("path_imagen").value = "/imagenes/noticias/" + divImg.innerHTML;                
            }
       }
  </script>
</head>
    
    <body cz-shortcut-listen="true" onload="ponerImagen()">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php/admin_noticias'; ?>">Administración de noticias</a></li>
                    <?php
                        if($editNoticia)
                            echo "<li class='breadcrumb-item active' aria-current='page'>Editar noticia</li></ol></nav></div>";                            
                        else
                            echo "<li class='breadcrumb-item active' aria-current='page'>Nueva noticia</li></ol></nav></div>";
                    ?>
            </div>
            
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <?php
                        if($editNoticia) {
                            $estadoAprobado = "";
                            
                             if($noticia_detalle[0]['IdCategoria'] == 1) {                                
                                echo "<h3 class='omb_authTitle'>Editar libro</h3>";                                
                             } else {
                                 echo "<h3 class='omb_authTitle'>Editar película</h3>";
                             }
                             if($noticia_detalle[0]['Aprobado'] == 1) $estadoAprobado = "checked";
                             else $estadoAprobado = "unchecked";
                        }
                        else {
                            echo "<h3 class='omb_authTitle'>Nueva noticia</h3>";                                                    
                            $estadoAprobado = "checked";
                        }
                    ?>                                                                           
                    
                      <div class="row omb_row-sm-offset-3" >
                        <div class="col-xs-12 col-sm-6" >	                            
                            <form class="comment-form" name="frmEditNoticia" id="frmEditNoticia" onsubmit="return validarEditaNoticia();" method="POST">                                
                                <?php
                                    if(!$editNoticia) { ?>                                       
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select name="categoria" id="categoria" style="margin-left: 10px;width:520px;font-size: 1.3em" onchange="cambiaPaneles();">					
                                                <option value="0">Selecciona una categoría</option>				 										
                                                <option value="1">Libro</option>		
                                                <option value="2">Pelicula</option>		
                                            </select>
                                        </div>
                                        <br/>
                                     <?php }  ?>                                                                                              
                                       
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="chkNoticiaActiva" id="chkNoticiaActiva" <?= $estadoAprobado ?>>
                                    <label class="custom-control-label" style="font-size: 1.3em;" for="chkNoticiaActiva" >&nbsp;Noticia aprobada</label>
                                </div>
                                <br />
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                    <input id="titulo" type="text" class="form-control" name="titulo" placeholder="Título" value="<?= $noticia_detalle[0]['Titulo'] ?>" required> 
                                </div>
                                <br/>
                                
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                    <input id="tituloOriginal" type="text" class="form-control" name="tituloOriginal" placeholder="Título original" value="<?= $noticia_detalle[0]['TituloOriginal'] ?>" required> 
                                </div>
                                <br/>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input id="ano" type="text" class="form-control" name="ano" placeholder="Año" value="<?= $noticia_detalle[0]['Ano'] ?>" required> 
                                </div>
                                <br/>

                                <div id="divLibro" style="display: none;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="autor" type="text" class="form-control" name="autor" placeholder="Autor" value="<?= $noticia_detalle[0]['MetaAutor'] ?>"> 
                                        </div>
                                        <br/>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                            <input id="editorial" type="text" class="form-control" name="editorial" placeholder="Editorial" value="<?= $noticia_detalle[0]['MetaEditorial'] ?>"> 
                                        </div>
                                        <br/>
                                </div>
                                
                                <div id="divPelicula" style="display: none;">                                
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="director" type="text" class="form-control" name="director" placeholder="Director" value="<?= $noticia_detalle[0]['MetaDirector'] ?>"> 
                                    </div>
                                    <br/>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <input id="protagonistas" type="text" class="form-control" name="protagonistas" placeholder="Protagonistas" value="<?= $noticia_detalle[0]['MetaProtagonistas'] ?>"> 
                                    </div>
                                    <br/>                                        
                                </div>
                                
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa fa-keyboard-o"></i></span>                                        
                                    <textarea style="margin-left: 10px;font-size: 1.3em;" placeholder="Resumen" id="resumen" name="resumen" cols="100" rows="8" maxlength="65525" required="required"><?= $noticia_detalle[0]['Resumen'] ?></textarea>
                                </div>
                                <br/>
                                
                                <span class="input-group-addon"><i class="fa fa-photo"></i></span>
                                <input id="file-2" data-keyboard="false" placeholder="Imagen..." data-show-upload="false" data-show-remove="false" data-show-close="false" type="file" class="file">
                                
                                <br/>
                                
                                <div id="divLibro" style="display: none;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="autor" type="text" class="form-control" name="autor" placeholder="Autor" value="<?= $noticia_detalle[0]['MetaAutor'] ?>"> 
                                        </div>
                                        <br/>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="editorial" type="text" class="form-control" name="editorial" placeholder="Editorial" value="<?= $noticia_detalle[0]['MetaEditorial'] ?>" > 
                                        </div>
                                        <br/>
                                </div>
                                
                                <div id="divPelicula" style="display: none;">                                
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="director" type="text" class="form-control" name="director" placeholder="Director" value="<?= $noticia_detalle[0]['MetaDirector'] ?>" > 
                                    </div>
                                    <br/>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="protagonistas" type="text" class="form-control" name="protagonistas" placeholder="Protagonistas" value="<?= $noticia_detalle[0]['MetaProtagonistas'] ?>" > 
                                    </div>
                                    <br/>                                        
                                </div>
                                    
                                <?php
                                    if($editNoticia) {
                                         if($noticia_detalle[0]['IdCategoria'] == 1) {                                
                                            echo "<script type='text/javascript'>";
                                            echo "muestraEditaLibro();";
                                            echo "</script>";                                            
                                         } else {
                                             echo "<script type='text/javascript'>";                                 
                                             echo "muestraEditaPelicula();";
                                             echo "</script>";                                             
                                         }
                                    }                                    
                                ?>  
                                                               
                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="edit_noticia" name="edit_noticia">Aceptar</button> 
                                
                                <!-- Campos ocultos -->
                                <input type="hidden" name="path_imagen" id="path_imagen" value="<?= $noticia_detalle[0]['ImagenUrl'] ?>">
                                <input type="hidden" name="datos_imagen" id="datos_imagen" value="">
                                <input type="hidden" name="id_categoria" id="id_categoria" value="<?= $noticia_detalle[0]['IdCategoria'] ?>"> 
                                <input type="hidden" name="chkEstado" id="chkEstado" value=""> 
                            </form>
                        </div>
                    </div>
                  </div>
            </div>
            
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

