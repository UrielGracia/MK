<?php
    session_start();

    //Si el usuario no esta logeado lo enviamos al login
    if (isset($_SESSION['user'])) {
        if($_SESSION['tuser'] == 0);
        else header("Location:index.html");
    }
    else header("Location:index.html");

    include("funciones.php");

    /******************************************************* */
    //ACTUALIZAMOSS LA PREGUNTA
    if (isset($_GET['actualizar'])) {
        //nos conectamos a la base de datos
        $link=mysqli_connect("localhost", "root", "", "mathkingdom");

        //tomamos los datos que vienen del formulario
        $id_pregunta = $_GET['idPregunta'];
        $id_tema = $_GET['tema'];
        $pregunta = htmlspecialchars($_GET['pregunta']);
        $opcion_a = htmlspecialchars($_GET['opcion_a']);
        $opcion_b = htmlspecialchars($_GET['opcion_b']);
        $opcion_c = htmlspecialchars($_GET['opcion_c']);
        $correcta = $_GET['correcta'];

        //Armamos el query para insertar en la tabla preguntas
        $query = "UPDATE preguntas SET grado='$id_tema', pregunta='$pregunta', opcion_a='$opcion_a', opcion_b='$opcion_b', opcion_c='$opcion_c', respuesta = '$correcta' WHERE id_pregunta='$id_pregunta'";

        //actualizamos en la tabla preguntas
        if (mysqli_query($link, $query)) { //Se insertó correctamente
            $mensaje = "La pregunta se actulizo correctamente";
            header("Location: listadopreguntas.php");
        } else {
            $mensaje = "No se pudo insertar en la BD" . mysqli_error($conn);
        }
    }

    //Selecciono la pregunta que viene por GET
    $id = $_GET['idPregunta'];
    $pregunta = obtenerPreguntaPorId($id);

    //Se presióno el botón Nuevo Tema
    if(isset($_GET['nuevoTema'])){
        //tomamos los datos que vienen del formulario
        $tema = $_GET['nombreTema'];
        $mensaje = agregarNuevoGrado($tema);
        header("Location: nuevapregunta.php");
    }

    //Obtengo todos los temas de la bd
    $resltado_temas = obetenerTodosLosGrados();


?>
<!DOCTYPE html>
<html lang="es">
<head>
meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Oval&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>Math Kingdom</h1>
        </header>
        <div class="contenedor-info">
            <?php include("nav.php") ?>
            <div class="panel">
                <h2>Modificar Pregunta</h2>
                <hr>
                <section id="nuevaPregunta">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
                        <input type="hidden" name="idPregunta" value = "<?php echo $pregunta['id_pregunta']?>">
                        <div class="fila">
                            <label for="">Grado: </label>
                            <select name="tema" id="tema">
                                <?php while ($row = mysqli_fetch_assoc($resltado_temas)) : ?>
                                    <?php if ($row['id_grado'] == $pregunta['grado']) : ?>
                                    <option value="<?php echo $row['id_grado'] ?>" selected>
                                        <?php echo $row['grado'] ?>
                                    </option>
                                <?php else : ?>
                                    <option value="<?php echo $row['id_grado'] ?>">
                                        <?php echo $row['grado'] ?>
                                    </option>
                                <?php endif ?>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="fila">
                            <label for="">Pregunta:</label>
                            <textarea name="pregunta" id="" cols="30" rows="10" reqired><?php echo $pregunta['pregunta']?></textarea>
                        </div>
                        <div class="opciones">
                            <div class="opcion">
                                <label for="">Opcion A</label>
                                <input type="text" name="opcion_a" id="" value = "<?php echo $pregunta['opcion_a']?>"required>
                            </div>
                            <div class="opcion">
                                <label for="">Opcion B</label>
                                <input type="text" name="opcion_b" value ="<?php echo $pregunta['opcion_b']?>"required>
                            </div>
                            <div class="opcion">
                                <label for="">Opcion C</label>
                                <input type="text" name="opcion_c" required value="<?php echo $pregunta['opcion_c']?>">
                            </div>
                        </div>
                        <div class="opcion">
                            <label for="">Correcta</label>
                            <select name="correcta" id="" class="correcta">
                                <option value="A" <?php if($pregunta['respuesta']=='A'){ echo "selected";}?>>A</option>
                                <option value="B" <?php if($pregunta['respuesta']=='B'){ echo "selected";}?>>B</option>
                                <option value="C" <?php if($pregunta['respuesta']=='C'){ echo "selected";}?>>C</option>
                            </select>
                        </div>
                        <hr>
                        <input type="submit" value="Actualizar Pregunta" name="actualizar" class="btn-guardar">
                    </form>
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
</body>
</html>