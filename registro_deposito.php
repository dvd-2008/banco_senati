<?php
$n_cuenta = '';
$nombre = '';
$apellido = '';
$saldo = 0;

$cod_dep = '';
$fecha = '';
$monto = '';
$cliente = '';

//realizar la conexion desde otro archivo
include('conexion.php');
include('modulo_listar.php');
$objeto1 = new reporte;
$query = "select * from depositos";
include('programacion.php');
$objeto2 = new progra_dep;

//realizar la programacion de los botones
if (isset($_POST['boton1'])) {
    //recibir los datos del formulario
    $n_cuenta = $_POST['select1'];
    $sql = "select * from cliente where n_cuenta='$n_cuenta' ";
    $busqueda = $mysqli->query($sql);
    if ($registro = $busqueda->fetch_array()) {
        $n_cuenta = $registro['n_cuenta'];
        $nombre = $registro['nombre'];
        $apellido = $registro['apellido'];
        $cliente = $registro['n_cuenta'];
    }
    $sql2 = "select * from depositos where cliente='$n_cuenta' ";
    $busqueda2 = $mysqli->query($sql2);
    while ($registro2 = $busqueda2->fetch_array()) {
        $saldo = $saldo + $registro2['monto'];
    }
}
if (isset($_POST['boton2'])) {
    //recibir los datos del formulario

    $n_cuenta = $_POST['n_cuenta'];
    if ($n_cuenta != "") {
        $fecha = $_POST['fecha'];
        $monto = $_POST['monto'];
        $objeto2->guardar_deposito($fecha, $monto, $n_cuenta);
    } else {
        echo "<script>alert('Para poder GUARDAR debe Realizar una busqueda')</script>";
        echo "<script>window.location='registro_deposito.php'</script>";
    }
}

// condicion para Buscar los datos
if (isset($_POST['boton3'])) {
    //recibir los datos del formulario
    $cod_dep = $_POST['cod_dep'];
    $sql = "select * from depositos where cod_dep='$cod_dep' ";
    $busqueda = $mysqli->query($sql);
    if ($registro = $busqueda->fetch_array()) {
        $cod_dep = $registro['cod_dep'];
        $fecha = $registro['fecha'];
        $monto = $registro['monto'];
        $cliente = $registro['cliente'];
    } else {
        echo "<script>alert('Registro NO EXISTE en el Sistema')</script>";
    }
}

// condicion para Eliminar los datos
if (isset($_POST["boton4"])) {
    $cod_dep = $_POST['cod_dep'];
    $objeto2->eliminar_deposito($cod_dep);
}
// condicion para Modificar los datos
if (isset($_POST["boton5"])) {
    $cod_dep = $_POST['cod_dep'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];
    $cliente = $_POST['cliente'];
    $objeto2->modificar_deposito($cod_dep, $fecha, $monto, $cliente);
}

