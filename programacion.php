<?php
include('conexion.php');
class progra_cli{
	function guardar_cliente($n_cuenta, $nombre, $apellido, $dni) {
        include('conexion.php');
        $sql = "INSERT INTO cliente (n_cuenta, nombre, apellido, dni) VALUES ('$n_cuenta', '$nombre', '$apellido', '$dni')";
        if ($mysqli->query($sql) === TRUE) {
            echo "<script>alert('Registro Guardado con Éxito')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        $mysqli->close();	
}

// En el archivo programacion.php, en la función eliminar_cliente

public function eliminar_cliente($n_cuenta) {
    include('conexion.php');
    // Preparar la consulta usando MySQLi
    $sql = "DELETE FROM cliente WHERE n_cuenta = '$n_cuenta'";
    if ($mysqli->query($sql)) {
        echo "<script>alert('Registro eliminado correctamente')</script>";
    } else {
        echo "Error al eliminar el registro: " . $mysqli->error;
    }
    // Cerrar la conexión
    $mysqli->close();
}


// En el archivo programacion.php, en la función modificar_cliente

public function modificar_cliente($n_cuenta, $nombre, $apellido, $dni) {
    include('conexion.php');
    // Preparar la consulta usando MySQLi
    $sql = "UPDATE cliente SET nombre = '$nombre', apellido = '$apellido', dni = '$dni' WHERE n_cuenta = '$n_cuenta'";
    if ($mysqli->query($sql)) {
        echo "<script>alert('Registro modificado correctamente')</script>";
    } else {
        echo "Error al modificar el registro: " . $mysqli->error;
    }
    // Cerrar la conexión
    $mysqli->close();
}

}
class progra_dep{
    function guardar_deposito($fecha, $monto, $n_cuenta) {
        global $mysqli; // Declarar $mysqli como una variable global
        // condicion para Almacenar los datos
        $sql = "insert into depositos(fecha, monto, cliente) values ('$fecha', '$monto', '$n_cuenta')";
        if ($mysqli->query($sql)) {
            echo "<script>alert('Datos GUARDADOS Correctamente')</script>";
            echo "<script>window.location='registro_deposito.php'</script>";
        } else {
            echo "<script>alert('Datos no pudieron ser GUARDADOS')</script>";
        }
    }

    function eliminar_deposito($cod_dep) {
        global $mysqli; // Declarar $mysqli como una variable global
        if ($cod_dep != "") {
            $sql = "delete from depositos where cod_dep='$cod_dep'";
            $mysqli->query($sql);
            echo "<script>alert('Datos ELIMINADOS Correctamente')</script>";
            echo "<script>window.location='registro_deposito.php'</script>";
        } else {
            echo "<script>alert('Para poder ELIMINAR debe Realizar una busqueda')</script>";
            echo "<script>window.location='registro_deposito.php'</script>";
        }
    }

    function modificar_deposito($cod_dep, $fecha, $monto, $cliente) {
        global $mysqli; // Declarar $mysqli como una variable global
        if ($cod_dep != "") {
            $sql = "update depositos set fecha='$fecha', monto='$monto', cliente='$cliente' where cod_dep='$cod_dep'";
            $mysqli->query($sql);
            echo "<script>alert('Datos Modificados Correctamente')</script>";
            echo "<script>window.location='registro_deposito.php'</script>";
        } else {
            echo "<script>alert('Para poder Modificadar debe Realizar una busqueda')</script>";
            echo "<script>window.location='registro_deposito.php'</script>";
        }
    }
}

class progra_ret {
    function guardar_retiro($fecha, $monto, $n_cuenta) {
        global $mysqli;
        $sql = "INSERT INTO retiros (fecha, monto, cliente) VALUES ('$fecha', '$monto', '$n_cuenta')";
        if ($mysqli->query($sql)) {
            echo "<script>alert('Datos GUARDADOS Correctamente')</script>";
            echo "<script>window.location='registro_retiro.php'</script>";
        } else {
            echo "<script>alert('Datos no pudieron ser GUARDADOS')</script>";
        }
    }

    function eliminar_retiro($cod_ret) {
        global $mysqli;
        if ($cod_ret != "") {
            $sql = "DELETE FROM retiros WHERE cod_ret='$cod_ret'";
            $mysqli->query($sql);
            echo "<script>alert('Datos ELIMINADOS Correctamente')</script>";
            echo "<script>window.location='registro_retiro.php'</script>";
        } else {
            echo "<script>alert('Para poder ELIMINAR debe Realizar una busqueda')</script>";
            echo "<script>window.location='registro_retiro.php'</script>";
        }
    }

    function modificar_retiro($cod_ret, $fecha, $monto, $cliente) {
        global $mysqli;
        if ($cod_ret != "") {
            $sql = "UPDATE retiros SET fecha='$fecha', monto='$monto', cliente='$cliente' WHERE cod_ret='$cod_ret'";
            $mysqli->query($sql);
            echo "<script>alert('Datos Modificados Correctamente')</script>";
            echo "<script>window.location='registro_retiro.php'</script>";
        } else {
            echo "<script>alert('Para poder Modificar debe Realizar una busqueda')</script>";
            echo "<script>window.location='registro_retiro.php'</script>";
        }
    }
}



class progra_pago {
    function guardar_pago($concepto, $fecha, $monto, $n_cuenta) {
        global $mysqli;
        $sql = "INSERT INTO pago_servicios (concepto, fecha, monto, cliente) VALUES ('$concepto', '$fecha', '$monto', '$n_cuenta')";
        if ($mysqli->query($sql)) {
            echo "<script>alert('Datos GUARDADOS Correctamente')</script>";
            echo "<script>window.location='registro_pago.php'</script>";
        } else {
            echo "<script>alert('Datos no pudieron ser GUARDADOS')</script>";
        }
    }

    function eliminar_pago($cod_pag) {
        global $mysqli;
        if ($cod_pag != "") {
            $sql = "DELETE FROM pago_servicios WHERE cod_pag='$cod_pag'";
            $mysqli->query($sql);
            echo "<script>alert('Datos ELIMINADOS Correctamente')</script>";
            echo "<script>window.location='registro_pago.php'</script>";
        } else {
            echo "<script>alert('Para poder ELIMINAR debe Realizar una busqueda')</script>";
            echo "<script>window.location='registro_pago.php'</script>";
        }
    }

    function modificar_pago($cod_pag, $concepto, $fecha, $monto, $cliente) {
        global $mysqli;
        if ($cod_pag != "") {
            $sql = "UPDATE pago_servicios SET concepto='$concepto', fecha='$fecha', monto='$monto', cliente='$cliente' WHERE cod_pag='$cod_pag'";
            $mysqli->query($sql);
            echo "<script>alert('Datos Modificados Correctamente')</script>";
            echo "<script>window.location='registro_pago.php'</script>";
        } else {
            echo "<script>alert('Para poder Modificadar debe Realizar una busqueda')</script>";
            echo "<script>window.location='registro_pago.php'</script>";
        }
    }
}	




