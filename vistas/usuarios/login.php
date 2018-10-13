<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
<!--    <script type="text/javascript" src="<?= __URL__ . '/script/cookies.js'; ?> "></script>-->
    
    <title>TIME TRAVEL. Login</title>	
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/vistas/presentacion.php">Inicio</a></li>				
                <li class="breadcrumb-item active" aria-current="page">Login</li></ol></nav></div>
            </div>

            <?php
                if($errorUser) {
            ?>            
                <div class="contenedor">                
                    <h3 id="comments" align="center"><br/>Lo siento. No existe un usuario activo con el nombre '<?= $usuario ?>'.<br/>Regístrate, activa el usuario y vuelve a intentarlo.</h3>
                </div>
            <?php } ?>
            
            <?php
                if($errorPass) {
            ?>            
                <div class="contenedor">                
                    <h3 id="comments" align="center"><br/>Error. La contraseña del usuario con el nombre '<?= $usuario ?>' no es correcta.<br/>Vuelve a intentarlo.</h3>
                </div>
            <?php } ?>
            
            <?php
                if($todoOk) {
            ?>            
                <div class="contenedor">                    
                    <h3 id="comments" align="center"><br/>Bienvenido <?= $usuario ?>!!<br/>A partir de ahora podrás dejar tus opiniones y comentar las de otros usuarios. Que disfrutes!!</h3>
                </div>
            <?php } ?>
            
            <?php
                if($muestraform) {
            ?> 
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->		
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Login o <a href="<?= __URL__ . '/index.php/registro'; ?>">Regístrate</a></h3>					
                    <div class="row omb_row-sm-offset-3" >
                        <div class="col-xs-12 col-sm-6" >	
                            <form class="omb_loginForm" action="login" autocomplete="off" method="POST">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Nombre de usuario" required>
                                </div>
                                <span id="errorUser" class="help-block"></span>
                                <br/>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input  type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <br/>
								
                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
                                <br/>
                                
                                <label class="checkbox">
                                    <input type="checkbox" name="chkAceptar" id="chkAceptarId" onclick="compruebaAceptacion()" value="remember-me">&nbsp;Recordar en este equipo
                                </label>
                                                                
                                <span id="errorAceptacion" class="help-block" style="color: orange;"></span>
                                <br/>
                            </form>
                        </div>
                    </div>
                    <div class="row omb_row-sm-offset-3">                                               
                        <div class="col-xs-12 col-sm-3">
                            <p class="omb_forgotPwd">
                                <a href="#">¿Has perdido la contraseña?</a>
                            </p>
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
    
    <script>
       var muestraForm = "<?php echo $muestraform ?>";        
            
        if(muestraForm) {                           
            var  userName = document.getElementById("username");
            userName.addEventListener("blur", validarNombre, false);  
       }
       
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
        
        function compruebaAceptacion() {
            var errorAceptacion = document.getElementById("errorAceptacion");
            errorAceptacion.innerHTML = "";
            
            if(getCookie('aviso') != "1") {                
                errorAceptacion.innerHTML = "&nbsp;&nbsp;&nbsp;Lo sentimos. Si no aceptas el uso de cookies no podremos recordarte.<br/>";
                var valAceptar = document.getElementById("chkAceptarId");
                valAceptar.checked = false;
            }             
        }
    </script>
</html>
