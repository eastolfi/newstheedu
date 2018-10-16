<?php

/**
* Se inserta un nuevo usuarioregistrado en la base de datos
*
* @return int 1|2|3 Codigos de estado sobre el resultado de la transaccion (ok = 0, error = 1, Usuario existe = 2)
* @param array[] Array que contiene todos los datos del usuario registradio para el alta
*/
function subscribir_usuario($email, $subsLibros, $subsPelis)
{		
    
    $link = conectar_bd();

    //Inserto los datos de los campos de registro con Rol=usuario y Ban=False 
    $sql="INSERT INTO `boletin` (`email`, `okLibros`, `okPelis`, `activa`) 
        VALUES ('" . $email . "', " . $subsLibros . ", " . $subsPelis . ", b'" . 1 . "')";

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
* Se inserta un nuevo usuarioregistrado en la base de datos
*
* @return int 1|2|3 Codigos de estado sobre el resultado de la transaccion (ok = 0, error = 1, Usuario existe = 2)
* @param array[] Array que contiene todos los datos del usuario registradio para el alta
*/
function existe_email_subcripcion($email)
{
    $link = conectar_bd();

    //Solicito a SQL todos los Usuarios = $usuario
    $sql = "SELECT id FROM boletin WHERE email = '" . $email . "'";
    $resultados = mysqli_query($link, $sql);	

    //Si no devielve nada, es que no existe el usuario
    $num_filas = $resultados->num_rows;

    desconectar_bd($link);

    //Retorno el resultado
    if($num_filas == 0) return false;
    else return true;	
}

function get_suscriptores()
{
    $link = conectar_bd();

    //Solicito a SQL todos los suscriuptores
    $sql = "SELECT * FROM boletin";
    $resultados = mysqli_query($link, $sql);	

    //Creo el array que guardara la informacion de los libros
    $todos_suscriptores = array();
	
    //Guardo cada libro en un elemento del array    
    while($suscriptor=mysqli_fetch_assoc($resultados)) {
        $todos_suscriptores[] = $suscriptor;
    }

    //Desconectamos la BBDD
    desconectar_bd($link);
	
	//Retorno el array con los libros
    return $todos_suscriptores;	
}
?>

