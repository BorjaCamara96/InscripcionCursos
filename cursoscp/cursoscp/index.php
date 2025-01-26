<?php
    require("conexionbd.php");
    require("functions.php");


    session_start();
    $user = (isset($_SESSION['user'])) ? true : false ;
    $admin = (isset($_SESSION['admin'])) ? true : false ;
    $none = (!$user and !$admin) ? true : false ;
    if(isset($_POST['verCursos'])) header("Location:verCursos.php");
    if($none){
        if(isset($_POST['iniciarSesion'])) header("Location:inicioSesion.php");
        else if(isset($_POST['registrar'])) header("Location:registro.php");
    }
    else if(!$none){
        if(isset($_POST['cerrarSesion'])) header("Location:cerrarSesion.php");
        if($admin){
            if(isset($_POST['registrarCursos'])) header("Location:registrarCursos.php");
            if(isset($_POST['administrarCursos'])) header("Location:administrarCursos.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
    <div>
        <h1>Index</h1>
        <form action="?" method="post">
            <table>
                <?php
                    if($none) {
                        echo dibujaInputBoton("Iniciar sesion", "iniciarSesion", "submit");
                        echo dibujaInputBoton("Registrar", "registrar", "submit");
                    }
                    else if(!$none){
                        if($admin){
                            echo dibujaInputBoton("Registrar cursos", "registrarCursos", "submit");
                            echo dibujaInputBoton("Administrar cursos", "administrarCursos", "submit");
                        }
                        echo dibujaInputBoton("Cerrar sesion", "cerrarSesion", "submit");
                    }
                    echo dibujaInputBoton("Ver cursos", "verCursos", "submit");
                ?>
            </table>
        </form>        
    </div>
</body>
</html>
