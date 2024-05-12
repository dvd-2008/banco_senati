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

	<h1>PAGOS DE SERVICIOS REALIZADOS</h1>
	<table align="center" border="0" cellpadding="2" cellspacing="2">
	<thead>
		<th colspan="1" rowspan="1" align="center">CODIGO PAGO</th> 
		<th colspan="1" rowspan="1" align="center">CONCEPTO</th>
		<th colspan="1" rowspan="1" align="center">FECHA</th>
		<th width='150' colspan="1" rowspan="1" align="center">MONTO</th>
		<th width='150' colspan="1" rowspan="1" align="center">CUENTA CLIENTE</th>
	</thead>

	<?php 
	include('conexion.php'); 
		$query = "select * from pago_servicios";     // Esta linea hace la consulta
		$result = $mysqli->query($query); 
		while ($registro = $result->fetch_assoc()){ 
			echo "<tr> 
				  <td width='150'>".$registro['cod_pag']."</td> 
				  <td width='150'>".$registro['concepto']."</td> 
				  <td width='150'>".$registro['fecha']."</td> 
				  <td width='150'>".$registro['monto']."</td> 
				  <td width='150'>".$registro['cliente']."</td> 
				</tr>"; 
		} 
	?>

	<?php
	$numero = $result->num_rows;
	echo"<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
	?>
	</table> 

</div> 
<br>
	<br>
	<a href="menu.php">MENU</a><br>
	<a href="registro_pago.php">MANTENIMIENTO PAGO</a>
</body> 
</center>
</html> 
