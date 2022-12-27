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
		$email = $_POST['email'];
		$pass = $_POST['password'];
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
				$_SESSION['tipo_usuario']=$extraido[6];

				header('location: dashboard.php?q=0');

			}elseif($extraido['rol']=='Admin'){

				$_SESSION['logged']=$email;
				$_SESSION['id']=$extraido[0];
				$_SESSION['nombres']=$extraido[1];
				$_SESSION['apellidos']=$extraido[2];
				$_SESSION['email']=$extraido[3];
				$_SESSION['password']=$extraido[4];
				$_SESSION['rol']=$extraido[5];
				$_SESSION['tipo_usuario']=$extraido[6];

				header('location: administrador.php?q=0');
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
	
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css2/index.css">
    <link rel="stylesheet" href="css2/login-estilos.css">
    <link rel="stylesheet" href="css2/form.css">





	</head>



	<body>
		<!-- encabezado -->
		 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">

      <div class="logo">
        <a class="navbar-brand" href="index.html"><img src="images/logo-santa-mariana-de-jesus.png"></a>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.html" class="nav-link">INICIO</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 2</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 3</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 4</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 5</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 6</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 7</a></li>
          <li class="nav-item"><a href="" class="nav-link">TEMA 8</a></li>
          <li class="nav-item cta"><a href="login.php" class="nav-link"><span>Iniciar sesión</span></a></li>
        </ul>
      </div>
    </div>
  </nav>
		    <!-- END nav -->

		<section class="ftco-search-course">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="courseSearch-wrap d-md-flex flex-column-reverse">
    					<div class="full-wrap d-flex ftco-animate">
    						<div class="one-third order-last p-5">
                  <!-- 
    							<span>Know what you're after?</span>
                  -->
    							<h3>Información</h3>
                  <!--
    							<form action="#" class="course-search-form">
		                <div class="form-group d-flex">
		                  <input type="text" class="form-control" placeholder="Type a course you want to study">
                      -->
		                  
                       <p>Loja, Ecuador</p>

                      
		                </div>
                    <!-- 
		              </form>
		              <p>Just Browsing? <a href="#"> See all courses</a></p>
                  -->
    						</div>
    					</div>
    					
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
	
		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box">
						<div class="box-body">
						<center> <h4 style="font-family: Poppins;">Iniciar Sesión</h4></center><br>
							<form method="post" action="login.php" enctype="multipart/form-data">
								<div class="form-group">
									<label style="font-family: Poppins;">Usuario:</label>
									<input  name="email" class="form-control">
								</div>
								<div class="form-group">
									<label class="fw" style="font-family: Poppins;">Contraseña:
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


		<footer class="ftco-footer ftco-bg-dark ftco-section img" style="background-image: url(images/bg_2.jpg); background-attachment:fixed;">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
              <div class="logofooter">
                <a class="navbar-brand" href="index.html"><img src="images/logo-santa-mariana-de-jesus-2.png"></a>
              </div>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Donde encontrarnos</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">José Joaquin de Olmedio, entre Vicente Rocafuerte y Miguel Riofrio</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">(07) 2724-430 - (07) 2724-329</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">marianitasloja.edu.ec</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Unidad Educativa Particular Santa Mariana de Jesús<a href="https://colorlib.com" target="_blank"></a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
		
		<script src="js/jquery.js"></script>
	</body>

</html>