<?php
    /*
     * 
     */
    function controlador_logout()
    {
        session_destroy();
            
        if (isset($_COOKIE['login'])) {
            //setcookie('login', null, -1, '/');            
            //setcookie('cookie_rol', null, -1, '/');            
            //setcookie('cookie_user', null, -1, '/'); 
            echo "<script>";
            echo "document.cookie = 'login=null; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/';";
            echo "document.cookie = 'cookie_rol=null; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/';";
            echo "document.cookie = 'cookie_user=null; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/';";            
            echo "</script>";
        }       
        echo "<script>";
        echo "window.location.replace('" . __URL__ . "/index.php" . "');";
        echo "</script>";
    }

    /*
     * 
     */
    function controlador_login()
    {        
        $todoOk = false;
        $errorUser = false;
        $errorPass = false;
        $muestraform = true;
        
        if(isset($_POST['login']))
        {    
            $usuario=$_POST["username"];
            $contrasena=$_POST["password"];
            
            if(existe_usuario($usuario, 1)) {
                if(login_usuario($usuario, $contrasena)) 
                {			
                    //Inicio las variables de sesion -------------------
                    $rol=get_rol($usuario);
                    			
                    //COMENTAR PARA LOCALHOST---------------------------
                    //session_start();
                    //--------------------------------------------------
					
                    $_SESSION['sesion_time'] = time();
                    $_SESSION['sesion_rol'] = $rol['Rol'];
                    $_SESSION['sesion_user']  = $usuario;
					
                    //Si esta marcado, hacer persistentes los datos mediante sesion
                    if(isset($_POST["chkAceptar"])) {
                        echo "<script>";
                        echo "document.cookie = 'login=true; expires=Thu, 18 Dec 2018 12:00:00 UTC; path=/';";
                        echo "document.cookie = 'cookie_rol=" . $_SESSION['sesion_rol'] . "; expires=Thu, 18 Dec 2018 12:00:00 UTC; path=/';";
                        echo "document.cookie = 'cookie_user=" . $_SESSION['sesion_user'] . "; expires=Thu, 18 Dec 2018 12:00:00 UTC; path=/';";
                        echo "</script>";
												
                        //setcookie("login", "true", time() + (172800), '/'); //Duracion 2 dias
                        //setcookie("cookie_rol", $_SESSION['sesion_rol'], time() + (172800), '/'); //Duracion 2 Dias
                        //setcookie("cookie_user", $_SESSION['sesion_user'], time() + (172800), '/'); //Duracion 2 Dias
                    }                    
                    //----------------------------------------------------------

                    $todoOk = true;
                    $muestraform = false;
                } else {                
                    $errorPass = true;
                    $muestraform = true;
                }
            } else {            
                $errorUser = true;
                $muestraform = false;            
            }
        }
    		
        require($_SERVER['DOCUMENT_ROOT'] . '/vistas/usuarios/login.php');
    }
    
    /*
     * 
     */
    function controlador_validar_registro($username)
    {
        require ($_SERVER['DOCUMENT_ROOT'] . '/clases/encrypt_decrypt/class.encrypt.decrypt.php');
        //$username= "ZEVVM3hlekZNaUJVVmZJQVEvZHNrZz09";
        $desencrypt = new encryptDecrypt();        
        $userDesc = $desencrypt->desencrypt($username);
        
        $todoOk = false;        
        $todoMal = false;
        $muestraform = false;
        $todoActivo = false;
        $yaActivo = false;
        
        //Hay que establecer el campo 'Activo'
        if(!set_usuario_activo($userDesc)) {
            //El usuario ya está activo
            $yaActivo = true;
        } else {        
            //Y obtener el rol para las variables de sesion                       
            $rol=get_rol($userDesc);

            //COMENTAR PARA LOCALHOST---------------------------
            //session_start();
            //--------------------------------------------------
            
            $_SESSION['sesion_time'] = time();
            $_SESSION['sesion_rol'] = $rol['Rol'];
            $_SESSION['sesion_user']  = $userDesc;

            $todoActivo = true;
        }
                
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/usuarios/registro.php');
    }
    
    /*
     * 
     */
    function controlador_registro()
    {
        $usuario="";
        $email="";
        $contrasena="";
        $errorUserExist = "";
        $todoOk = false;
        $todoMal = false;
        $muestraform = true;
        $todoActivo = false;
        $yaActivo = false;
                    
        if(isset($_POST['registro']))
	{            
            $usuario=$_POST["username"];
            $email=$_POST["useremail"];
            $contrasena=$_POST["contrasena"];
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            //PROCESAR FORM
            $datos_usuario = array();

            $datos_usuario["usuario"] = $usuario;		
            $datos_usuario["email"] = $email;
            $datos_usuario["contrasena"] = $contrasenaHash;
                        
            $datos_usuario["rol"] = 'visitante';
            $datos_usuario["activo"] = '0';

            //Si el usuario no existe, realizo el INSERT
            if(!existe_usuario($datos_usuario["usuario"], 0)) 
            {						
                $result=registrar_usuario($datos_usuario);
                
                if($result) {
                    $todoOk = true;  
                    
                    //Encripto el usuario        
                    require ($_SERVER['DOCUMENT_ROOT'] . '/clases/encrypt_decrypt/class.encrypt.decrypt.php');
                    $encrypt = new encryptDecrypt();
                    $userEnc = $encrypt->encrypt($usuario);
                    
                    //Enviar un correo de validacion
                    require ($_SERVER['DOCUMENT_ROOT'] . '/clases/correo/class.correos.php');
                    $envio = new envioCorreo();
                    $envioOk = $envio->envio_correos_registro($email, $userEnc);
                    //$envioOk = enviarCorreo($email); 
                
                    $usuario="";
                    $email="";
                    $contrasena="";
                } else {
                    $todoMal = true;
                }
                
                $muestraform = false;                                              
            }
            else {
               $errorUserExist = "&nbsp;&nbsp;&nbsp;Error. Ya existe un usuario con el nombre '" . $usuario . "'<br/>";
            }
        }
        
        require ($_SERVER['DOCUMENT_ROOT'] . '/vistas/usuarios/registro.php');
    }
            
?>
