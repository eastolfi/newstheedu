<?php

//Enviar un correo de bienvenida                
require ($_SERVER['DOCUMENT_ROOT'] . '/clases/correo/class.correos.php');
$envio = new envioCorreo();
$envioOk = $envio->envio_correos_bienvenida_boletin("eastolfi@yahoo.com");

if($envioOk)
    echo "<br />OK";
else
    echo "<br />FULL";
				
/*
// LA SIGUIENTE LÍNEA INDICA QUE SI SE HA PULSADO
// EL BOTÓN ENVIAR, SE DEBE EJECUTAR EL CÓDIGO PHP PARA ENVIAR EL
// CORREO. SI EL BOTÓN NO SE HA PULSADO, PASE AL CÓDIGO
// BAJO "else" (QUE MUESTRA EL FORMULARIO EN SU LUGAR. )
if ( isset ( $_POST [ 'buttonPressed' ] )){

// REEMPLACE LA LÍNEA SIGUIENTE CON SU DIRECCIÓN DE E-MAIL.
$to = 'eastolfi@yahoo.com' ;
$subject = 'From PHP contact page' ;

// NO SE ACONSEJA CAMBIAR ESTOS VALORES
$message = $_POST [ "message" ] ;
$headers = 'From: ' . $_POST[ "from" ] . PHP_EOL ;
mail ( $to, $subject, $message, $headers ) ;

// EL TEXTO ENTRE COMILLAS MOSTRADO A CONTINUACIÓN 
// SE MUESTRA A LOS USUARIOS TRAS ENVIAR EL FORMULARIO.
echo "¡Se ha enviado tu e-mail!" ;}

else{
?>

<form method= "post" action= "<?php echo $_SERVER [ 'PHP_SELF' ] ;?>" />

<table>
<tr>
<td>Your e-mail address: </td>
<td><input name= "from" type= "text"/></td>
</tr>
<tr>
<td>Your message: </td>
<td><textarea name= "message" cols= "20" rows= "6"></textarea></td>
</tr>
<tr>
<td></td>
<td><input name= "buttonPressed" type= "submit" value= "Send E-mail!" /></td>
</tr>
</table>

</form>

<?php } ?>
*/

?>