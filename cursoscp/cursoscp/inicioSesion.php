<?php
    require("conexionbd.php");
    require("functions.php");

    session_start();
    if(!isset($_SESSION['user']) and !isset($_SESSION['admin'])){
        $validaDni = false;
        $validaUser = false;      
        if(isset($_POST['entrar'])) {
            if(isset($_POST['dni'])) {
                $dni = trim($_POST['dni']);
                $consulta = comprobarSolicitante($_POST['dni']);
                if($consulta){
                    $_SESSION['user'] = $dni;
                    header("Location:index.php");
                }
                else{
                    header("Location:?error=1");
                }
            }
            else if(isset($_POST['admin']) and isset($_POST['pass'])){
                $user = trim($_POST['admin']);
                $pass = trim($_POST['pass']);
                $consulta = comprobarAdmin($user, $pass);
                if($consulta){                    
                    $_SESSION['admin'] = $user;
                    header("Location:index.php");
                }
                else{
                    header("Location:?error=2");
                }
            }
        }    
        else if(isset($_POST['volver'])) header("Location:index.php");
    }
    else{
        header("Location:index.php");
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
        <h1>Inicio de solicitante</h1>
        <form action="?" method="post">
            <table class="form">
                <?php
                    echo dibujaInputText("DNI", "dni", false);                
                ?>
            </table>
            <?php
                echo dibujaInputBoton("Entrar", "entrar", "submit");
                echo dibujaInputBoton("Resetear", "reset", "reset");
                echo dibujaInputBoton("Volver", "volver", "submit");
                if(isset($_GET['error'])){
                    if($_GET['error'] == 1){
                        echo "<p>DNI introducido no valido</p>";
                    }
                }
            ?>
        </form>        
    </div>
    <div>
        <h1>Inicio de administrador</h1>
        <form action="?" method="post">
            <table class="form">
                <?php
                    echo dibujaInputText("Usuario","admin", false);
                    echo dibujaInputPass("Contraseña", "pass", false);
                ?>
            </table>
            <?php
                echo dibujaInputBoton("Entrar", "entrar", "submit");
                echo dibujaInputBoton("Resetear","reset", "reset");
                echo dibujaInputBoton("Volver", "volver", "submit");
                if(isset($_GET['error'])){
                    if($_GET['error'] == 2){
                        echo "<p>Usuario introducido no valido</p>";
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>
