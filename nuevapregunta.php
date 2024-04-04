<?php
    session_start();

    //Si el usuario no esta logeado lo enviamos al login
    if (isset($_SESSION['user'])) {
        if($_SESSION['tuser'] == 0);
        else header("Location:index.html");
    }
    else header("Location:index.html");

    include("funciones.php");


    //Se presióno el botón Nuevo Tema
    if(isset($_GET['nuevoGrado'])){
        //tomamos los datos que vienen del formulario
        $grado = $_GET['nombreGrado'];
        $mensaje = agregarNuevoGrado($grado);
        header("Location: nuevapregunta.php");
    }
    /******************************************************* */
    //GUARDAMOS LA PREGUNTA
    if (isset($_GET['guardar'])) {
        //nos conectamos a la base de datos
        $link=mysqli_connect("localhost", "root", "", "mathkingdom");

        //tomamos los datos que vienen del fosrmulario
        // elimina texto con formato de etiqueta html
        $pregunta = htmlspecialchars($_GET['pregunta']);
        $opcion_a = htmlspecialchars($_GET['opcion_a']);
        $opcion_b = htmlspecialchars($_GET['opcion_b']);
        $opcion_c = htmlspecialchars($_GET['opcion_c']);
        $id_tema = $_GET['tema'];
        $correcta = $_GET['correcta'];

        //Armamos el query para insertar en la tabla preguntas
        $query = "INSERT INTO preguntas (grado, pregunta, opcion_a, opcion_b, opcion_c, respuesta)
        VALUES ('$id_tema', '$pregunta', '$opcion_a','$opcion_b','$opcion_c','$correcta')";

        //insertamos en la tabla preguntas
        if (mysqli_query($link, $query)) { //Se insertó correctamente
            $mensaje = "La pregunta se inserto correctamente";
        } else {
            $mensaje = "No se pudo insertar en la BD" . mysqli_error($link);
        }
    }

    //Obtengo todos los temas de la bd
    $resltado_temas = obetenerTodosLosGrados();


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Math Kingdom</title>
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>Math Kingdom</h1>
        </header>
        <div class="contenedor-info">
            <?php include("nav.php") ?>
            <div class="panel">
                <h2>Complete la Pregunta</h2>
                <hr>
                <section id="nuevaPregunta">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                        <div class="fila">
                            <label for="">Grado: </label>
                            <select name="tema" id="tema">
                                <?php while ($row = mysqli_fetch_assoc($resltado_temas)) : ?>
                                    <option value="<?php echo $row['id_grado'] ?>">
                                        <?php echo $row['grado'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                            <span class="agregarTema" onclick="agregarGrado()">
                            <i class="fa-solid fa-circle-plus"></i></span>
                        </div>
                        <div class="fila">
                            <label for="">Pregunta:</label>
                            <textarea name="pregunta" id="" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="opciones">
                            <div class="opcion">
                                <label for="">Opcion A</label>
                                <input type="text" name="opcion_a" id="" required>
                            </div>
                            <div class="opcion">
                                <label for="">Opcion B</label>
                                <input type="text" name="opcion_b" required>
                            </div>
                            <div class="opcion">
                                <label for="">Opcion C</label>
                                <input type="text" name="opcion_c" required>
                            </div>
                        </div>
                        <div class="opcion">
                            <label for="">Correcta</label>
                            <select name="correcta" id="" class="correcta">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                        <hr>
                        <input type="submit" value="Guardar Pregunta" name="guardar" class="btn-guardar">
                    </form>

                    <?php if (isset($_GET['guardar'])) : ?>
                        <span> <?php echo $mensaje ?></span>
                    <?php endif ?>
                </section>
            </div>
        </div>
    </div>



    <!-- Ventana Modal para nuevo Tema -->
    <div id="modalTema" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="cerrarGrado()">&times;</span>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                <label for="">Agregar Nuevo Grado</label>
                <input type="text"   name="nombreTema" required>
                <input type="submit" name="nuevoTema" value="Guardar Tema" class="btn">
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script>paginaActiva(1);</script>
</body>
</html>