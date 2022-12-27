<?php
  include_once 'database.php';
  session_start();
  $email=$_SESSION['email'];
  $rol=$_SESSION['rol'];

  
    if((@$_GET['demail']) && ($rol == 'Admin') && ($_GET['action'] == 'delete')){
      $demail=@$_GET['demail'];
      $result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
      header("location:administrador.php?q=1");
    }
    if((@$_GET['demail']) && ($rol == 'Admin') && ($_GET['action'] == 'changerol')){
      $demail=@$_GET['demail'];
      $newrol=@$_GET['newrol'];
      $result = mysqli_query($con,"UPDATE user SET rol='$newrol' WHERE email='$demail' ") or die('Error');
      header("location:administrador.php?q=1");
    }

    if((@$_GET['archivo']) && ($rol == 'Admin') && ($_GET['action'] == 'deletearchivo')){
      $archivo=@$_GET['archivo'];
      $filename = '/subida/$archivo';
      if (file_exists($filename)) {
          $success = unlink($filename);
          
          if (!$success) {
               throw new Exception("Cannot delete $filename");
          }
      }
      $result = mysqli_query($con,"DELETE FROM archivos WHERE nombre='$archivo'") or die('Error');
      $result = mysqli_query($con,"DELETE FROM registros WHERE archivo='$archivo'") or die('Error');

      header("location:administrador.php?q=5");
    }

    
    
    if((@$_GET['archivo']) && ($rol == 'Admin') && ($_GET['action'] == 'deletearchivoEst')){
      $archivo=@$_GET['archivo'];
      $filename = '/internas/hotelImages/$archivo';
      if (file_exists($filename)) {
          $success = unlink($filename);
          
          if (!$success) {
               throw new Exception("Cannot delete $filename");
          }
      }
      $result = mysqli_query($con,"DELETE FROM hoteles WHERE archivo='$archivo'") or die('Error');

      header("location:administrador.php?q=7");
    }
    if((@$_GET['archivo']) && ($rol == 'Admin') && ($_GET['action'] == 'deletearchivoLug')){
      $archivo=@$_GET['archivo'];
      $filename = '/internas/lugaresImages/$archivo';
      if (file_exists($filename)) {
          $success = unlink($filename);
          
          if (!$success) {
               throw new Exception("Cannot delete $filename");
          }
      }
      $result = mysqli_query($con,"DELETE FROM lugares WHERE archivo='$archivo'") or die('Error');

      header("location:administrador.php?q=9");
    }

    

    if((@$_GET['archivo']) && ($rol == 'Usuario') && ($_GET['action'] == 'deletearchivoEst')){
      $archivo=@$_GET['archivo'];
      $filename = '/internas/hotelImages/$archivo';
      if (file_exists($filename)) {
          $success = unlink($filename);
          
          if (!$success) {
               throw new Exception("Cannot delete $filename");
          }
      }
      $result = mysqli_query($con,"DELETE FROM hoteles WHERE archivo='$archivo'") or die('Error');

      header("location:dashboard.php?q=4");
    }
    

?>



