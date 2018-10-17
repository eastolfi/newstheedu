<?php

class envioCorreo {   
    /**
    * Constructor
    */
    public function __construct() {
               
    }
    
    /**
    * @access public
    * @return string salida
    */
    public function envio_correos_registro($destinatario, $usuario) {        
       $smtp = $this->instancia_phpMailer();

       $mailTo=array(
           $destinatario=>$usuario
       );
       
       //NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que cualquier programa de correo pueda leerlo.
       //Defino el contenido HTML del correo
       $contenidoHTML="<head>";
       $contenidoHTML.="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
       $contenidoHTML.="</head><body>";
       $contenidoHTML.="<b>Bienvenido al último paso de registro en TheEduNews. Utilice el siguiente enlace para validar su cuenta de correo y activar el usuario.</b>";
       $contenidoHTML.="<p><a href='" . __URL__ . "/index.php/valida?uname=" . $usuario . "'>The Edu News</a></p>";
       $contenidoHTML.="</body>\n";

       //Defino el contenido en formato Texto del correo
       $contenidoTexto="Bienvenido al ultimo paso de registro en TheEduNews. Utilice el siguiente enlace para validar su cuenta de correo  y activar el usuario.";
       $contenidoTexto.="\n\n" . __URL__ . "/index.php/valida?uname=" . $usuario;

       //Definio el subject
       $smtp->Subject="Validar registrio de usuario";
       $rutaAbsoluta=substr($_SERVER["SCRIPT_FILENAME"],0,strrpos($_SERVER["SCRIPT_FILENAME"],"/"));
       
       //Contenido
       $smtp->AltBody=$contenidoTexto; //Text Body
       $smtp->MsgHTML($contenidoHTML); //Text body HTML

        //Attachments
        //$smtp->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$smtp->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

       foreach($mailTo as $mail=>$name)
       {
           $smtp->ClearAllRecipients();
           $smtp->AddAddress($mail,$name);

           if(!$smtp->Send())
           {
               echo "<br>Error (".$mail."): ".$smtp->ErrorInfo;
               return false;
           }else{
               //echo "<br>Envio realizado a ".$name." (".$mail.")";
               return true;
           }
       }
    }

    
    /**
    * @access public
    * @return string salida
    */
    public function envio_correos_bienvenida_boletin($destinatario) {        
       $smtp = $this->instancia_phpMailer();
       $usuario = "";
       
       $mailTo=array(
           $destinatario=>$usuario
       );
       
       //Defino el contenido HTML del correo
       $contenidoHTML="<head>";
       $contenidoHTML.="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
       $contenidoHTML.="</head><body>";
       $contenidoHTML.="<b>Estimado usuario: gracias por suscribirte a los boletines de TheEduNews.</b>";       
       $contenidoHTML.="<p>Esperamos que disfrutes del contenido.<br />Un saludo,<br />The Edu News</p>";
       $contenidoHTML.="</body>";

       //Defino el contenido en formato Texto del correo
       $contenidoTexto="Estimado usuario: gracias por suscribirte a los boletines de TheEduNews.";
       $contenidoTexto.="\nEsperamos que disfrutes del contenido.\n\nUn saludo,\nThe Edu News";
       
       //Definio el subject
       $smtp->Subject="Bienvenido a la lista de distribución de TheEduNews";
       $rutaAbsoluta=substr($_SERVER["SCRIPT_FILENAME"],0,strrpos($_SERVER["SCRIPT_FILENAME"],"/"));
       
       //Contenido
       $smtp->AltBody=$contenidoTexto; //Text Body
       $smtp->MsgHTML($contenidoHTML); //Text body HTML

       foreach($mailTo as $mail=>$name)
       {
           $smtp->ClearAllRecipients();
           $smtp->AddAddress($mail,$name);

           if(!$smtp->Send())
           {
               echo "<br>Error (".$mail."): ".$smtp->ErrorInfo;
               return false;
           }else{
               return true;
           }
       }
    }
    
    /**
     * 
     * @return \PHPMailer
     */
    private function instancia_phpMailer() {
       //Envio de correo mediante el servidor SMTP de Google con phpMailer
       require ($_SERVER['DOCUMENT_ROOT'] . '/clases/correo/phpmailer.php');
     
       $smtp = new PHPMailer(true);

       # Indicamos que vamos a utilizar un servidor SMTP
       $smtp->IsSMTP();
       
       //Contenido por defecto
       $smtp->isHTML(true); 
        
       # Definimos el formato del correo con UTF-8
       $smtp->CharSet="UTF-8";
       
       # autenticación contra servidor smtp Google
       $smtp->SMTPAuth   = true;	      // enable SMTP authentication
       $smtp->SMTPSecure = "tls";
       $smtp->Host       = "smtp.gmail.com"; //SMTP server       
       $smtp->Port       = 587;
       $smtp->Username   = "theedunews@gmail.com";
       $smtp->Password   = "theedunews123";	
       
       # datos de quien realiza el envio
       $smtp->From       = "theedunews@gmail.com"; // from mail
       $smtp->FromName   = "TheEdu News"; // from mail name
       
       return $smtp;
    }
}
?>

