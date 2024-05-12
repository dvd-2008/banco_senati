<html> 
<head> 
<TITLE>Consulta de Usuarios </TITLE> 
<link href="codigo.css" rel="stylesheet" type="text/css">
</head> 
<body> 
<center>
<div align="center"><img src="imagenes/Logo2.jpg" />
<br><br><br>
<div class="datagrid">

	<h1>LISTADO DE CLIENTES</h1>
	<table align="center" border="0" cellpadding="2" cellspacing="2">
	<thead>
		<th colspan="1" rowspan="1" align="center">N_CUENTA</th> 
		<th colspan="1" rowspan="1" align="center">NOMBRE</th>
		<th width='150' colspan="1" rowspan="1" align="center">APELLIDO</th>
		<th width='150' colspan="1" rowspan="1" align="center">DNI</th>
	</thead>

	<?php 
	include('conexion.php');

	  $sql = "SELECT * FROM cliente";		// Esta linea hace la consulta
	  $result = $mysqli->query($sql);
	  
      while($obj = $result->fetch_object()){
		  echo "<tr>
			<td width='150'>".$obj->n_cuenta."</td> 
            <td width='150'>".$obj->nombre."</td>
			<td width='150'>".$obj->apellido."</td>
			<td width='150'>".$obj->dni."</td>
			</tr>"; 
        } 
	?>

	<?php
	$numero = mysqli_num_rows($result);
	
	echo"<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
	?>
	</table> 

</div> 
<br>
	<br>
	<a href="menu.php">MENU</a><br>
	<a href="registro_cliente.php">REGISTRO DEL CLIENTE</a>
	
</body> 
</center>
</html> 
