<?PHP
  //codigo para indicar que se usaran sesiones
  session_start();

  //echo "Usuario: $usu <br>";
  //echo "Cotrasenia: $pas <br>";
  $usu=$_REQUEST['usuario'];
  $pas=$_REQUEST['pass'];

  //conexion con la base de datos
  $link=mysqli_connect("localhost", "root", ""); 
  mysqli_select_db($link,"mathkingdom");

  //en la variable res se guarda el resultado de select
  $res=mysqli_query($link, "select id_usuario, usuario, password, tipo from usuarios where usuario='$usu'");

  //echo "Usuario VALIDO <br>";
  if ($row=mysqli_fetch_array($res))
  {

  //echo "Password VALIDO <br>";
    if($pas==$row['password'])
      {
      //son las varaibles que guardan la sesion
      $_SESSION['user']=$usu;
      $_SESSION['tuser']=$row['tipo'];
      $_SESSION['ID']=$row['id_usuario'];
      
      //depende del tipo de cliente, se enviara a un menu, ya sea el del admin o el cliente
        if ($row['tipo']==1) header("Location:dificultad.php");
        if ($row['tipo']==0) header("Location:menuAdmin.php");
      } 
    else header("Location:errorloginPass.html");
  }
  else header("Location:errorloginUser.html");
?>