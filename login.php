<?php
//namespace MiTareaServidorWeb\Models;
/*Primeramente buscamos que el usuario haya escrito ambos campos usuario y contraseña*/
$alert ='';
session_start();
if(!empty($_SESSION['activa']))
{
 header("Location:index.html");
}else
{ 
if(!empty($_POST))
{
   if(empty($_POST['usuario']) ||empty($_POST['password']))
   { /*Si le faltó alguno de los dos se redirecciona a login y en el URL se verá error=1*/
       header("Location:login.php?error=1");
   }else{
       /*Si llena ambos campos, lo siguiente es realizar la consulta del usuario para ver si existe*/
       require_once 'config/conexion.php';
       $user=$_POST['usuario'];
       $pass=$_POST['password'];
       $encrypted=md5($pass);
       $db = new conexion();
       $sql =mysqli_query($db, "SELECT * FROM usuarios WHERE usuario = '".$user."' AND password = '".$encrypted."'");
       $sql_result=mysqli_num_rows($sql);
       
       if($sql_result > 0)
       {
        /*Si en el query se encuentran los datos entonces devuelve el resultado del query en un arreglo  */
        $datos=mysqli_fetch_array($sql);
        //Para convertir arreglo a string e imprimirlo
        //$str=implode(',', $datos);          
        // Para ver que si trae datos print_r($str);
        //session_start();
        //del lado de session es la variable
        //del lado de datos es el campo en la tabla
        $_SESSION['activa'] = true;
        $_SESSION['ID'] = $datos['ID'];
        $_SESSION['Nombre'] = $datos['Nombre'];
        $_SESSION['usuario'] = $datos['usuario'];
        $_SESSION['password'] = $datos['password'];
        header('location:index.html');
        
       } else
       {
       $alert ='El usuario y / o password es incorrecto, vuelve a intentar!!'; 
        //header("Location:login.php?error=1");
        session_unset();
        session_destroy();

       } 
   }
}
} 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
 
 <!-–Ahora proseguimos con el panel de login-–>
    <title>Login</title>
 <link rel="stylesheet" href="main.css">
</head>
<body> 
<div id="logo" class="container">
	<h1><a href="#">PROGRAMACIÓN EN <span>EL SERVIDOR WEB</span></a></h1>
	<p>TAREA POR <a mailito="josustait@gmail.com" rel="nofollow">JOSÉ DANIEL SUSTAITA->UNIR</a></p>
</div>
<div id="menu" class="container">
	<ul>
		<li><a href="index.html" accesskey="1" title="home">INICIO</a></li>
        <li class="current_page_item"><a href="registro.html" accesskey="2" title="registro">REGISTRARSE</a></li>
 </ul>
 </div>
 <div>
<form action ="" method ="POST">
<h2>Login</h2>
<P>Usuario:<br>
<input type="text" name="usuario" placeholder="usuario" ></P>
<P>Password:<br>
<input type="password" name="password"  placeholder="password"></P>
 <div class="alert"><?php echo(isset($alert) ? $alert : ''); ?></div>
<p class="center"><input type="submit" value = "Login"></p>
 
 </form>
 </div>
</body>
</html>