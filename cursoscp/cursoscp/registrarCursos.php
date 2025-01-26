<?php
    require("conexionbd.php");
    require("functions.php");
    $validaNombreCurso = false;
    $validaEstado = false;
    $validaPlazas = false;
    $validaFechaCurso = false;

    session_start();

    if(isset($_SESSION['admin'])){
        if(isset($_POST["registrar"])){
            $validaNombreCurso = (validarInputTextEmpty($_POST['nombrecurso']) or validarInputTexto($_POST['nombrecurso'])) ? true : false ;
            $validaEstado = empty($_POST['estado']) ? true : false ; 
            $validaPlazas = (validarInputNumero($_POST['plazas'], 2)) or validarInputTextEmpty($_POST['plazas']) ? true : false ;
            $validaFechaCurso = (empty($_POST['fechacurso']) or validarInputDate($_POST['fechacurso'])) ? true : false ;
            
            if(!$validaNombreCurso and !$validaEstado and !$validaPlazas and !$validaFechaCurso){
                $nombrecurso = trim($_POST['nombrecurso']);
                $estado = ($_POST['estado'] == 'abierto') ? 1 : 0;
                $plazas = $_POST['plazas'];
                $fechacurso = new DateTime($_POST['fechacurso']);
                $fechacurso = $fechacurso->format("Y-m-d");
                $insert = registrarCurso($nombrecurso, $estado, $plazas, $fechacurso);
                $message = ($insert) ? $nombrecurso." ha sido registrado correctamente. " : "No se pudo registrar curso." ;
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
    <title>Registrar curso</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
    <div>
        <h1>Registro de cursos</h1>
        <form action="?" method="post">
            <table class="form">
                <?php
                    echo dibujaInputText("Nombre curso*", "nombrecurso", $validaNombreCurso);
                    $opciones = array("Abierto", "Cerrado");
                    echo dibujaInputRadio("Estado*", "estado", $opciones, $validaEstado);
                    echo dibujaInputNumber("Numero de plazas*", "plazas", $validaPlazas);
                    echo dibujaInputDate("Fecha fin de inscripción*", "fechacurso", $validaFechaCurso);
                ?>
            </table>
            <?php
                echo dibujaInputBoton("Registrar", "registrar", "submit");
                echo dibujaInputBoton("Resetear", "reset", "reset");
                echo dibujaInputBoton("Volver", "volver", "submit");
                if($message != null) echo "<p>".$message."</p>";
            ?>
        </form>
    </div>
</body>
</html>