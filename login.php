<?php
	require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}
	
	$ref=@$_GET['q'];		
	if(isset($_POST['submit']))
	{	
		$email = $_POST['userEmail'];
		$pass = $_POST['contrasena'];
		$email = stripslashes($email);
		$email = addslashes($email);
		$pass = stripslashes($pass); 
		$pass = addslashes($pass);
		$email = mysqli_real_escape_string($con,$email);
		$pass = mysqli_real_escape_string($con,$pass);	
						
		$str = "SELECT * FROM user WHERE email='$email' and password='$pass'";
		$result = mysqli_query($con,$str);
		$rows = mysqli_num_rows($result);
		$extraido = mysqli_fetch_array($result);
		if($rows!=1) 
		{
			echo '<center><div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error: </strong> ¡Correo o Contraseña incorrectos!
		  	</div></center>';
		}
		else{
			if($extraido['rol']=='Usuario'){
				$_SESSION['logged']=$email;
				$_SESSION['id']=$extraido[0];
				$_SESSION['nombres']=$extraido[1];
				$_SESSION['apellidos']=$extraido[2];
				$_SESSION['email']=$extraido[3];
				$_SESSION['password']=$extraido[4];
				$_SESSION['rol']=$extraido[5];
				header('location: dashboard.php?q=0');
			}elseif($extraido['rol']=='Admin'){
				$_SESSION['logged']=$email;
				$_SESSION['id']=$extraido[0];
				$_SESSION['nombres']=$extraido[1];
				$_SESSION['apellidos']=$extraido[2];
				$_SESSION['email']=$extraido[3];
				$_SESSION['password']=$extraido[4];
				$_SESSION['rol']=$extraido[5];
				header('location: administrador.php?q=0');
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login</title>
		<link rel="stylesheet" href="css/form.css">
		<link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/styles.css">
		<link  rel="stylesheet" href="css/login-estilos.css"/>
		<link rel="stylesheet" href="css/app.css">
        
	</head>

	<body>
	<header>
        <nav id="nav" class="nav1">
            <div class="contenedor-nav">
                <div class="logo">
                    <img src="images/logo.png">
                </div>
                <div class="enlaces" id="enlaces">
                    <a href="index.html" id="enlace-inicio" class="btn-header">Inicio</a>
                    <a href="internas/hoteles.php" id="enlace-hoteles" class="btn-header">Hoteles</a>
                    <a href="internas/visualizaciones.php" id="enlace-visualizaciones" class="btn-header">Visualizaciones</a>
                    <a href="internas/lugaresTuristicos.php" id="enlace-lugaresTuristicos" class="btn-header">Lugares Turisticos</a>
                    <a href="login.php" id="enlace-inicio-sesion" class="btn-header">Ingresar</a>
                </div>
                <div class="icono" id="open">
                    <span>&#9776;</span>
                </div>
            </div>
        </nav>

    </header>
		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box">
						<div class="box-body">
						<center> <h4 style="font-family: Poppins;">Iniciar Sesión</h4></center><br>
							<form method="post" action="login.php" enctype="multipart/form-data">
								<div class="form-group">
									<label style="font-family: Poppins;">Correo electrónico:</label>
									<input type="email"  name="email" class="form-control">
								</div>
								<div class="form-group">
									<label class="fw" style="font-family: Poppins;">Contraseña:
										<a href="javascript:void(0)" class="pull-right">¿La olvidaste?</a>
									</label>
									<input type="password" autocomplete="off" name="password" class="form-control">
								</div> 
								<div class="form-group text-right">
									<button class="btn btn-primary btn-block" name="submit" style="font-family: Poppins;">Iniciar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		
		<script src="js/jquery.js"></script>
	</body>

</html>