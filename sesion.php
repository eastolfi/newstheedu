<?php
    session_start();    
    $_SESSION['sesion_time'] = time();
    
    echo $_SESSION['sesion_time'];
    
//    if (empty($_SESSION['sesion_time'])) { 
//        session_start();        
//        $_SESSION['sesion_time'] = time();
//    }
?>