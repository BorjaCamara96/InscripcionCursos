<?php
    session_start();
    if(isset($_SESSION['admin'])) unset($_SESSION['admin']);
    else if(isset($_SESSION['user'])) unset($_SESSION['user']);
    else header("Location:index.php");
    setcookie(session_name(),"",time()-3600);
    session_destroy();
    header("Location:index.php");    
?>