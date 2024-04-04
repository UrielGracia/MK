<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Maestros</title>
    <meta name="vieport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Framework Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estil2.css">

</head>

<body>
    <!-- BARRA NAVEGACIÓN -->
    <div class="barr">
        <nav class="navbar navbar-expand-md navbar-light bg-light border-3 border-bottom border-primary" class="barra">
               <div class="container-fluid">
                <a href="index.php" class="navbar-brand">PRINCIPAL</a>
                <button type="button"
                    class="navbar-toggler"
                    data-bs-toggle="collapse"
                    data-bs-target="#MenuNavegacion">
                        <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div id="MenuNavegacion" class="collapse navbar-collapse">

            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a href="tecnicos.php"><button type="button" class="btn btn-outline-danger" >Maestros</button></a>
                </li>
                <li class="nav-item">
                    <a href="cerrarsesion.php"><button type="button" class="btn btn-outline-danger" >Cerrar_Sesión</button></a>
                </li>
                </ul>
                
            </div>
        </nav>
    </div>



            <!-- login y registro-->
            
            <hr class="hrr">

           <main>

            <div class="contenedor__todo1">
               
               
                    <!--Login-->
                    <form action="login1.php" class="formulario__login" method="POST">
                        <h2 class="text-center">Iniciar Sesión <br> (Maestro)</h2>
                        <br>
                        <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario" required></input>
                        <br>
                        <input class="form-control" type="password" name="pass" id="pass" placeholder="Contraseña" required></input>
                        <br>
                        <button class="btn btn-outline-dark">Entrar</button>
                    </form>
              

              </div>

<br>
                    
<div class="container">
    <div class="alert alert-danger d-flex aling-items-center">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
    <div>Solo para Maestros</div>
</div>
        </main>
 
<hr class="hrr">

        <script type="text/javascript" src="css/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html