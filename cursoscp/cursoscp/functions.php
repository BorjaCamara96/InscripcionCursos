<?php
    function validarInputDni($valor){
        if(preg_match('/^[0-9]{8}[A-Z]$/', $valor)){
            $numero = substr($valor, 0, 8); 
            $letra = substr($valor, -1);
            $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            return $letra === $letras[$numero%23] ? false : true ; 
        }
        return true;
    }
    function validarInputTextEmpty($valor){
        $valor = trim($valor);
        return !empty($valor) ? false : true;
    }
    function validarInputTexto($valor){
        $regex = "/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/";
        return preg_match($regex, $valor) ? false : true ;
    }
    function validarInputTelefono($valor){
        $regex = "/^[0-9]{9}$/";
        return preg_match($regex, $valor) ? false : true ; 
    }
    function validarInputCorreo($valor){
        $regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        return preg_match($regex, $valor) ? false : true ; 
    }
    function validarInputNumero($valor, $num){
        $regex = "/^[0-9]{".$num."}$/";
        return preg_match($regex, $valor) ? false : true ; 
    }       
    function validarInputDate($valor){
        $fechaValor = new DateTime($valor);
        $fechaHoy = new DateTime();
        return ($fechaHoy > $fechaValor) ? true : false ; 

    }
    function dibujaInputText($nombre, $alias, $error){
        $formulario = 
        "<tr>
            <td>".$nombre.": </td>
            <td><input type='text' name='".$alias."' placeholder='Introduce ".$nombre."'";
            if(!$error) $formulario .= "value='".$_POST[$alias]."'";
            $formulario .= "/></td>";
            if($error) $formulario .= "<td>El campo ".$nombre." no es valido</td>";
        $formulario .= "</tr>";
        return $formulario;
    }
    function dibujaInputNumber($nombre, $alias, $error){
        $formulario = 
        "<tr>
            <td>".$nombre.": </td>
            <td><input type='number' name='".$alias."' placeholder='Introduce ".$nombre."'";
            if(!$error) $formulario .= "value='".$_POST[$alias]."'";
            $formulario .= "/></td>";
            if($error) $formulario .= "<td>El campo ".$nombre." no es valido</td>";
        $formulario .= "</tr>";
        return $formulario;
    }
    function dibujaInputPass($nombre, $alias, $error){
        $formulario = 
        "<tr>
            <td>".$nombre.": </td>
            <td><input type='password' name='".$alias."' placeholder='Introduce ".$nombre."'";
            if(!$error) $formulario .= "value='".$_POST[$alias]."'";
            $formulario .= "/></td>";
            if($error) $formulario .= "<td>El campo ".$nombre." no es valido</td>";
        $formulario .= "</tr>";
        return $formulario;
    }
    function dibujaSelect($nombre, $alias, $array, $error, $campoVacio){
        $formulario = "<tr>
            <td>".$nombre.": </td>
            <td><select name='".$alias."'>";
                if($campoVacio) echo "<option value=''></option>";
                foreach($array as $opcion){
                    $formulario .= "<option value='".$opcion."'";
                        if(!$error){
                            if($opcion == $_POST[$alias]) $formulario .= "selected";
                        }
                    $formulario .=">".$opcion."</option>";
                }
        $formulario .= "</select></td>";
        if($error) $formulario .= "<td>El campo ".$nombre." no es valido</td>";
        $formulario .= "</tr>";
        return $formulario;
    }
    function dibujaInputCheck($nombre, $alias, $error){
        $formulario = 
        "<tr>
            <td>".$nombre.": </td>
            <td><input type='checkbox' name='".$alias."'";
            if($error) $formulario .= "checked";
            $formulario .= "/></td>
        </tr>";
        return $formulario;
    }
    function dibujaInputDate($nombre, $alias, $error){
        $formulario = 
        "<tr>
            <td>".$nombre.": </td>
            <td><input type='date' name='".$alias."'";
            if(!$error) $formulario .= "value='".$_POST[$alias]."'";
            $formulario .= "/></td>";
            if($error) $formulario .= "<td>El campo ".$nombre." no es valido</td>";
        $formulario .= "</tr>";
        return $formulario;
    }
    function dibujaInputRadio($nombre, $alias, $array, $error){
        $formulario = 
        "<tr>
            <td>".$nombre.": </td>
            <td>";
                foreach($array as $opcion){
                    $formulario .= $opcion."<input type='radio' name='".$alias."' value='".strtolower($opcion)."'";
                        if($_POST[$alias] == strtolower($opcion)) $formulario .= "checked";
                    $formulario .= "/>";
                }
            $formulario .= "</td>";
        if($error) $formulario .= "<td>El campo ".$nombre." no es valido</td>";
        $formulario .= "</tr>";
        return $formulario;
    }
    function dibujaInputBoton($nombre, $alias, $type){
        $formulario = "<td><input type='".$type."' name='".$alias."' value='".$nombre."'/></td>";
        return $formulario;
    }
    
?>