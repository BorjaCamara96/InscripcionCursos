<?php
    require("conexionbd.php");
    require("functions.php");

    session_start();
    if(isset($_POST['volver'])) header("Location:index.php");
    if(isset($_SESSION['user'])){
        if(isset($_POST['solicitar'])){
            $insert = solicitarCurso($_POST['codigocurso'], $_SESSION['user']);
            $message = ($insert) ? $_SESSION['user']." ha solicitado curso. " : "Ya ha solicitado este curso" ;
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver cursos</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
    <div>
        <h1>Ver cursos</h1>
        <table>
            <?php
                $numero = (isset($_SESSION['admin'])) ? 0  : 1 ;
                $stmt = mostrarCursos($numero);  
                $stmt -> execute();
                if($stmt -> rowCount() > 0){
                    echo "<tr>
                        <td>Nombre</td>
                        <td>Plazas</td>
                        <td>Fecha</td>
                    </tr>";
                }
                while($fila = $stmt -> fetch(PDO::FETCH_NUM)){
                    echo "<form action='";
                        if(isset($_SESSION['user'])) echo "?";
                        else echo "verAdmitidos.php";
                    echo "' method='post'>";
                    $fecha = new DateTime($fila[4]);
                    $fecha = $fecha->format("d-m-Y");
                    echo 
                    "<tr>
                        <td>".$fila[1]."</td>
                        <td>".$fila[3]."</td>
                        <td>".$fecha."</td>
                        <input type='hidden' name='codigocurso' value='".$fila[0]."'/>";                       
                        if(isset($_SESSION['user'])) echo "<td>".dibujaInputBoton("Solicitar", "solicitar", "submit")."</td>";
                        else if(isset($_SESSION['admin'])) echo "<td>".dibujaInputBoton("Ver solicitantes", "verSolicitantes", "submit")."</td>";
                    echo "</tr>";
                    echo "</form>";
                }
                outbd($stmt);
            ?>
        </table>
        <form action="?" method="post">
            <?php
                echo dibujaInputBoton("Volver", "volver", "submit");
                if($message != null) echo "<p>".$message."</p>";
            ?>
        </form> 
    </div>
</body>
</html>