<?php
    include_once 'database.php';
    require_once "exelLibreria/vendor/autoload.php";
    include("dll/config.php");
    include("dll/class_mysqli_7.php");
    use PhpOffice\PhpSpreadsheet\IOFactory;
    session_start();
    if(!(isset($_SESSION['email'])))
    {

        header("location:login.php");
    }
    else
    {
        $name = $_SESSION['nombres'];
        $apellidos = $_SESSION['apellidos'];
        $email = $_SESSION['email'];
        $idUser = $_SESSION['id'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
        $rol=$_SESSION['rol'];


        include_once 'database.php';
    }

    if($_SESSION["rol"] == "Admin"){
        session_destroy();
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link  rel="stylesheet" href="css2/estilos-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>

</head>

<body>
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0">
	    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href=""><h3>Bienvenido al panel</h3></a>
	    	<ul class="navbar-nav px-3">
            <div class="nav-item text-nowrap">
         		<a class="nav-link" href="logout1.php?q=dashboard.php"><h5>Cerrar Sesión</h5></a>
            </div>

        	</ul> 
    </nav>
    
    <div class="container-fluid">
        <div class="row"> 
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                    
                    <li <?php if(@$_GET['q']==0) echo'class="nav-link"'; ?>><a href="dashboard.php?q=0" style="font-family: 'Roboto', sans-serif; font-size: 20px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg> Home Usuario</a>
                    </li>

                    </li>

                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">        
                <div class="col-md-12">
                <?php
                if(@$_GET['q']==0){
                    echo '<h1 style="color: #FD7E14;">Bienvenido '.$name.' '.$apellidos.'</h1>';
                    
                    echo '<h4 style="color: blue;">Usted es '.$tipo_usuario.'</h4>
                    


                    <div class="row">
                            <div class="col-md-3"></div><div class="col-md-6" style="margin-top:10px;">
                            <center><h4 style="font-family: Poppins;  margin-bottom: 20px;">Deja tu comentario</h4></center><br>   
                            <form autocomplete="off" class="form-horizontal title1" name="form" action="#"  method="POST" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-comentario">
                                        <labe style="font-family: Poppins;">Comentario:</label>
                                        <input  type="text" name="comentario" class="form-control" required />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 control-label" for=""></label>
                                        <div class="col-md-12" style="margin-top:10px;"> 
                                            <input  type="submit" name="submit" style="margin-left:37%; font-family:Poppins; width:150px;" class="btn btn-primary" value="Comentar" class="btn btn-primary"/>
                                        </div>
                                    </div>
                                </fieldset>

                            </form></div>
                            <script>
                                function RadioCheck(isYes){
                                    document.getElementById("insertclase")
                                    if(isYes){
                                        document.getElementById("insertclase").style.display = "block";
                                    }else{
                                        document.getElementById("insertclase").style.display = "none";
                                    }
                                }
                            </script>


                    ';

                            if(isset($_POST['submit'])){

                                $comentario = $_POST['comentario'];
                                $comentario = stripslashes($comentario);
                                $comentario = addslashes($comentario);


                                    $str="insert into comentario set comentario='$comentario'";
                                    if($rol=="Usuario" or $rol=="Admin"){
                                        if((mysqli_query($con,$str))){   
                                        echo '<center><div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong> ¡Se ha comentado correctamente!</strong>
                                      </div></center>';
                                        }
                                    }
                                    
                                

                            }

                }
                ?>
                   
                </div>
            </main>
        </div>
    </div>
</body>
</html>
