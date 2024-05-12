<?php
class reporte{
    function vista_cliente($sql_val) {
?>
        <center>
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
    $result = $mysqli->query($sql_val); 
    while ($registro = $result->fetch_assoc()){ 
        echo "<tr> 
                <td width='150'>".$registro['n_cuenta']."</td> 
                <td width='150'>".$registro['nombre']."</td> 
                <td width='150'>".$registro['apellido']."</td> 
                <td width='150'>".$registro['dni']."</td> 
            </tr>"; 
    } 
    $numero = $result->num_rows;
    echo "<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
?>
	</table> 
</div>
</center>
<?php
}

function vista_deposito($sql_val) {
	?>
	<center>
	<div class="datagrid">
		<h1>LISTADO DE DEPOSITO</h1>
		<table align="center" border="0" cellpadding="2" cellspacing="2">
		<thead>
			<th colspan="1" rowspan="1" align="center">CODIGO DEPOSITO</th> 
			<th colspan="1" rowspan="1" align="center">FECHA</th>
			<th width='150' colspan="1" rowspan="1" align="center">MONTO</th>
			<th width='150' colspan="1" rowspan="1" align="center">CLIENTE</th>
		</thead>
	<?php 
		include('conexion.php'); 
			$result = $mysqli->query($sql_val); 
			while ($registro = $result->fetch_assoc()){ 
				echo "<tr> 
					  <td width='150'>".$registro['cod_dep']."</td> 
					  <td width='150'>".$registro['fecha']."</td> 
					  <td width='150'>".$registro['monto']."</td> 
					  <td width='150'>".$registro['cliente']."</td> 
					</tr>"; 
			} 
		$numero = $result->num_rows;
		echo"<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
	?>
		</table> 
	</div>
	</center>
	<?php
	}

	function vista_retiro($sql_val) {
		?>
		<center>
		<div class="datagrid">
			<h1>LISTADO DE RETIROS</h1>
			<table align="center" border="0" cellpadding="2" cellspacing="2">
			<thead>
				<th colspan="1" rowspan="1" align="center">CODIGO RETIRO</th> 
				<th colspan="1" rowspan="1" align="center">FECHA</th>
				<th width='150' colspan="1" rowspan="1" align="center">MONTO</th>
				<th width='150' colspan="1" rowspan="1" align="center">CLIENTE</th>
			</thead>
		<?php 
			include('conexion.php'); 
				$result = $mysqli->query($sql_val); 
				while ($registro = $result->fetch_assoc()){ 
					echo "<tr> 
						  <td width='150'>".$registro['cod_ret']."</td> 
						  <td width='150'>".$registro['fecha']."</td> 
						  <td width='150'>".$registro['monto']."</td> 
						  <td width='150'>".$registro['cliente']."</td> 
						</tr>"; 
				} 
			$numero = $result->num_rows;
			echo"<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
		?>
			</table> 
		</div>
		</center>
		<?php
		}
		
		


		function vista_pago($sql_val) {
			?>
			<center>
			<div class="datagrid">
				<h1>LISTADO DE PAGOS DE SERVICIOS</h1>
				<table align="center" border="0" cellpadding="2" cellspacing="2">
				<thead>
					<th colspan="1" rowspan="1" align="center">CODIGO PAGO</th>
					<th colspan="1" rowspan="1" align="center">CONCEPTO</th>
					<th colspan="1" rowspan="1" align="center">FECHA</th>
					<th width='150' colspan="1" rowspan="1" align="center">MONTO</th>
					<th width='150' colspan="1" rowspan="1" align="center">CLIENTE</th>
				</thead>
			<?php 
				include('conexion.php'); 
					$result = $mysqli->query($sql_val); 
					while ($registro = $result->fetch_assoc()){ 
						echo "<tr> 
							  <td width='150'>".$registro['cod_pag']."</td> 
							  <td width='150'>".$registro['concepto']."</td> 
							  <td width='150'>".$registro['fecha']."</td> 
							  <td width='150'>".$registro['monto']."</td> 
							  <td width='150'>".$registro['cliente']."</td> 
							</tr>"; 
					} 
				$numero = $result->num_rows;
				echo"<thead><th width='150' colspan='7' rowspan='7' align='center'>El Total de Registros es de: $numero</th></thead>";
			?>
				</table> 
			</div>
			</center>
			<?php
			}
		}

?>