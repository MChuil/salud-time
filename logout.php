<?php 
    session_start();
    //eiminamos variables de session
    unset($_SESSION['nombre']);
    unset($_SESSION['correo']);
    unset($_SESSION['rol']);
    unset($_SESSION['login']);

    session_destroy();
    header('Location: index.php');