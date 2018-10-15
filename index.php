<?php	
/**
*
* Punto de entrada de la aplicacion TheEduNews.
*
* @author Eduardo Astolfi
* @copyright Copyright © 2018 
* @version 1.0.0
* @package 'index.php' realizando las veces de controlador
* @link http://news.theedu:8081/
*/

    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/conectaBD.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/modelo_noticias.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/modelo_usuarios.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/modelo_opinion.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/modelo/modelo_boletin.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/controlador/noticias_controlador.php');	
    require_once($_SERVER['DOCUMENT_ROOT'] . '/controlador/usuarios_controlador.php');	
    require_once($_SERVER['DOCUMENT_ROOT'] . '/controlador/admin_controlador.php');	
    
    if($_SERVER['SERVER_NAME'] == "localhost") 
        define('__URL__', 'http://localhost:8081');
    elseif($_SERVER['SERVER_NAME'] == "news.theedu") 
        define('__URL__', 'http://news.theedu:8081');
    elseif($_SERVER['SERVER_NAME'] == "newstheedu.000webhostapp.com") 
        define('__URL__', 'https://newstheedu.000webhostapp.com');
    elseif($_SERVER['SERVER_NAME'] == "192.168.1.5") 
        define('__URL__', 'http://192.168.1.5:8081');
    else
        define('__URL__', 'http://news.theedu.es'); 	
    
    if (empty($_SESSION['sesion_time'])) { 
        session_start();        
        $_SESSION['sesion_time'] = time();
        
        if (isset($_COOKIE["login"])) {
            //Obtener los datos para mantener en la sesion
            $_SESSION['sesion_rol'] = $_COOKIE["cookie_rol"];
            $_SESSION['sesion_user'] = $_COOKIE["cookie_user"];
        }        
    } else if($_SESSION['sesiom_time'] < time() - 180) {
        session_start();
        session_destroy();        
    }
    
    //Enrutamiento
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $segments = explode('/', $path);
    $uri = $segments[count($segments)-1];    
    
    switch ($uri) 
    {
        case "":
        case "index.php":
        case "noticias":
            if(isset($_GET['vw']) && isset($_GET['cat']))
                controlador_noticias($_GET['vw'], $_GET['cat']);
            elseif(isset($_GET['cat']))
                controlador_noticias(0, $_GET['cat']);
            elseif(isset($_GET['vw']))
                controlador_noticias($_GET['vw'], 0);
            else                
                controlador_noticias(0, 0);
            break; 
        case "noticia":
            if(isset($_GET['id']))
                controlador_noticia_detalle($_GET['id']);
            break;
        case "login":
            controlador_login();
            break;
        case "registro":
            controlador_registro();
            break;
        case "logout":
            controlador_logout();            
            break;
        case "valida":
            if(isset($_GET['uname'])) {                
                controlador_validar_registro($_GET['uname']);
            }
            break;
        case "admin_usuarios":
            controlador_admin_usuarios();
            break;
        case "admin_usuario_edit":
             if(isset($_GET['id']))                
                controlador_admin_usuario_edit($_GET['id']);
            break;
       case "admin_noticias":
            controlador_admin_noticias();
            break;
        case "admin_noticia_edit":
             if(isset($_GET['id']))                
                controlador_admin_noticia_edit($_GET['id']);
            break;
        case "admin_rss":
            controlador_admin_rss();
            break;
        case "admin_boletines":
            controlador_admin_boletines();
            break;
    }	
?>