<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión.
session_unset();

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir a la página de inicio de sesión u otra página según lo desees.
header("Location: login.php");
exit;
?>
