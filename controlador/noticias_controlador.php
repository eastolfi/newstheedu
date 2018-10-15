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
        $datos['noticias'] = get_noticias($cat, 1);
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
                if(isset($_POST['chkSubsLibros']))                
                    $subLibros = 1;
                
                if(isset($_POST['chkSubsPelis']))
                    $subPelis = 1;
                
                subscribir_usuario($email, $subLibros, $subPelis);
                
                //Enviar un correo de bienvenida                
                require ($_SERVER['DOCUMENT_ROOT'] . '/clases/correo/class.correos.php');
                $envio = new envioCorreo();
                $envioOk = $envio->envio_correos_bienvenida_boletin($email);
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
        } elseif(isset($_POST['resp_idOpinion'])){
            $idUsuario=$_POST["resp_idusuario"];
            $idOpinion = $_POST['resp_idOpinion'];
            $respuesta=$_POST["areaResp" . $idOpinion];
            
             set_respuesta($idOpinion, $idUsuario, $respuesta);
        } else {
            set_incremento_visitas($idNoticia, get_cliente_ip());
        }
            
        $noticia = get_noticia_detalle($idNoticia);
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/noticias/noticiadetalle.php');
    }
    
    /**
    *
    * Obtiene la IP real del cliente
    *
    */
    function get_cliente_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
?>