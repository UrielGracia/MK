<?php
    session_start();

    //Si el usuario no esta logeado lo enviamos al login
    if (isset($_SESSION['user'])) {
        if($_SESSION['tuser'] == 1);
        else header("Location:index.html");
    }
    else 
    header("Location:index.html");

    include("funciones.php");
    $num_grado = $_SESSION['idgrado'];
    $totalQ = totalPreguntasPorGrado($num_grado);
    //$confi = obtenerConfiguracion($_SESSION['ID']);
    //$_SESSION['id_u_e'] = $confi['id_estadisticas'];


    //Variables que contral la partida


    if(isset($_GET['siguiente'])){//Ya esta jugando
        //Aumento 1 en las estadísticas
        //aumentarRespondidas($_SESSION['id_u_e']);

        //Controlar si la respuesta esta bien
        if($_SESSION['respuesta_correcta']==$_GET['respuesta']){
            $_SESSION['correctas'] = $_SESSION['correctas'] + 1;
        }

        //
        $_SESSION['numPreguntaActual'] = $_SESSION['numPreguntaActual'] + 1;
        if($_SESSION['numPreguntaActual'] < ($totalQ)){
            $preguntaActual = obtenerPreguntaPorId($_SESSION['idPreguntas'][ $_SESSION['numPreguntaActual']]);
            $_SESSION['respuesta_correcta'] = $preguntaActual['respuesta'];
        }else{
            //Lo enviamos al pagina de los resultados
            //Calculo la cantidad de respuestas incorrectas y lo guardo en una variable global
            $_SESSION['incorrectas'] = $totalQ - $_SESSION['correctas'];
            //Obetengo el nombre de la categoria y lo ponogo en una variable global
            //$_SESSION['nombreCategoria'] = obtenerNombreGrado($num_grado);
            $_SESSION['score'] = ($_SESSION['correctas'] * 100)/$totalQ;
            header("Location: final.php");
        }

    }else{//comenzó a jugar
        $_SESSION['correctas']=0;
        $_SESSION['numPreguntaActual'] = 0;
        $_SESSION['preguntas'] = obtenerIdsPreguntasPorGrado($num_grado);
        $_SESSION['idPreguntas'] = array();

        foreach ($_SESSION['preguntas'] as $idPregunta) {
            array_push($_SESSION['idPreguntas'],$idPregunta['id_pregunta']); // Item agregado
        }
        
        //Desordeno el arreglo
        shuffle($_SESSION['idPreguntas']);
        $preguntaActual = obtenerPreguntaPorId($_SESSION['idPreguntas'][0]);
        $_SESSION['respuesta_correcta'] = $preguntaActual['respuesta'];
    }
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Kingdom</title>
    <link rel="stylesheet" href="estiloq.css">
</head>
<body>
    <div class="container-juego" id="container-juego">
        <header class="header">
            <div class="categoria">
                <?php echo obtenerNombreGrado($num_grado) ?>
            </div>
            <!--<a href="index.php">Mathkingdom</a>-->
        </header>
        <div class="info">
            <div class="estadoPregunta">
                Pregunta <span class="numPregunta"><?php echo $_SESSION['numPreguntaActual'] + 1?></span> de <?php echo $totalQ ?>
            </div>
            <h3>
                <?php echo $preguntaActual['pregunta']?>
            </h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                <div class="opciones">
                    <label for="respuesta1" onclick="seleccionar(this)" class="op1">
                        <p><?php echo $preguntaActual['opcion_a']?></p>
                        <input type="radio" name="respuesta" value="A" id="respuesta1" required>
                    </label>
                    <label for="respuesta2" onclick="seleccionar(this)" class="op2">
                        <p><?php echo $preguntaActual['opcion_b']?></p>
                        <input type="radio" name="respuesta" value="B" id="respuesta2" required>
                    </label>
                    <label for="respuesta3" onclick="seleccionar(this)" class="op3">
                        <p><?php echo $preguntaActual['opcion_c']?></p>
                        <input type="radio" name="respuesta" value="C" id="respuesta3" required>
                    </label>
                </div>
                <div class="boton">
                    <input type="submit" value="Siguiente" name="siguiente">
                </div>
            </form>
        </div>
    </div>
    <script src="juego.js"></script>
</body>
</html>