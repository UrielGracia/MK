<?php 

	$conexion = mysqli_connect("localhost", "root", "", "mathkingdom");

	$nombrec = $_REQUEST['nom_us'];
	$alias = $_REQUEST['alias'];
	$contra = $_REQUEST['contr'];


	$inser = "INSERT INTO usuarios(usuario, password, tipo, nombre) 
			  VALUES('$alias', '$contra', 1, '$nombrec')";

//verificacio para que no repita en la base
			  $vecor = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$alias' ");

			  if(mysqli_num_rows($vecor) > 0){
			  	echo'
			  	<script>
			  		alert("Este usuario ya está Registrado");
			  		window.location = "index.html";
			  	</script>
			  		';
			  		exit();
			  }



//registro exitoso
	$ejecutar = mysqli_query($conexion, $inser);		

	if ($ejecutar) {
	  	echo '
	  	<script>
	  		alert("usuario registrado exitosamente");
	  			window.location = "index.html";
	  	</script>
	  	';
	  	exit();
	  }  

	  else{
	  	echo '
	  	<script>
	  		alert("Intentelo de Nuevo");
	  			window.location = "index.html";
	  	</script> ';
	  	exit();
	  }

	  mysqli_close($conexion);
 ?>