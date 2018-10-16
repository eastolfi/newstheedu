<?php
    /**
    *
    * Módulo de la capa de negocio
    *
    * @author Eduardo Astolfi
    * @copyright Copyright © 2018 
    * @version 1.0.0
    */

    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function valida_acceso_admin()
    {
        $estaLogin = false;
        $esAdmin = false;
    
        if(!empty($_SESSION['sesion_rol'])) {
            if($_SESSION['sesion_rol'] == "admin") 
                $esAdmin = true;                
        }       
        
        if(!$esAdmin) {
            echo "<script>";
            echo "window.location.replace('" . __URL__ . "/vistas/erroracceso.php" . "');";
            echo "</script>";
        }
    }
    
    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function  controlador_admin_usuarios()
    {        
        $datos['usuarios'] = get_usuarios();
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/admin/usuarios.php');
    } 
    
    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function controlador_admin_usuario_edit($idUsuario)
    {                        
        if(isset($_POST['edit_usuario'])) {
            $user_detalle['Rol'] = $_POST["user_rol"];
            $user_detalle['Activo'] = $_POST["chkEstado"];
            $user_detalle['idUsuario'] = $idUsuario;
            
            set_edit_usuario($user_detalle);

            //Redirecciono a la vista de noticias
            echo "<script>";
            echo "window.location.replace('" . __URL__ . "/index.php/admin_usuarios" . "');";
            echo "</script>"; 
        }
        else
            $user_detalle = get_usuario_detalle($idUsuario);
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/admin/usuario_edit.php');
    }
    
    
    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias.php
    *
    */
    function  controlador_admin_noticias()
    {
        $datos['noticias'] = get_noticias(0, 0);
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/admin/noticias.php');
    }
    
    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function controlador_admin_noticia_edit($idNoticia)
    {
        $editNoticia = true;
        $noticia_detalle = array();
        
        //Inicializar el array para noticia nueva
        $noticia_detalle[0]['IdCategoria'] = "";
        $noticia_detalle[0]['Titulo'] = "";
        $noticia_detalle[0]['TituloOriginal'] = "";
        $noticia_detalle[0]['Ano'] = "";
        $noticia_detalle[0]['Resumen'] = "";
        $noticia_detalle[0]['ImagenUrl'] = "";
        
        $noticia_detalle[0]['MetaAutor'] = "";
        $noticia_detalle[0]['MetaEditorial'] = "";
        $noticia_detalle[0]['MetaDirector'] = "";
        $noticia_detalle[0]['MetaProtagonistas'] = "";
        
        $noticia_detalle[0]['Aprobado'] = "";        
        
        if(isset($_POST['edit_noticia'])) {
            $imagenUrl = $_POST["path_imagen"];
            $datosImg = $_POST["datos_imagen"];
            
            if($datosImg != "") 
            {                
                $origen = fopen($datosImg, 'r');

                $imagenServer = substr($imagenUrl, 1);
                $destino = fopen($imagenServer, 'w');

                stream_copy_to_stream($origen, $destino);

                fclose($origen);
                fclose($destino);
            }
            

            //Las validaciones se hacen en el cliente con JS            
            $noticia_detalle['IdCategoria'] = $_POST["id_categoria"];            
            $noticia_detalle['Titulo'] = $_POST["titulo"];
            $noticia_detalle['TituloOriginal'] = $_POST["tituloOriginal"];
            
            $noticia_detalle['Ano'] = $_POST["ano"];
            $noticia_detalle['Resumen'] = $_POST["resumen"];
            $noticia_detalle['ImagenUrl'] = $imagenUrl;

            $noticia_detalle['MetaAutor'] = $_POST["autor"];
            $noticia_detalle['MetaEditorial'] = $_POST["editorial"];
            $noticia_detalle['MetaDirector'] = $_POST["director"];
            $noticia_detalle['MetaProtagonistas'] = $_POST["protagonistas"];

            $noticia_detalle['Aprobado'] = $_POST["chkEstado"];
            
            //Se da de alta en la BBDD
            if($idNoticia > 0) {
                $noticia_detalle['IdNoticia'] = $idNoticia;
                set_edit_noticia($noticia_detalle, 1); //1 UPDATE 
                //upddate_rss($noticia_detalle);
            } else {                
                set_edit_noticia($noticia_detalle, 0); //0 INSERT
                
                //Actualizo el feed del RSS
                upddate_rss($noticia_detalle);
                
            }
                
            //Redirecciono a la vista de noticias
            echo "<script>";
            echo "window.location.replace('" . __URL__ . "/index.php/admin_noticias" . "');";
            echo "</script>";                            
        } else {                             
            if($idNoticia > 0) 
                $noticia_detalle = get_noticia_detalle($idNoticia);
            else
                $editNoticia = false;
                
            require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/admin/noticia_edit.php');
        }
    }
    
    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function  controlador_admin_rss()
    {
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/admin/rss.php');
    }
    
    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function  controlador_admin_boletines()
    {     
        $datos['suscriptores'] = get_suscriptores();
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/admin/boletines.php');
    }
    
    /**     
     * 
     */
    function upddate_rss($noticia_detalle)
    {        
        $url = "rss/rss_theedunews.xml";    
        $rss = new SimpleXMLElement($url, 0, true);
        $nuevoItem = $rss->channel->addChild('item');
    
        $nuevoItem->addChild('title', $noticia_detalle['Titulo']);
        $nuevoItem->addChild('link', __URL__ . '/index.php/noticia?id=' . $noticia_detalle['IdNoticia']); 
            
        $txtDescripcion = "<![CDATA[<p style='text-align: left;'>";
        $txtDescripcion .= "<img src='" . __URL__ . $noticia_detalle['ImagenUrl'] . "' alt='" . $noticia_detalle['Titulo'] . "' title='" . $noticia_detalle['Titulo'] . "' width='100' height='150'>";
        $txtDescripcion .= "</p><p style='text-align: left;font-size: 12pt;'>" . $noticia_detalle['Resumen'] . "</p>";
        $descripcion = htmlspecialchars_decode($txtDescripcion);        
        $nuevoItem->addChild('description', $descripcion);    
        
        $pubDate = new DateTime();
        $nuevoItem->addChild('pubDate', $pubDate->format(DateTime::RSS));
    
        $rss->asXML($url);                                                      
    }
?>
