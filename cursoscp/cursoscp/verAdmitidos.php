<?php
    require("conexionbd.php");
    require("functions.php");

    session_start();
    if(isset($_SESSION['admin'])){
        if(isset($_POST["codigocurso"])){
            $codigocurso = $_POST['codigocurso'];
        }        
        else if(isset($_POST['volver'])) header("Location:verCursos.php");
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
    <title>Ver admitidos</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>  
    <div>
        <form action="?" method="post">
            <?php
                $stmt = verAdmitidos($codigocurso);
                $stmt -> execute();
                if(($stmt -> rowCount()) > 0){
                    $fila = $stmt->fetch(PDO::FETCH_NUM);
                    echo "<h1>".$fila[0]."</h1>";
                    echo "<table>";
                    $stmt = verAdmitidos($codigocurso);
                    $stmt -> execute();
                    echo "<tr>";
                        echo "<td>DNI</td>";
                        echo "<td>Nombre</td>";
                        echo "<td>Apellidos</td>";
                        echo "<td>Telefono</td>";
                        echo "<td>Correo</td>";
                        echo "<td>Codigo centro</td>";
                    echo "</tr>";
                    while($fila = $stmt -> fetch(PDO::FETCH_ASSOC)){ 
                        echo "<tr style='color:";
                        echo ($fila['admitido']) ? "green" : "red" ; 
                        echo "'>";
                            echo "<td>".$fila['dni']."</td>";
                            echo "<td>".$fila['nombre']."</td>";
                            echo "<td>".$fila['apellidos']."</td>";
                            echo "<td>".$fila['telefono']."</td>";
                            echo "<td>".$fila['correo']."</td>";
                            echo "<td>".$fila['codcen']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    outbd($stmt);
                }
                echo dibujaInputBoton("Volver", "volver", "submit");
            ?>
        </form>
    </div>
</body>
</html>

