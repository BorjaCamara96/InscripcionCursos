<?php
    function inbd(){
        $user = "user";
        $pass = "1234";
        $conex = new PDO("mysql:dbname=cursoscp;host=127.0.0.1",$user,$pass);    
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conex;
    }
    function outbd($stmt){
        $stmt->closeCursor();
        $stmt = null;
    }        
    function registrarSolicitante($dni, $nombre, $apellidos, $telefono, $correo, $codcentro, $coordinadortic, $grupotic, $nombregrupotic, $pbilin, $cargo, $nombrecargo, $situacion, $fechanac, $especialidad, $anyoinicio){
        try {
            $puntos = baremacionSolicitantes($coordinadortic, $grupotic, $pbilin, $situacion, $anyoinicio, $cargo, $nombrecargo);
            $conex = inbd();
            $stmt = $conex->prepare("INSERT INTO solicitantes (dni, nombre, apellidos, telefono, correo, 
            codcen, coordinadortic, grupotic, nomgrupo, pbilin, cargo, nombrecargo, situacion, 
            fechanac, especialidad, anyoinicio, puntos) 
            VALUES (:dni, :nombre, :apellidos, :telefono, :correo, :codcentro, :coordinadortic, :grupotic, 
            :nombregrupotic, :pbilin, :cargo, :nombrecargo, :situacion, :fechanaci, :especialidad, 
            :anyoinicio, :puntos)");
            $stmt->bindParam(":dni", $dni);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":codcentro", $codcentro);
            $stmt->bindParam(":coordinadortic", $coordinadortic);
            $stmt->bindParam(":grupotic", $grupotic);
            $stmt->bindParam(":nombregrupotic", $nombregrupotic);
            $stmt->bindParam(":pbilin", $pbilin);
            $stmt->bindParam(":cargo", $cargo);
            $stmt->bindParam(":nombrecargo", $nombrecargo);
            $stmt->bindParam(":situacion", $situacion);
            $stmt->bindParam(":fechanaci", $fechanac);
            $stmt->bindParam(":especialidad", $especialidad);
            $stmt->bindParam(":anyoinicio", $anyoinicio);
            $stmt->bindParam(":puntos", $puntos);
            $stmt->execute();
            outbd($stmt);       
            $conex = null;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }                
        return true;
    } 
    function baremacionSolicitantes($coordinadortic, $grupotic, $pbilin, $situacion, $anyoinicio, $cargo, $nombrecargo){
        $puntos = 0;
        $anyoActual = new DateTime();
        $anyoActual = $anyoActual->format("Y");
        $puntos += ($coordinadortic == 1) ? 4 : 0 ;
        $puntos += ($grupotic == 1) ? 3 : 0 ;
        $puntos += ($pbilin == 1) ? 3 : 0 ;
        $puntos += ($situacion == "activo") ? 1 : 0 ;
        $puntos += (($anyoActual - $anyoinicio) > 15) ? 1 : 0 ;
        if($cargo == 1){
            switch ($nombrecargo){
                case "Director":
                case "Jefe Estudios";
                case "Secretario":
                    $puntos += 2;
                    break;
                case "Jefe Departamento":
                    $puntos += 1;
                    break;
            }
        } 
        return $puntos;
    }
    function registrarCurso($nombrecurso, $estado, $plazas, $fechacurso){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("INSERT INTO cursos (nombre, abierto, numeroplazas, plazoinscripcion) 
            VALUES (:nombre, :abierto, :numeroplazas, :plazoinscripcion)");
            $stmt->bindParam(":nombre", $nombrecurso);
            $stmt->bindParam(":abierto", $estado);
            $stmt->bindParam(":numeroplazas", $plazas);
            $stmt->bindParam(":plazoinscripcion", $fechacurso);
            $stmt->execute();
            outbd($stmt);       
            $conex = null;
            return true;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }                
        return true;
    }
    function mostrarCursos($estado){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT * FROM cursos WHERE abierto = :estado");
            $stmt -> bindValue(':estado', $estado);
            return $stmt;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }       
    }
    function solicitarCurso($codigocurso, $dni){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT * FROM solicitudes WHERE codigocurso = :codigocurso AND dni LIKE :dni");
            $stmt -> bindValue(':codigocurso', $codigocurso);
            $stmt -> bindValue(':dni', $dni);
            $stmt->execute();            
            if($stmt -> rowCount() == 0){
                $stmt = $conex->prepare("INSERT INTO solicitudes (dni, codigocurso, fechasolicitud) 
                VALUES (:dni, :codigocurso, :fechasolicitud)");
                $fechaHoy = new DateTime();
                $fechaHoy = $fechaHoy->format("Y-m-d");
                $stmt->bindParam(":dni", $dni);
                $stmt->bindParam(":codigocurso", $codigocurso);
                $stmt->bindParam(":fechasolicitud", $fechaHoy);
                $stmt->execute();
                outbd($stmt);       
                $conex = null;
                return true;
            }                 
            outbd($stmt);       
            $conex = null;
            return false;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }                
    }
    function eliminarCurso($codigocurso){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT cursos.nombre FROM cursos WHERE codigocurso = :codigocurso");
            $stmt->bindParam(":codigocurso", $codigocurso);
            $stmt->execute();
            $fila = $stmt -> fetch(PDO::FETCH_ASSOC);
            $nombre = $fila['nombre'];
            $stmt = $conex->prepare("DELETE FROM cursos WHERE codigocurso = :codigocurso");
            $stmt->bindParam(":codigocurso", $codigocurso);
            $stmt->execute();
            outbd($stmt);       
            return "Curso ".$nombre." eliminado";
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }                
    }
    function comprobarSolicitante($dni){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT * FROM solicitantes WHERE dni LIKE :dni");
            $stmt -> bindValue(':dni', $dni);
            $stmt -> execute();
            $numero = $stmt->rowCount(); 
            outbd($stmt);       
            $conex = null;
            if($numero == 1) return true;
            else return false;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }    
    }
    function comprobarAdmin($user, $pass){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT * FROM admin WHERE user LIKE :user AND pass LIKE :pass");
            $stmt -> bindValue(':user', $user);
            $stmt -> bindValue(':pass', $pass);
            $stmt -> execute();
            $numero = $stmt->rowCount(); 
            outbd($stmt);       
            $conex = null;
            if($numero == 1) return true;
            else return false;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }    
    }
    function abrirCurso($codigocurso){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT cursos.nombre, COALESCE(SUM(CASE WHEN solicitudes.admitido = TRUE THEN 1 ELSE 0 END), 0) AS cursoAdm
            FROM cursos 
            JOIN solicitudes ON cursos.codigocurso = solicitudes.codigocurso
            WHERE solicitudes.codigocurso = :codigocurso
            GROUP BY solicitudes.codigocurso;");
            $stmt->bindParam(":codigocurso", $codigocurso);
            $stmt -> execute();
            $fila = $stmt -> fetch(PDO::FETCH_ASSOC);
            $nombre = $fila['nombre']; 
            if($fila['cursoAdm'] > 0) {
                return "Curso ".$nombre." no abierto. Todavia hay solicitantes asignados";
            }
            else{
                $conex = inbd();
                $stmt = $conex->prepare("UPDATE cursos SET abierto = 1 WHERE codigocurso = :codigocurso");
                $stmt->bindParam(":codigocurso", $codigocurso);
                $stmt->execute();
                outbd($stmt);       
                return "Curso ".$nombre." abierto";
            }
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }                    
    }
    function cerrarCurso($codigocurso){        
        try {            
            $conex = inbd();
            $stmt = $conex->prepare("SELECT * FROM cursos WHERE codigocurso LIKE :codigocurso AND abierto = 1");
            $stmt->bindParam("codigocurso", $codigocurso);
            $stmt -> execute();
            $fila = $stmt -> fetch(PDO::FETCH_ASSOC);
            $nombre = $fila['nombre'];
            $fechaFila = new DateTime($fila["plazoinscripcion"]);
            $fechaHoy = new DateTime();
            if($fechaFila < $fechaHoy) {
                $stmt = $conex->prepare("UPDATE cursos SET abierto = 0 WHERE codigocurso = :codigocurso");
                $stmt->bindParam(":codigocurso", $codigocurso);
                $stmt->execute();
                return "Curso ".$nombre." cerrado con exito"; 
            }
            else{
                return "Curso ".$nombre." no cerrado. Todavia esta dentro de plazo"; 
            }
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }    
    }
    function asignarSolicitudes($codigocurso){
        $conex = inbd();
        $stmt = $conex->prepare("SELECT cursos.nombre, cursos.abierto, cursos.numeroplazas, COALESCE(SUM(CASE WHEN solicitudes.admitido = TRUE THEN 1 ELSE 0 END), 0) AS cursoAdm
            FROM cursos 
            JOIN solicitudes ON cursos.codigocurso = solicitudes.codigocurso
            WHERE solicitudes.codigocurso = :codigocurso
            GROUP BY solicitudes.codigocurso;");
        $stmt->bindParam(":codigocurso", $codigocurso);
        $stmt -> execute();
        $fila = $stmt -> fetch(PDO::FETCH_ASSOC);
        $nombre = $fila['nombre']; 
        $numeroplazas = $fila['numeroplazas'];
        if($fila['cursosAdm'] > 0) {
            return "Curso ".$nombre." ya asignado";
        }
        if(!$fila['abierto']){
            $stmt = $conex->prepare("WITH info AS(
                SELECT solicitudes.dni, solicitantes.puntos, COALESCE(SUM(CASE WHEN solicitudes.admitido = TRUE THEN 1 ELSE 0 END), 0) AS cursoAdm 
                FROM solicitudes 
                JOIN solicitantes ON solicitudes.dni = solicitantes.dni  
                GROUP BY solicitudes.dni     
                )
                SELECT info.dni, info.puntos, info.cursoAdm
                FROM info
                JOIN solicitudes ON solicitudes.dni = info.dni
                WHERE solicitudes.codigocurso = :codigocurso
                ORDER BY cursoAdm ASC, puntos DESC
                LIMIT ".$numeroplazas);
            $stmt->bindParam(":codigocurso", $codigocurso);
            $stmt -> execute();
            while($fila = $stmt -> fetch(PDO::FETCH_ASSOC)){
                asignarCurso($fila['dni'], $codigocurso);
            }
            return "Curso ".$nombre." asignado";
        }
        else{
            return "Curso ".$nombre." no asignado. Todavia esta abierto";
        }
    }    
    function asignarCurso($dni, $codigocurso){
        $conex = inbd();
        $stmt = $conex->prepare("UPDATE solicitudes SET admitido = 1 WHERE dni LIKE :dni AND codigocurso = :codigocurso");
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":codigocurso", $codigocurso);
        $stmt->execute();
    }
    function desasignarSolicitudes($codigocurso){
        $conex = inbd();
        $stmt = $conex->prepare("SELECT cursos.nombre, COALESCE(SUM(CASE WHEN solicitudes.admitido = TRUE THEN 1 ELSE 0 END), 0) AS cursoAdm
            FROM cursos 
            JOIN solicitudes ON cursos.codigocurso = solicitudes.codigocurso
            WHERE solicitudes.codigocurso = :codigocurso
            GROUP BY solicitudes.codigocurso;");
        $stmt->bindParam(":codigocurso", $codigocurso);
        $stmt -> execute();
        $fila = $stmt -> fetch(PDO::FETCH_ASSOC);
        $nombre = $fila['nombre']; 
        if($fila['cursoAdm'] == 0) {
            return "Curso ".$nombre." sin asignacion.";
        }
        else{
            $stmt = $conex->prepare("UPDATE solicitudes SET admitido = 0 WHERE codigocurso = :codigocurso AND admitido = 1");
            $stmt->bindParam(":codigocurso", $codigocurso);
            $stmt->execute();
            return "Curso ".$nombre." vacio";
        }
    }
    function verAdmitidos($codigocurso){
        try {
            $conex = inbd();
            $stmt = $conex->prepare("SELECT cursos.nombre, solicitantes.dni, solicitantes.nombre, solicitantes.apellidos, solicitantes.telefono, solicitantes.correo, solicitantes.codcen, solicitudes.admitido
                FROM solicitantes 
                JOIN solicitudes ON solicitantes.dni = solicitudes.dni
                JOIN cursos ON solicitudes.codigocurso = cursos.codigocurso 
                WHERE solicitudes.codigocurso = :codigocurso ORDER BY solicitudes.admitido DESC");
            $stmt -> bindValue(':codigocurso', $codigocurso);
            $stmt -> execute();
            return $stmt;
        } catch(PDOException $e){
            echo "Error: ".$e->getMessage();
        }    
    }
?>