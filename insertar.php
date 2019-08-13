<?php
require_once 'config/conexion.php';
$db= new conexion();
$nombre=$_POST['txtNombre'];
$usuario=$_POST['txtusuario'];
$password=$_POST['txtpassword'];
$encript=md5($password);
$sql="INSERT INTO usuarios(Nombre, usuario, password) VALUES ('$nombre', '$usuario', '$encript')";
$usr_query=mysqli_query($db, $sql);
mysqli_close($db);
header("location:login.php");
?>