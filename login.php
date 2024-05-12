<?php
include("conexion.php");
session_start();
 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Usamos el nombre de usuario enviado de nuestro formulario
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];
 
    // Consulta preparada para evitar inyección SQL
    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $myusername, $mypassword);
    $stmt->execute();
    $result = $stmt->get_result();
 
    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {
            $_SESSION['login_user'] = $obj->usuario;
        }
        echo "<script>alert('BIENVENIDO AL SISTEMA DE BANCO')</script>";
        echo "<script>window.location='menu.php'</script>";
    } else {
        echo "<script>alert('INCORRECTO USUARIO O PASSWORD')</script>";
    }
}
 
?>
<html>
 
<head>
    <title>Login Page</title>
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            background-color: #FFFFFF;
        }
 
        .container {
            width: 300px;
            margin: 0 auto; /* Centrar el contenedor */
            margin-top: 50px; /* Espacio superior */
            border: 1px solid #333333;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75); /* Sombra */
        }
 
        .header {
            background-color: #333333;
            color: #FFFFFF;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
 
        .content {
            padding: 20px;
        }
 
        label {
            font-weight: bold;
            font-size: 14px;
        }
 
        .box {
            border: #666666 solid 1px;
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }
 
        .input-text {
            width: calc(100% - 22px); /* Ajustar el ancho del input */
            padding: 5px;
            border: none;
            background-color: #f2f2f2; /* Color de fondo */
            border-radius: 5px;
        }
 
        .submit-button {
            background-color: #D6222E;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s ease-in-out;
            width: 100%;
            font-size: 16px;
        }
 
        .submit-button:hover {
            transform: scale(1.1);
        }
 
        .register-link {
            font-size: 12px;
            text-align: right;
            color: #333333;
            text-decoration: none;
        }
    </style>
</head>
 
<body>
    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        <div class="content">
            <form action="" method="post">
                <label for="username">UserName :</label><br>
                <input type="text" name="username" class="box input-text" placeholder="Ingrese su nombre de usuario" required/><br><br>
                <label for="password">Password :</label><br>
                <input type="password" name="password" class="box input-text" placeholder="Ingrese su contraseña" required/><br><br>
                <input type="submit" value="Submit" class="submit-button" /><br><br>
                <label class="register-link"><a href="usuarios.php">Regístrate</a></label><br />
            </form>
        </div>
    </div>
</body>
 
</html>
