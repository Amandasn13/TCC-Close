<?php
require_once 'Login_Cadastro.php';
session_start();
unset($_SESSION['IdUsuario']);
header("location: ../Close_Log02.php");
exit;
?>