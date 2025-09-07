<?php
session_start();
unset($_SESSION['documento']);
unset($_SESSION['contrasena']);
header("Location: vista/VLogin.html");
?>