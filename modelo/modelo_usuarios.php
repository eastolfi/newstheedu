<?php
/**
* Se valida si el usuario introducido esta dado de alta
*
* @return bool true|false Indica si el usuario esta de alta en la BBDD o no
* @param string $usuario Cadena con el usuario sobre el que se desea consultar
*/
function existe_usuario($usuario, $activo)
{
    $link = conectar_bd();

    //Solicito a SQL todos los Usuarios = $usuario
    $sql = "SELECT IdUsuario FROM usuarios WHERE Usuario = '" . $usuario . "' AND Activo = " . $activo;
    $resultados = mysqli_query($link, $sql);	

    //Si no devielve nada, es que no existe el usuario
    $num_filas = $resultados->num_rows;

    desconectar_bd($link);

    //Retorno el resultado
    if($num_filas == 0) return false;
    else return true;	
}

/**
* Se inserta un nuevo usuarioregistrado en la base de datos
*
* @return int 1|2|3 Codigos de estado sobre el resultado de la transaccion (ok = 0, error = 1, Usuario existe = 2)
* @param array[] Array que contiene todos los datos del usuario registradio para el alta
*/
function login_usuario($usuario, $contrasena)
{		
    $link = conectar_bd();

    $sql="SELECT Contrasena FROM `usuarios` WHERE Usuario LIKE '" . $usuario . "'";
    $resultados = mysqli_query($link, $sql);	
    $hash = mysqli_fetch_assoc($resultados);				
    $hashStr = $hash["Contrasena"]; 

    desconectar_bd($link);

    if (password_verify($contrasena, $hashStr)) {
        return true;
    } else {
        return false;
    }	                   
}

/**
* Obtiene el ROL al que pertenece un usuario concreto
*
* @return strign $rol Contiene el literal del rol
* @param string $usuario Cadena con el usuario sobre el que se desea consultar el rol
*/
function get_rol($usuario)
{
	//Obtengo la conexión a la base de datos de MySQL    
    $link = conectar_bd();
    $sql = "SELECT Rol FROM `usuarios` WHERE Usuario LIKE '" . $usuario . "'";
	
    $resultados = mysqli_query($link, $sql);	
    $rol = mysqli_fetch_assoc($resultados);
	
    //Desconectamos la BBDD
    desconectar_bd($link);
	
    return $rol;
}

/**
* Obtiene el ROL al que pertenece un usuario concreto
*
* @return strign $rol Contiene el literal del rol
* @param string $usuario Cadena con el usuario sobre el que se desea consultar el rol
*/
function get_id($usuario)
{
    //Obtengo la conexión a la base de datos de MySQL    
    $link = conectar_bd();
    $sql = "SELECT idUsuario FROM `usuarios` WHERE Usuario LIKE '" . $usuario . "'";
	
    $resultados = mysqli_query($link, $sql);	
    $idUsuario = mysqli_fetch_assoc($resultados);
	
    //Desconectamos la BBDD
    desconectar_bd($link);
	
    return $idUsuario;
}

/**
* Obtiene el ROL al que pertenece un usuario concreto
*
* @return strign $rol Contiene el literal del rol
* @param string $usuario Cadena con el usuario sobre el que se desea consultar el rol
*/
function set_usuario_activo($usuario)
{
   if(!existe_usuario($usuario, 1)) {
        $link = conectar_bd();    
        $sql = "UPDATE `usuarios` SET Activo = 1 WHERE Usuario LIKE '" . $usuario . "'";
	
        mysqli_query($link, $sql);	
        desconectar_bd($link);
        
        return true;
    } 
    else
        return false;    
}

/**
* Se inserta un nuevo usuarioregistrado en la base de datos
*
* @return int 1|2|3 Codigos de estado sobre el resultado de la transaccion (ok = 0, error = 1, Usuario existe = 2)
* @param array[] Array que contiene todos los datos del usuario registradio para el alta
*/
function registrar_usuario($datos_usuario)
{		
    $link = conectar_bd();

    //Inserto los datos de los campos de registro con Rol=usuario y Ban=False 
    $sql="INSERT INTO `usuarios` (`idUsuario`, `Usuario`, `Email`, `Contrasena`, `Rol`, `Activo`) 
        VALUES (NULL, '" . $datos_usuario["usuario"] . "', '" . $datos_usuario["email"] . "', '" . $datos_usuario["contrasena"] . "', '" . $datos_usuario["rol"] . "', b'" . $datos_usuario["activo"] . "')";

    if ($link->query($sql) === TRUE) 
    {
        desconectar_bd($link);			
        return true;		
    } else {
        desconectar_bd($link);
        return false;
    }	
}

/**
* Obtiene todos los autores de la tabla
*
* @param void
* @return array[] Array que contiene todos los autoroes cargados
*/
function get_usuarios()
{
    $link = conectar_bd();

    //Recupero todos los autores
    $resultados = mysqli_query($link, "SELECT * FROM `usuarios`");	

    //Creo el array que guardara la informacion de los autores
    $todos_usuarios = array();

    //Guardo cada autor en un elemento del array    
    while($usuario = mysqli_fetch_assoc($resultados))
                    $todos_usuarios[] = $usuario;
		
    desconectar_bd($link);
	
	//Retorno el array con los autores
    return $todos_usuarios;
}

function get_usuario_detalle($idUsuario) {
    $link = conectar_bd();

    //Recupero todos los autores
    $resultados = mysqli_query($link, "SELECT * FROM `usuarios` WHERE idUsuario = " . $idUsuario);	

    //Creo el array que guardara la informacion de los autores
    $usuario_detalle = array();

    //Guardo cada autor en un elemento del array    
    while($usuario = mysqli_fetch_assoc($resultados))
        $usuario_detalle[] = $usuario;
		
    desconectar_bd($link);
	
	//Retorno el array con los autores
    return $usuario_detalle;
}
?>