// condicion para Linpiar los datos
if (isset($_POST["boton6"])) {
    echo "<script>window.location='registro_deposito.php'</script>";
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sistema Basico</title>
    <link href="codigo.css" rel="stylesheet" type="text/css">
</head>

<body>

    <style>
        /* Estilos para los botones */
        .custom-button {
    background-color: #D6222E; /* Color de fondo */
    color: white; /* Color del texto */
    border: none;
    padding: 15px 30px; /* Ajusta el padding según sea necesario */
    cursor: pointer;
    border-radius: 8px; /* Radio del borde */
    transition: transform 0.2s ease-in-out; /* Transición para agrandar el botón al pasar el mouse */
    margin-bottom: 10px; /* Agregamos un margen inferior para separar los botones */
}
        .custom-button:hover {
            transform: scale(1.1);
            /* Aumenta el tamaño del botón al pasar el mouse */
        }

         /* Estilos para los inputs */
    .custom-input {
        width: 300px; /* Ancho deseado */
        padding: 10px; /* Ajusta el relleno según sea necesario */
        border: 1px solid #ccc; /* Borde */
        border-radius: 5px; /* Radio del borde */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Sombra */
    }

    /* Estilos para las celdas de la tabla */
    td {
        padding: 10px; /* Ajusta el relleno según sea necesario */
    }

    /* Estilos para los nombres */
    .label {
        font-size: 18px; /* Tamaño de fuente */
        font-weight: bold; /* Negrita */
        color: #333; /* Color de texto */
        text-align: right; /* Alineación del texto */
    }

    .custom-select {
    width: 50%; /* Ancho completo */
    padding: 10px; /* Ajusta el relleno según sea necesario */
    border: 1px solid #ccc; /* Borde */
    border-radius: 5px; /* Radio del borde */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Sombra */
    box-sizing: border-box; /* Incluimos el padding y el borde en el ancho total */
    margin-bottom: 10px; /* Agregamos un margen inferior para separar los inputs */
}
    </style>




    <div align="center"><img src="imagenes/Logo2.jpg" />
    </div>
    <form action="registro_deposito.php" method="post" name="form1">
        <table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
            <tr>
                <td colspan="2">
                    <center>
                        <h1> REGISTRO DE DEPOSITOS <h1>
                    </center>
                </td>
            </tr>

            <tr>
            <td class="label">
        <div align="right">Seleccionar una Cuenta:</div>
    </td>
                <td>
                    <?php
                    $mysql = 'select * from cliente';
                    $resul = $mysqli->query($mysql);
                    ?>
                     <select name='select1' id='select1' class="custom-select">
                        <?php
                        echo "<option value=''>Seleccionar Datos</option>";
                        while ($fila = $resul->fetch_array()) {
                            echo "<option value='" . $fila['n_cuenta'] . "'>" . $fila['n_cuenta'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" name="boton1" value="Mostrar" class="custom-button" />
                </td>
            </tr>

            <tr>
            <td class="label">
                    <div align="right">Cuenta:</div>
                </td>
                <td><input name="n_cuenta" type="text" size="40" maxlength="30" value="<?php echo $n_cuenta ?>" class="custom-input"/></td>
            </tr>
            <tr>
            <td class="label">
                    <div align="right">Nombre y Apellido:</div>
                </td>
                <td><input name="nombre" type="text" size="40" maxlength="30" value="<?php echo $nombre . ' ' . $apellido ?>" class="custom-input"/></td>
            </tr>
            <tr>
            <td class="label">
                    <div align="right">Saldo de la Cuenta:</div>
                </td>
                <td><input name="saldo" type="text" size="40" maxlength="30" value="<?php echo $saldo ?>"class="custom-input"    /></td>
            </tr>
        </table>

        <hr>

        <table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
            <tr>
                <td class="label">
                    <div align="right">Codigo Deposito:</div>
                </td>
                <td><input name="cod_dep" type="text" size="40" maxlength="30" value="<?php echo $cod_dep ?>" class="custom-input" /></td>
            </tr>
            <tr>
                <td class="label">
                    <div align="right">Fecha:</div>
                </td>
                <td><input name="fecha" type="text" size="40" maxlength="30" value="<?php echo $fecha ?>" class="custom-input"/></td>
            </tr>
            <tr>
                <td class="label">
                    <div align="right">Monto:</div>
                </td>
                <td><input name="monto" type="text" size="40" maxlength="30" value="<?php echo $monto ?>" class="custom-input"/></td>
            </tr>
            <tr>
                <td class="label">
                    <div align="right">Cliente:</div>
                </td>
                <td><input name="cliente" type="text" size="40" maxlength="30" value="<?php echo $cliente ?>" class="custom-input"  /></td>
            </tr>

            <tr>
                <td colspan="2">
                    <div align="center">
                        <table width="80%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td>
                                    <div align="center">
                                        <input type="submit" name="boton2" value="Guardar" class="custom-button" />
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <input type="submit" name="boton3" value="Buscar" class="custom-button" />
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <input type="submit" name="boton4" value="Eliminar" class="custom-button" />
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <input type="submit" name="boton5" value="Modificar" class="custom-button" />
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <input type="submit" name="boton6" value="Limpiar" class="custom-button" />
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <?php
    $objeto1->vista_deposito($query);
    ?>
    <center><a href="deposito.php">REGRESAR AL DEPOSITO</a></center>

</body>

</html>