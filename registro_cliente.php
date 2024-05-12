<?php
	$n_cuenta='';
	$nombre='';
	$apellido ='';
	$dni ='';
//realizar la conexion desde otro archivo
include('conexion.php');
include('modulo_listar.php'); 
	 $objeto1= new reporte;
	 $query = "select * from cliente";
include('programacion.php'); 
	 $objeto2= new progra_cli;
//realizar la programacion de los botones
if (isset($_POST['boton1'])){
    // Recibir los datos del formulario
    $n_cuenta = $_POST['n_cuenta'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    
    // Llamar a la función guardar_cliente() desde programacion.php
    $objeto2->guardar_cliente($n_cuenta, $nombre, $apellido, $dni);
    
    // Mostrar la alerta de éxito usando SweetAlert2
    echo "<script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Éxito',
                text: 'Registro Guardado con Éxito',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>";
}

// condicion para Buscar los datos
if (isset($_POST['boton2'])){
    //recibir los datos del formulario
    $n_cuenta = $_POST['n_cuenta'];
    // Realizar la conexión
    include('conexion.php');
    // Preparar la consulta usando MySQLi
    $sql = "SELECT * FROM cliente WHERE n_cuenta='$n_cuenta'";
    $resultado = $mysqli->query($sql);
    if ($resultado) {
        // Comprobar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Obtener la primera fila de resultados
            $registro = $resultado->fetch_assoc();
            $n_cuenta = $registro['n_cuenta'];
            $nombre = $registro['nombre'];
            $apellido = $registro['apellido'];
            $dni = $registro['dni'];
        } else {
            // Si no se encontraron resultados
            echo "<script>alert('Registro NO EXISTE en el Sistema')</script>";
        }
        // Liberar el resultado
        $resultado->free();
    } else {
        // Si hubo un error en la consulta
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    // Cerrar la conexión
    $mysqli->close();
}
// condicion para Eliminar los datos
if (isset($_POST["boton3"])){
	$n_cuenta = $_POST['n_cuenta'];
	$objeto2->eliminar_cliente($n_cuenta);
}
// condicion para Modificar los datos
if (isset($_POST["boton4"])){
	 $n_cuenta = $_POST['n_cuenta'];
	 $nombre = $_POST['nombre'];
	 $apellido = $_POST['apellido'];
	 $dni = $_POST['dni'];	
	$objeto2->modificar_cliente($n_cuenta, $nombre,$apellido,$dni);
}
// condicion para Linpiar los datos
if (isset($_POST["boton4"])){
 echo "<script>window.location='registro_cliente.php'</script>";
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sistema Basico</title>
    <link href="codigo.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<style>
    /* Estilos para los inputs */
    input[type="text"] {
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

    
</style>
<body>
<div align="center"><img src="imagenes/Logo2.jpg" />
</div>
<form action="registro_cliente.php" method="post" name="form1">
<table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
  <tr>
    <td colspan="2"><center><h1> REGISTRO DE CLIENTES <h1></center></td>
  </tr>
  <tr>
    <td class="label"><div align="right">N_cuenta:</div></td>
    <td><input name="n_cuenta" type="text" size="40" maxlength="30" value="<?php echo $n_cuenta ?>" /></td>
  </tr>
  <tr>
    <td class="label"><div align="right">Nombre:</div></td>
    <td><input name="nombre" type="text" size="40" maxlength="30" value="<?php echo $nombre ?>" /></td>
  </tr>
  <tr>
    <td class="label"><div align="right">Apellido:</div></td>
    <td><input name="apellido" type="text" size="40" maxlength="30" value="<?php echo $apellido ?>" /></td>
  </tr>
  <tr>
    <td class="label"><div align="right">DNI:</div></td>
    <td><input name="dni" type="text" size="40" maxlength="30" value="<?php echo $dni ?>" /></td>
  </tr>
  <tr>
    <td colspan="2">
	<div align="center">
    <style>
   .custom-button {
        background-color: #D6222E; /* Color de fondo */
        color: white; /* Color del texto */
        border: none;
        padding: 15px 30px; /* Ajusta el padding según sea necesario */
        cursor: pointer;
        border-radius: 8px; /* Radio del borde */
        transition: transform 0.2s ease-in-out; /* Transición para agrandar el botón al pasar el mouse */
    }

    .custom-button:hover {
        transform: scale(1.1); /* Aumenta el tamaño del botón al pasar el mouse */
    }   
</style>
    
      <table width="80%" border="0" cellpadding="5" cellspacing="0">
        <tr>
        <td><div align="center">
        <input type="submit" name="boton1" value="Guardar" class="custom-button" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton2" value="Buscar" class="custom-button" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton3" value="Eliminar"  class="custom-button"/>
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton4" value="Modificar" class="custom-button"/>
        </div></td>
		<td><div align="center">
            <input type="submit" name="boton5" value="Limpiar" class="custom-button"/>
        </div></td>
		</tr>
		</form>	
		<tr>
		<td  colspan="5"><div align="center">
		<form action="reporte2.php" method="post" name="form2">
			<input type="hidden" name="variable1" value="<?php echo $n_cuenta ?>" />
            <input type="submit" name="boton6" value="Reporte" />
		</form>	
        </div></td>
		
      </table>
    </div></td>
</tr>
</table>
</form>
<?php
	 $objeto1->vista_cliente($query);
?>
<center><a href="reporte1.php">REPORTE DE CLIENTE</a></center><br>
<center><a href="clientes.php">REGRESAR AL CLIENTE</a></center>

</body>

</html>