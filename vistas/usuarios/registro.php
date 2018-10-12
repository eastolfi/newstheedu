<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
				
    <title>TIME TRAVEL. Registro</title>	
    
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item active" aria-current="page">Registro</li></ol></nav></div>
            </div>
            
             <!-- BLOQUE INFROMATIVO DE USUARIO ACTIVO ---------------------------------------------------------------------------------->	
            <?php
                if($yaActivo) {
            ?>            
                <div class="contenedor">                    
                    <h3 id="comments" align="center"><br/>Hola '<?= $userDesc ?>'. Tu usuario ya está activado.<br/>El enlace que has utilizado ya está caducado.</h3>
                </div>
            <?php } ?>
             
            <!-- BLOQUE INFROMATIVO DE QUE HA IDO BIEN ---------------------------------------------------------------------------------->	
            <?php
                if($todoActivo) {
            ?>            
                <div class="contenedor">                    
                    <h3 id="comments" align="center"><br/>Hola '<?= $userDesc ?>'. Tu usuario se ha activado correctamente. A partir de ahora podras comentar y valorar las novedades presentadas en la web.<br/>Muchas gracias por elegirnos.</h3>
                </div>
            <?php } ?>
            
            <!-- BLOQUE INFROMATIVO DE QUE HA IDO BIEN ---------------------------------------------------------------------------------->	
            <?php
                if($todoOk) {
            ?>            
                <div class="contenedor">                
                    <h3 id="comments" align="center"><br/>Enhorabuena. Ya eres un usuario registrado en news.theedu.es. Como último paso, accede a tu correo para activar el usuario.<br/>Muchas gracias por elegirnos.</h3>
                </div>
            <?php } ?>
            
            <!-- BLOQUE INFROMATIVO DE QUE HA IDO MAL ---------------------------------------------------------------------------------->	
            <?php
                if($todoMal) {
            ?>            
                <div class="contenedor">
                    <h3 id="comments" align="center"><br/>Lo sentimos. Se ha producido un error dando de alta el usuario. Por favor, inténtelo más tarde.</h3>
                </div>
            <?php } ?>
            
            <?php
                if($muestraform) {
            ?>  
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Regístrate o <a href="<?= __URL__ . '/index.php/login'; ?>">Login</a></h3>

                    <div class="row omb_row-sm-offset-3" >
                        <div class="col-xs-12 col-sm-6" >	
                            <form class="omb_loginForm" action="registro" autocomplete="off" method="POST">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Nombre de usuario" value="<?= $usuario ?>" required>                                                                                                
                                </div>
                                <span id="errorUser" class="help-block"></span>
                                <span class="help-block"><?= $errorUserExist ?></span>
                                <br/>

                                <div class="input-group">
                                    <span  class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    <input id="useremail" type="text" class="form-control" name="useremail" placeholder="Correo electrónico" value="<?= $email ?>" required>                                                                                                
                                </div>
                                <span id="errorMail" class="help-block"></span>
                                <br/>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input  id="contrasena" type="password" class="form-control" name="contrasena" placeholder="Contraseña" value="<?= $contrasena ?>" required>
                                </div>
                                <br/>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input id="recontrasena" type="password" class="form-control" name="recontrasena" placeholder="Repite contraseña" value="<?= $contrasena ?>" required>
                                </div>
                                <span id="errorPass" class="help-block"></span>                                
                                <br/>

                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="registro">Regístrate</button>
                            </form>
                        </div>
                    </div>					
                </div>
            </div>
            <?php } ?>
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
    
     <?php
        if($muestraform) {
    ?> 
    <script>
      var userName = document.getElementById("username");
      var userEmail = document.getElementById("useremail");
      var recontrasena = document.getElementById("recontrasena");

      userName.addEventListener("blur", validarNombre, false);  
      userEmail.addEventListener("blur", validarMail, false);  
      recontrasena.addEventListener("blur", validarPass, false);  

      function validarNombre() {
           //Comprobar que los campos obligatorios no estan vacios
           var nombre = document.getElementById("username");
           var errorUser = document.getElementById("errorUser");

           if (nombre.value.trim() == "" && nombre.value.length > 0) {                
               errorUser.innerHTML = "&nbsp;&nbsp;&nbsp;Error. El campo 'Nombre de usuario' no puede estar en blanco.<br/>";
               nombre.focus();
               return;
           } else if(!isNaN(parseFloat(nombre.value))) {
               //Comprobar que el campo nombre no es exclusivamente numérico
               errorUser.innerHTML = "&nbsp;&nbsp;&nbsp;Error. El valor del campo 'Nombre de usuario' no puede ser numérico.<br/>";
               nombre.focus();
               return;
           }
           else
               errorUser.innerHTML = "";
       }

       function validarMail() {
           var mail = document.getElementById("useremail");
           var errorMail = document.getElementById("errorMail");           
           regExpMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

           if (mail.value.trim() == "" && mail.value.length > 0) {
                   errorMail.innerHTML = "&nbsp;&nbsp;&nbsp;Error. El campo 'Correo electrónico' no puede estar en blanco.<br/>";
                   mail.focus();
                   return;
           } else if(!regExpMail.test(mail.value)) {									
                   errorMail.innerHTML = "&nbsp;&nbsp;&nbsp;Error. El campo 'Correo electrónico' no tiene un formato correcto.<br/>";
                   mail.focus();
                   return;            				
           }
           else
               errorMail.innerHTML = "";
       }

        function validarPass() {
            var contrasena = document.getElementById("contrasena");
            var recontrasena = document.getElementById("recontrasena");

            if(contrasena.value != recontrasena.value) {
                var errorPass = document.getElementById("errorPass");
                errorPass.innerHTML = "&nbsp;&nbsp;&nbsp;Error. Las contraseñas no son iguales.<br/>";
            }
           else
              errorMail.innerHTML = "";
        }
    </script>
    <?php } ?>
</html>

