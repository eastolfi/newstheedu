<?php

class envioCorreo {   
    /**
    * Constructor
    */
    public function __construct() {
               
    }
    
    /**
    * Encripta la cadena recibida
    *
    * @access public
    * @return string salida
    */
    public function envio_correos_registro($destinatario, $usuario) {        
       $smtp = $this->instancia_phpMailer();

       $mailTo=array(
           $destinatario=>$usuario
       );
       
       # NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
       # cualquier programa de correo pueda leerlo.

       # Definimos el contenido HTML del correo
       $contenidoHTML="<head>";
       $contenidoHTML.="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
       $contenidoHTML.="</head><body>";
       $contenidoHTML.="<b>Bienvenido al último paso de registro en TheEduNews. Utilice el siguiente enlace para validar su cuenta de correo y activar el usuario.</b>";
       $contenidoHTML.="<p><a href='" . __URL__ . "/index.php/valida?uname=" . $usuario . "'>The Edu News</a></p>";
       $contenidoHTML.="</body>\n";

       # Definimos el contenido en formato Texto del correo
       $contenidoTexto="Bienvenido al ultimo paso de registro en TheEduNews. Utilice el siguiente enlace para validar su cuenta de correo  y activar el usuario.";
       $contenidoTexto.="\n\n" . __URL__ . "/index.php/valida?uname=" . $usuario;

       # Definimos el subject
       $smtp->Subject="Validar registrio de usuario";

       # Adjuntamos el archivo "leameLWP.txt" al correo.
       # Obtenemos la ruta absoluta de donde se ejecuta este script para encontrar el
       # archivo leameLWP.txt para adjuntar. Por ejemplo, si estamos ejecutando nuestro
       # script en: /home/xve/test/sendMail.php, nos interesa obtener unicamente:
       # /home/xve/test para posteriormente adjuntar el archivo leameLWP.txt, quedando
       # /home/xve/test/leameLWP.txt
       $rutaAbsoluta=substr($_SERVER["SCRIPT_FILENAME"],0,strrpos($_SERVER["SCRIPT_FILENAME"],"/"));
       //$smtp->AddAttachment($rutaAbsoluta."/leameLWP.txt", "LeameLWP.txt");

       # Indicamos el contenido
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
               //echo "<br>Envio realizado a ".$name." (".$mail.")";
               return true;
           }
       }
    }

    private function instancia_phpMailer() {
        //Envio de correo mediante el servidor SMTP con phpMailer
        require ($_SERVER['DOCUMENT_ROOT'] . '/clases/correo/phpmailer.php');
     
        $smtp=new PHPMailer();

       # Indicamos que vamos a utilizar un servidor SMTP
       $smtp->IsSMTP();

       # Definimos el formato del correo con UTF-8
       $smtp->CharSet="UTF-8";
       
       # autenticación contra servidor smtp Google
       $smtp->SMTPAuth   = true;		// enable SMTP authentication
       $smtp->SMTPSecure = "tls";
       $smtp->Host       = "smtp.gmail.com";	// sets MAIL as the SMTP server       
       $smtp->Port       = 587;
       $smtp->Username   = "theedunews@gmail.com";	// MAIL username
       $smtp->Password   = "theedunews123";			// MAIL password 
       
       # datos de quien realiza el envio
       $smtp->From       = "theedunews@gmail.com"; // from mail
       $smtp->FromName   = "TheEdu News"; // from mail name
       
       # establecemos un limite de caracteres de anchura
       $smtp->WordWrap   = 50; // set word wrap
       
       return $smtp;
    }
}
?>

