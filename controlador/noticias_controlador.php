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
    function controlador_noticias($vw, $cat)
    {
        $datos['noticias'] = get_noticias($cat);
        $errorBoletin = "";
                       
        if(isset($_POST['boletin']))
	{ 
            //Realizar toda la funcionalidad para incluir el correo en la suscripción con las llamadas al modelo.
            $subLibros = 0;
            $subPelis = 0;            
            $email=$_POST["email"];
            
            //Si el correo existe, utilizar una variable para mostrar el error en el label de la suscripcin
            if(existe_email_subcripcion($email))
                $errorBoletin = "El correo ya existe en la BD.";
            else {
                //OBTENER LOS CHECK BOX ========================================
                if(isset($_POST['chkSubsLibros']))                
                    $subLibros = 1;
                
                if(isset($_POST['chkSubsPelis']))
                    $subPelis = 1;
                
                subscribir_usuario($email, $subLibros, $subPelis);
            }
        } 
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/noticias/noticias.php');
    }

    /**
    *
    * Recupera el controlador correspondiente a cuando se carga la vista noticias*.php
    *
    */
    function controlador_noticia_detalle($idNoticia)
    {
        $vw = 0;
        $cat = 0;
        $errorBoletin = "";
        
        if(isset($_POST['comentario']))
	{ 
            //Realizar toda la funcionalidad para incluir el comentario asociado a la noticia
            $valoracion=$_POST["comment_valoracion"];
            $comentario=$_POST["comment"]; 
            $idUsuario=$_POST["comment_idusuario"]; 
            
            set_opinion($idNoticia, $idUsuario, $valoracion, $comentario);            
        } else {
            set_incremento_visitas($idNoticia);
        }
            
        $noticia = get_noticia_detalle($idNoticia);
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/noticias/noticiadetalle.php');
    }
?>