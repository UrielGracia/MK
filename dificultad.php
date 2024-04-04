<?php
    session_start();
    include("funciones.php");
    $allgrados = obtenerGrado();
    //Si el usuario no esta logeado lo enviamos al login
    if(isset($_GET['idgrado'])){
        if (isset($_SESSION['user'])) {
            if($_SESSION['tuser'] == 1){
                $_SESSION['idgrado'] = $_GET['idgrado'];
                header("Location: quiz.php");
            }
            else header("Location:index.html");
        }
        else 
        header("Location:index.html");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dificultad</title>
    <meta name="vieport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Framework Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estil2.css">
    <link rel="stylesheet" type="text/css" href="css/micss32.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="estilo2.css">
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
                    <a href="cerrar-sesion.php"><button type="button" class="btn btn-outline-danger" >Cerrar_Sesión</button></a>
                </li>
                </ul>
                
            </div>
        </nav>
    </div>

    <div class="dif" >
        <h1 class="display-3" align="center" style="font-family: 'Nova Oval', serif;margin-top: 3px;padding-top: 45px;padding-bottom: 35px;">Selecciona la dificultad</h1>
        <div style="margin-left: 170px;">
            <!--<form action="quiz.php" class="seleccion_grado" method="POST">-->
                <div class="row">
                    <div class="col">
                        <div>
                            <div class="row">
                                <?php while ($gr = mysqli_fetch_assoc($allgrados)):?>
                                <div class="col">
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" id="<?php echo $cat['tema']?>">
                                        <div><button class="btn btn-primary text-center" type="hidden" name="idgrado" value="<?php echo $gr['grado']?>" style="width: 250px;height: 150px;margin-bottom: 20px;
                                        margin-left: 110px;background: rgb(14,136,27);font-size: 40px;font-family: 'Nova Oval', serif;border-style: none;border-radius: 55px;">"<?php echo $gr['grado']?>"</button>
                                        <a href="javascript:{}" onclick="document.getElementById(<?php echo $gr['grado']?>).submit(); return false;">
                                            <?php echo obtenerNombreGrado($gr['id'])?>
                                        </a></div>
                                    </form>
                                </div>
                                <?php endwhile?>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>

        <!--name="grado" type="submit" value="1"-->
    </div>
    
</body>
</html>