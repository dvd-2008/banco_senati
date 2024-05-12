<?php 
include('conexion.php'); 

if (isset($_POST['boton1'])) {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $sql = "INSERT INTO usuarios (usuario, password) VALUES ('$usuario', '$password')";
    if(mysqli_query($mysqli, $sql)) {
        echo "<script>alert('Datos GUARDADOS Correctamente')</script>";
        echo "<script>window.location='usuarios.php'</script>";
    } else {
        echo "<script>alert('Datos no pudieron ser GUARDADOS')</script>";
    }
}

$id = "";
$usuario = "";
$password = "";

if (isset($_POST['boton2'])) {
    // Recibir los datos del formulario
    $id = $_POST['id'];
    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $busqueda = mysqli_query($mysqli, $sql);
    if($registro = mysqli_fetch_array($busqueda)) {
        $id = $registro['id'];
        $usuario = $registro['usuario'];
        $password = $registro['password'];
    } else {
        echo "<script>alert('Registro NO EXISTE en el Sistema')</script>";
    }
}

if (isset($_POST["boton3"])) {
    $id = $_POST['id'];
    if($id!="") {
        $sql = "DELETE FROM usuarios WHERE id='$id'";
        mysqli_query($mysqli, $sql);
        echo "<script>alert('Datos ELIMINADOS Correctamente')</script>";
        echo "<script>window.location='usuarios.php'</script>";
    } else {
        echo "<script>alert('Para poder ELIMINAR debe Realizar una busqueda')</script>";
    }
}
if (isset($_POST["boton4"])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    
    if($id!="") {
        $sql = "UPDATE usuarios SET usuario='$usuario', password='$password' WHERE id='$id'";
        if (mysqli_query($mysqli, $sql)) {
            echo "<script>alert('Datos MODIFICADOS Correctamente')</script>";
            echo "<script>window.location='usuarios.php'</script>";
        } else {
            echo "<script>alert('Error al modificar datos')</script>";
        }
    } else {
        echo "<script>alert('Para poder MODIFICAR debe realizar una búsqueda')</script>";
    }
}


?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sistema Basico</title>
    <link href="codigo.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center"><img src="imagenes/Logo2.jpg" /></div>
<form action="usuarios.php" method="post" name="form1">
<table width="50%" border="0" align="center" cellpadding="7" cellspacing="0">
  <tr>
    <td colspan="2"><center><h1> REGISTRO DE USUARIO <h1></center></td>
  </tr>
  <tr>
    <td><div align="right">ID USUARIO</div></td>
    <td><input name="id" type="text" size="25" maxlength="30" value="<?php echo $id ?>" /></td>
  </tr>
  <tr>
    <td><div align="right">USUARIO:</div></td>
    <td><input name="usuario" type="text" size="40" maxlength="30" value="<?php echo $usuario ?>" /></td>
  </tr>
  <tr>
    <td><div align="right">PASSWORD:</div></td>
    <td><input name="password" type="text" size="40" maxlength="30" value="<?php echo $password ?>" /></td>
  </tr>
  <tr>
    <td colspan="2">
    <div align="center">
      <table width="80%" border="0" cellpadding="5" cellspacing="0">
        <tr>
        <td><div align="center">
            <input type="submit" name="boton1" value="Guardar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton2" value="Buscar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton3" value="Eliminar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton4" value="Modificar" />
        </div></td>
        <td><div align="center">
            <input type="submit" name="boton5" value="Limpiar" />
        </div></td>
        </tr>
        </form>   
        <tr>
    
      </table>
    </div></td>
</tr>
</table>
<center>
<div class="datagrid">
    <h1>LISTADO DE USUARIO</h1>
    <table align="center" border="0" cellpadding="2" cellspacing="2">
    <thead>
        <th colspan="1" rowspan="1" align="center">ID USUARIOS</th> 
        <th colspan="1" rowspan="1" align="center">USUARIO</th>
        <th width='150' colspan="1" rowspan="1" align="center">PASSWORD</th>
    </thead>
    <?php 
        $query = "SELECT * FROM usuarios"; // Esta linea hace la consulta
        $result = mysqli_query($mysqli, $query); 
        while ($registro = mysqli_fetch_array($result)){ 
            echo "<tr> 
                  <td width='150'>".$registro['id']."</td> 
                  <td width='150'>".$registro['usuario']."</td> 
                  <td width='150'>".$registro['password']."</td> 
                </tr>"; 
        } 
    $numero = mysqli_num_rows($result);
    echo"<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
    ?>
    </table> 
</div> 
<a href="login.php">REGRESAR AL LOGIN</a></center>
</body>
</html>
