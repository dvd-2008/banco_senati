<html> 
<head> 
<TITLE>Consulta de Usuarios</TITLE> 
<link href="codigo.css" rel="stylesheet" type="text/css">

<style>
    /* Estilos para el mensaje de bienvenida */
    .welcome-message {
        font-size: 18px;
        font-weight: bold;
        color: #333333;
        margin-top: 20px;
    }

    /* Estilos para el botón personalizado */
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

</head> 
<body> 

<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if(isset($_SESSION['login_user'])) {
    // Mensaje de bienvenida personalizado
    $welcome_message = "Bienvenido ".$_SESSION['login_user']." al sistema Banco Senati";
} else {
    // Si el usuario no ha iniciado sesión, muestra un mensaje genérico
    $welcome_message = "Bienvenido al sistema Banco Senati";
}

// Muestra el mensaje de bienvenida
echo "<div class='welcome-message'>$welcome_message</div>";
?>

<center>
<div align="center"><img src="imagenes/Logo2.jpg" />
<br><br><br>
<div class="datagrid">
    <!-- Agregar botón de cierre de sesión -->
    <form action="logout.php" method="post">
        <button type="submit" class="custom-button" style="position: absolute; top: 10px; right: 10px;">Cerrar Sesión</button>
    </form>
    <!-- Fin de botón de cierre de sesión -->

    <h1>MENU PRINCIPAL</h1>
    <table align="center" border="0" cellpadding="2" cellspacing="2">
    <thead>
        <th colspan="1" rowspan="1" align="center">CLIENTES</th> 
        <th colspan="1" rowspan="1" align="center">DEPOSITOS</th>
        <th width='150' colspan="1" rowspan="1" align="center">RETIROS</th>
        <th width='150' colspan="1" rowspan="1" align="center">PAGO DE SERVICIOS</th>
    </thead>
        <tr> 
            <td width='150'><a href="clientes.php"> CLIENTES</a></td> 
            <td width='150'><a href="deposito.php"> DEPOSITOS</a></td> 
            <td width='150'><a href="retiro.php"> RETIROS</a></td> 
            <td width='150'><a href="pago.php"> PAGO SERVICIOS</a></td> 
        </tr>
    </table> 
</div> 
</body> 
</center>
</html>
