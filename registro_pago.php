<?php
$n_cuenta='';
$nombre='';
$apellido ='';
$saldo=0;

$cod_pag='';
$concepto='';
$fecha='';
$monto='';
$cliente='';

//realizar la conexion desde otro archivo
include('conexion.php');
include('modulo_listar.php'); 
$objeto1= new reporte;
$query = "select * from pago_servicios";
include('programacion.php'); 
$objeto2= new progra_pago;

//realizar la programacion de los botones
if (isset($_POST['boton1'])){
    //recibir los datos del formulario
     $n_cuenta = $_POST['select1'];
     $sql="select * from cliente where n_cuenta='$n_cuenta' ";
     $busqueda=$mysqli->query($sql);
     if($registro=$busqueda->fetch_array()){
        $n_cuenta= $registro['n_cuenta'];
        $nombre = $registro['nombre'];
        $apellido = $registro['apellido'];
        $cliente=$registro['n_cuenta'];
     }
    $sql2="select * from depositos where cliente='$n_cuenta' ";
     $busqueda2=$mysqli->query($sql2);
    while ($registro2 = $busqueda2->fetch_array()){ 
        $saldo = $saldo +$registro2['monto'];   
    }
}
if (isset($_POST['boton2'])){
    //recibir los datos del formulario

     $n_cuenta = $_POST['n_cuenta'];
     $concepto = $_POST['concepto'];
     $fecha = $_POST['fecha'];
     $monto = $_POST['monto'];
     $saldo = $_POST['saldo'];
     if($saldo>=$monto){
      $objeto2->guardar_pago($concepto,$fecha, $monto,$n_cuenta);
     }else{
      echo "<script>alert('No Puede Retirar Insuficiente Saldo')</script>";
      echo "<script>window.location='registro_pago.php'</script>";
     }
     
}     
     
// condicion para Buscar los datos
if (isset($_POST['boton3'])){
     //recibir los datos del formulario
     $cod_pag = $_POST['cod_pag'];
     $sql="select * from pago_servicios where cod_pag='$cod_pag' ";
     $busqueda=$mysqli->query($sql);
     if($registro=$busqueda->fetch_array()){
        $cod_pag = $registro['cod_pag'];
        $concepto = $registro['concepto'];
        $fecha = $registro['fecha'];
        $monto = $registro['monto'];
        $cliente = $registro['cliente'];
    }else{
      echo "<script>alert('Registro NO EXISTE en el Sistema')</script>";
     }
}   

// condicion para Eliminar los datos
if (isset($_POST["boton4"])){
    $cod_pag = $_POST['cod_pag'];
    $objeto2->eliminar_pago($cod_pag);
}
// condicion para Modificar los datos
if (isset($_POST["boton5"])){
    $cod_pag=$_POST['cod_pag'];
    $concepto=$_POST['concepto'];
    $fecha=$_POST['fecha'];
    $monto=$_POST['monto'];
    $cliente=$_POST['cliente'];
    $objeto2->modificar_pago($cod_pag,$concepto,$fecha,$monto,$cliente);
} 
     

// condicion para Linpiar los datos
if (isset($_POST["boton6"])){
 echo "<script>window.location='registro_pago.php'</script>";
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
<form action="registro_pago.php" method="post" name="form1">
<table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
  <tr>
    <td colspan="2"><center><h1> REGISTRO DE PAGOS DE SERVICIOS <h1></center></td>
  </tr>
  
  <tr>
    <td><div align="right">Seleccionar una Cuenta:</div></td>
    <td> 
    <?php
        $sql='select * from cliente';
        $resul=$mysqli->query($sql);
    ?>
        <select name='select1' id='select1' >
    <?php
            echo "<option value=''>Seleccionar Datos</option>";
        while($fila=$resul->fetch_array()){
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
    <td><div align="right">Codigo Pago:</div></td>
    <td><input name="cod_pag" type="text" size="40" maxlength="30" value="<?php echo $cod_pag ?>" /></td>
  </tr>
       <tr>
    <td><div align="right">Concepto:</div></td>
    <td><input name="concepto" type="text" size="40" maxlength="30" value="<?php echo $concepto ?>" /></td>
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
     $objeto1->vista_pago($query);
?>
<center><a href="pago.php">REGRESAR AL PAGO</a></center>

</body>

</html>
