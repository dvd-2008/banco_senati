<?php
include('conexion.php');
include('modulo_listar.php'); 
$objeto1 = new reporte;
$query = "select * from retiros";
include('programacion.php'); 
$objeto2 = new progra_ret;

$n_cuenta = '';
$nombre = '';
$apellido = '';
$saldo = 0;

$cod_ret = '';
$fecha = '';
$monto = '';
$cliente = '';

//realizar la programacion de los botones
// Realizar la programación de los botones
if (isset($_POST['boton1'])) {
    // Recibir los datos del formulario
    $n_cuenta = $_POST['select1'];
    $sql = "select * from cliente where n_cuenta='$n_cuenta' ";
    $busqueda = mysqli_query($mysqli, $sql); // Corregir esta línea
    if ($registro = mysqli_fetch_array($busqueda)) {
        $n_cuenta = $registro['n_cuenta'];
        $nombre = $registro['nombre'];
        $apellido = $registro['apellido'];
        $cliente = $registro['n_cuenta'];
    }
    $sql2 = "select * from depositos where cliente='$n_cuenta' ";
    $busqueda2 = mysqli_query($mysqli, $sql2); // Corregir esta línea
    while ($registro2 = mysqli_fetch_array($busqueda2)) {
        $saldo = $saldo + $registro2['monto'];
    }
}

if (isset($_POST['boton2'])) {
    //recibir los datos del formulario
    $n_cuenta = $_POST['n_cuenta'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];
    $saldo = $_POST['saldo'];
    if ($saldo >= $monto) {
        $objeto2->guardar_retiro($fecha, $monto, $n_cuenta);
    } else {
        echo "<script>alert('No Puede Retirar Insuficiente Saldo')</script>";
        echo "<script>window.location='registro_retiro.php'</script>";
    }
}

    // Condición para Buscar los datos
	if (isset($_POST['boton3'])) {
		// Recibir los datos del formulario
		$cod_ret = $_POST['cod_ret'];
		$sql = "select * from retiros where cod_ret='$cod_ret' ";
		$busqueda = mysqli_query($mysqli, $sql); // Corregir esta línea
		if ($registro = mysqli_fetch_array($busqueda)) {
			$cod_ret = $registro['cod_ret'];
			$fecha = $registro['fecha'];
			$monto = $registro['monto'];
			$cliente = $registro['cliente'];
		} else {
			echo "<script>alert('Registro NO EXISTE en el Sistema')</script>";
		}
	}

    // Condición para Eliminar los datos
    if (isset($_POST["boton4"])){
        $cod_ret = $_POST['cod_ret'];
        $objeto2->eliminar_retiro($cod_ret);
    }

    // Condición para Modificar los datos
    if (isset($_POST["boton5"])){
        $cod_ret=$_POST['cod_ret'];;
        $fecha=$_POST['fecha'];;
        $monto=$_POST['monto'];;
        $cliente=$_POST['cliente'];;
        $objeto2->modificar_retiro($cod_ret, $fecha,$monto,$cliente);
    } 

    // Condición para Limpiar los datos
    if (isset($_POST["boton6"])){
        echo "<script>window.location='registro_retiro.php'</script>";
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Basico</title>
<link href="codigo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center"><img src="imagenes/Logo2.jpg" />
</div>
<form action="registro_retiro.php" method="post" name="form1">
<table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
  <tr>
    <td colspan="2"><center><h1> REGISTRO DE RETIROS <h1></center></td>
  </tr>
  
  <tr>
    <td><div align="right">Seleccionar una Cuenta:</div></td>
    <td> 
    <?php
      $sql = 'select * from cliente';
	  $resul = mysqli_query($mysqli, $sql);
	  
    ?>
        <select name='select1' id='select1' >
    <?php
            echo "<option value=''>Seleccionar Datos</option>";
        while($fila=mysqli_fetch_array($resul)){
            echo "<option value='".$fila['n_cuenta']."'>".$fila['n_cuenta']."</option>";
        }
    ?>
        </select>
        <input type="submit" name="boton1" value="Mostrar" />
    </td>           
    </tr>

     <tr>
    <td><div align="right">Cuenta:</div></td>
    <td><input name="n_cuenta" type="text" size="40" maxlength="30" value="<?php echo $n_cuenta ?>" /></td>
  </tr>
  <tr>
    <td><div align="right">Nombre y Apellido:</div></td>
    <td><input name="nombre" type="text" size="40" maxlength="30" value="<?php echo $nombre.' '.$apellido ?>" /></td>
  </tr>
    <tr>
    <td><div align="right">Saldo de la Cuenta:</div></td>
    <td><input name="saldo" type="text" size="40" maxlength="30" value="<?php echo $saldo ?>" /></td>
  </tr>
</table>

<hr>

<table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
     <tr>
    <td><div align="right">Codigo Retiro:</div></td>
    <td><input name="cod_ret" type="text" size="40" maxlength="30" value="<?php echo $cod_ret ?>" /></td>
  </tr>
       <tr>
    <td><div align="right">Fecha:</div></td>
    <td><input name="fecha" type="text" size="40" maxlength="30" value="<?php echo $fecha ?>" /></td>
  </tr>
       <tr>
    <td><div align="right">Monto:</div></td>
    <td><input name="monto" type="text" size="40" maxlength="30" value="<?php echo $monto ?>" /></td>
  </tr>
       <tr>
    <td><div align="right">Cliente:</div></td>
    <td><input name="cliente" type="text" size="40" maxlength="30" value="<?php echo $cliente ?>" /></td>
  </tr>

  <tr>
    <td colspan="2">
    <div align="center">
      <table width="80%" border="0" cellpadding="5" cellspacing="0">
        <tr>
        <td><div align="center">
            <input type="submit" name="boton2" value="Guardar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton3" value="Buscar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton4" value="Eliminar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton5" value="Modificar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton6" value="Limpiar" />
        </div></td>
        </tr>
      </table>
    </div></td>
</tr>
</table>
</form>
<?php
     $objeto1->vista_retiro($query);
?>
<center><a href="retiro.php">REGRESAR AL RETIRO</a></center>

</body>

</html>

