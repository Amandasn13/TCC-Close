<?php
require_once 'funcoes_usuario.php';
session_start();
unset($_SESSION['IdUsuario']);
header("location: ../Close_Log02.php");
exit;
?>