<?php
    require("conexionbd.php");
    require("functions.php");
    $validDni = false;
    $validNombre = false;
    $validApellidos = false;
    $validTelefono = false;
    $validCorreo = false;
    $validCodCentro = false;
    $validFechaNaci = false;
    $validAnyoInicio = false;
    $validCheckCoordTic = false;
    $validCheckGrupoTic = false;
    $validGrupoTic = false;
    $validCheckBilin = false;
    $validCheckCargo = false;
    $validNombreCargo = false;
    $validRadioActivo = false;
    session_start();
    if(!isset($_SESSION['admin']) and !isset($_SESSION['user'])){
        if(isset($_POST["registrar"])){
            $validDni = (validarInputDni($_POST['dni']) or validarInputTextEmpty($_POST['dni'])) ? true : false ;
            $validNombre = (validarInputTexto($_POST['nombre']) or validarInputTextEmpty($_POST['nombre'])) ? true : false ;
            $validApellidos = (validarInputTexto($_POST['apellidos']) or validarInputTextEmpty($_POST['apellidos'])) ? true : false ;
            $validTelefono = (validarInputTelefono($_POST['telefono'])) or validarInputTextEmpty($_POST['telefono']) ? true : false ;
            $validCorreo = (validarInputCorreo($_POST['correo']) or validarInputTextEmpty($_POST['correo'])) ? true : false ;
            $validCodCentro = (validarInputNumero($_POST['codcentro'], 4)) or validarInputTextEmpty($_POST['codcentro']) ? true : false ;
            $validFechaNaci = empty($_POST['fechanaci']);
            $validCheckCoordTic = isset($_POST['cordiadortic']);   
            $validCheckGrupoTic = isset($_POST['grupotic']);
            if($validCheckGrupoTic){
                $validGrupoTic = validarInputTextEmpty($_POST['nombregrupotic']) or validarInputTexto($_POST['nombregrupotic']) ? true : false ;
            }
            $validCheckBilin = isset($_POST['bilingue']);
            $validCheckCargo = isset($_POST['cargo']);
            if($validCheckCargo){
                $validNombreCargo = validarInputTextEmpty($_POST['nombrecargo']) ? true : false ;
            }
            $validAnyoInicio = (validarInputNumero($_POST['anyoinicio'], 4)) or validarInputTextEmpty($_POST['anyoinicio']) ? true : false ;
            $validRadioActivo = empty($_POST['situacion']) ? true : false ; 
            if(!$validDni and !$validNombre and !$validApellidos and !$validTelefono and !$validCorreo and !$validCodCentro and !$validFechaNaci and !$validGrupoTic and !$validNombreCargo and !$validAnyoInicio and !$validAnyoInicio){
                $dni = trim($_POST['dni']);
                $nombre = trim($_POST['nombre']);
                $apellidos = trim($_POST['apellidos']);
                $telefono = trim($_POST['telefono']);
                $correo = trim($_POST['correo']);
                $codcentro = trim($_POST['codcentro']);
                $coordinadortic = $validCheckCoordTic ? 1 : 0;
                $grupotic = $validCheckGrupoTic  ? 1 : 0 ;
                $nombregrupotic = trim($_POST['nombregrupotic']);
                $bilingue = $validCheckBilin ? 1 : 0 ;
                $cargo = $validCheckCargo  ? 1 : 0 ;
                $nombrecargo = trim($_POST['nombrecargo']);
                $situacion = $_POST['situacion'];
                $fechanac = new DateTime($_POST['fechanaci']);
                $fechanac = $fechanac->format("Y-m-d"); 
                $especialidad = trim($_POST['especialidad']);
                $anyoinicio = trim($_POST['anyoinicio']); 
                $insert = registrarSolicitante($dni, $nombre, $apellidos, $telefono, $correo, 
                $codcentro, $coordinadortic, $grupotic, $nombregrupotic, $bilingue, 
                $cargo, $nombrecargo, $situacion, $fechanaci, $especialidad, $anyoinicio);
                $message = ($insert) ? $dni." ha sido registrado correctamente. " : "No se pudo registrar solicitante." ; 
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
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
    <div>
        <form action="?" method="post">
            <h1>Registro de solicitante</h1>
            <table class="form">
                <?php
                    echo dibujaInputText("DNI*","dni",$validDni);
                    echo dibujaInputText("Nombre*","nombre",$validNombre);
                    echo dibujaInputText("Apellidos*","apellidos",$validApellidos);
                    echo dibujaInputText("Telefono*","telefono",$validTelefono);
                    echo dibujaInputText("Correo*","correo",$validCorreo);
                    echo dibujaInputNumber("Codigo centro*","codcentro",$validCodCentro);
                    echo dibujaInputCheck("Coordinador TIC", "cordiadortic", $validCheckCoordTic);
                    echo dibujaInputCheck("Grupo TIC", "grupotic", $validGrupoTic);
                    echo dibujaInputText("Nombre grupo TIC","nombregrupotic",$validGrupoTic);
                    echo dibujaInputCheck("Bilingüe", "bilingue", $validCheckBilin);              
                    echo dibujaInputCheck("Cargo","cargo",$validCheckCargo);
                    $cargos = array("", "Director", "Jefe Estudios", "Secretario", "Jefe Departamento");
                    echo dibujaSelect("Nombre cargo", "nombrecargo", $cargos, $validNombreCargo, true);
                    $opciones = array("Activo", "Inactivo");
                    echo dibujaInputRadio("Situacion*", "situacion", $opciones, $validRadioActivo);
                    echo dibujaInputDate("Fecha nacimiento*", "fechanaci", $validFechaNaci);
                    echo dibujaInputText("Especialidad", "especialidad", $valid);
                    echo dibujaInputNumber("Año de inicio*", "anyoinicio", $validAnyoInicio); 
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