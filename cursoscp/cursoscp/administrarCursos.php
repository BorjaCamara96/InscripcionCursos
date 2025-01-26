<?php
    require("conexionbd.php");
    require("functions.php");

    session_start();
    if(isset($_SESSION['admin'])){
        $estado = (isset($_POST['estadoBefore'])) ? $_POST['estadoBefore'] : true ;
        $message = "";
        if(isset($_POST ['actualizar'])){
            if($_POST['estado'] == "Abiertos") $estado = true;
            else if($_POST['estado'] == "Cerrados") $estado = false;
        }
        else if(isset($_POST['eliminar'])){
            if(!isset($_POST['idCurso'])){
                $message = "No ha marcado ningun curso";
            }
            else{
                foreach($_POST['idCurso'] as $codigocurso){
                    $message .= eliminarCurso($codigocurso)."<br>";
                }
            }   
        }
        else if(isset($_POST['abrir'])){
            if(empty($_POST['idCurso'])){
                $message = "No ha marcado ningun curso";
            }
            else{
                foreach($_POST['idCurso'] as $codigocurso){
                    $message .=  abrirCurso($codigocurso)."<br>";
                }
            }      
        }            
        else if(isset($_POST['cerrar'])){
            if(empty($_POST['idCurso'])){
                $message = "No ha marcado ningun curso";
            }
            else{
                foreach($_POST['idCurso'] as $codigocurso){
                    $message .= cerrarCurso($codigocurso)."<br>";
                }
            }        
        }
        else if(isset($_POST['asignar'])){
            if(empty($_POST['idCurso'])){
                $message = "No ha marcado ningun curso";
            }
            else{
                foreach($_POST['idCurso'] as $codigocurso){
                    $message .= asignarSolicitudes($codigocurso)."<br>";
                }
            }    
        }    
        else if(isset($_POST['desasignar'])){
            if(empty($_POST['idCurso'])){
                $message = "No ha marcado ningun curso";
            }
            else{
                foreach($_POST['idCurso'] as $codigocurso){
                    $message .= desasignarSolicitudes($codigocurso)."<br>";
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
    <title>Administrar Cursos</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
</head>
<body>
    <div>
        <h1>Administrar cursos</h1>
        <form action="?" method="post">
            <table>
                <?php
                    $opciones = array("Abiertos", "Cerrados");
                    echo dibujaSelect("Estado", "estado", $opciones, false, false);
                    echo dibujaInputBoton("Actualizar", "actualizar", "submit");
                    echo "<input type='hidden' name='estadoBefore' value='".$estado."'/>";
                ?>
            </table>
            <table>
                <?php
                    $stmt = mostrarCursos($estado);  
                    $stmt -> execute();
                    if($stmt -> rowCount() > 0){
                        echo "<tr>";
                            echo "<td>Nombre</td>";
                            echo "<td>Plazas</td>";
                            echo "<td>Fecha</td>";
                        echo "</tr>";
                    }
                    while($fila = $stmt -> fetch(PDO::FETCH_NUM)){
                        $fecha = new DateTime($fila[4]);
                        $fecha = $fecha->format("d-m-Y");
                        echo 
                        "<tr>
                            <td>".$fila[1]."</td>
                            <td>".$fila[3]."</td>
                            <td>".$fecha."</td>
                            <td><input type='checkbox' name='idCurso[]' value='".$fila[0]."'/></td>
                        </tr>";
                    }
                    outbd($stmt);
                ?>
            </table>
        <?php
            if($stmt -> rowCount() > 0){
                if($estado) echo dibujaInputBoton("Cerrar", "cerrar", "submit");
                else if(!$estado) {
                    echo dibujaInputBoton("Abrir", "abrir", "submit");
                    echo dibujaInputBoton("Asignar", "asignar", "submit");
                    echo dibujaInputBoton("Desasignar", "desasignar", "submit");
                }
                echo dibujaInputBoton("Eliminar", "eliminar", "submit");
            }
            echo dibujaInputBoton("Volver", "volver", "submit");
            if(!empty($message)) echo "<p>".$message."</p>";
        ?>
        </form>
    </div>
</body>
</html>