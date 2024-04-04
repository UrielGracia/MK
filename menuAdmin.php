<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Menú de Administradores</title>
</head>

<body>

    <?php
        session_start();

        //Si el usuario no esta logeado lo enviamos al login
        if (isset($_SESSION['user'])) {
            if($_SESSION['tuser'] == 0);
            else header("Location:index.html");
        }
        else 
        header("Location:index.html");

        include("funciones.php");

        $totalPreguntas = obtenerTotalPreguntas();
        $grado =  obtenerGrado();
    ?>

    <div class="contenedor">
        <header>
            <h1>Math Kingdom</h1>
        </header>
        <div class="contenedor-info">
        <?php include("nav.php") ?>
            <div class="panel">
                <h2>Dashboard</h2>
                <hr>
                <div id="dashboard">
                    <div class="card gradiente3">
                        <span class="tema">Total</span>
                        <span class="cantidad"><?php echo $totalPreguntas?></span>
                        <span> Preguntas</span>
                    </div>

                    <?php while ($cat = mysqli_fetch_assoc($grado)):?>
                    <div class="card gradiente1">
                        <span class="tema"><?php echo obtenerNombreGrado($cat['grado']);?></span>
                        <span class="cantidad"> <?php echo totalPreguntasPorGrado($cat['grado']);?></span>
                        <span> Preguntas</span>
                    </div>
                    <?php endwhile ?>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script>paginaActiva(0);</script> 

</body>
</html>