<?php
//conexion con la base de datos
$link=mysqli_connect("localhost", "root", "", "mathkingdom"); 

function guardarGrado(){
    $ng = $_REQUEST['grado'];
    return $ng;
}

function obtenerConfiguracion($id_1){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    //Comprobamos si existe el registro 1 que mantiene la configuraciòn
    //Añadimos un alias AS total para identificar mas facil
    
    $query = "INSERT INTO estadisticas (id_usu,respondidas,correctas,incorrectas) VALUES ($id_1, '0', '0','0')";
    if (mysqli_query($link, $query)) { //Se insertó correctamente

    } else {
        echo "No se pudo insertar en la BD" .mysqli_errno($link);
    }

    //Selecciono el registro dela configuración
    $query = "SELECT * FROM estadisticas  WHERE id_usu= $id_1 and respondidas = '0'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}


//Funcion para agregar un nuevo grado escolar a la BD
function agregarNuevoGrado($grado){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    //armamos el query para insertar en la tabla temas
    $query = "INSERT INTO grado (grado) VALUES ('$grado')";

    //insertamos en la tabla temas
    if (mysqli_query($link, $query)) { //Se insertó correctamente
        $mensaje = "El fue agregado correctamente";
        header("Location: menuAdmin.php");
    } else {
        $mensaje = "No se pudo insertar en la BD" . mysqli_errno($link);
    }
    return $mensaje;
}


function obetenerTodosLosGrados(){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $query = "SELECT * FROM grado";
    $result = mysqli_query($link, $query);
    return $result;
}

function obtenerNombreGrado($id){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $query = "SELECT * FROM grado WHERE id_grado = '$id'";
    $result = mysqli_query($link, $query);
    $tema = mysqli_fetch_array($result);    
    return $tema['grado'];
}

function obetenerTodasLasPreguntas(){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $query = "SELECT * FROM preguntas";
    $result = mysqli_query($link, $query);
    return $result;
}

function obtenerPreguntaPorId($id){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $query = "SELECT * FROM preguntas WHERE id_pregunta = $id";
    $result = mysqli_query($link, $query);
    $pregunta = mysqli_fetch_array($result);
    return $pregunta;
}

function obtenerTotalPreguntas(){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    //Añadimos un alias AS total para identificar mas facil
    $query = "SELECT COUNT(*) AS total FROM preguntas";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);  
    return $row['total'];
}

function totalPreguntasPorGrado($grado){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $query = "SELECT COUNT(*) AS total FROM preguntas WHERE grado = '$grado'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);  
    return $row['total'];
}

function obtenerGrado(){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    //ACOntamos la cantidad de cada categoria
    $query = "SELECT grado, COUNT(DISTINCT grado) FROM preguntas GROUP BY grado";
    $result = mysqli_query($link, $query);
    return $result;
}

function obtenerIdsPreguntasPorGrado($grado){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $query = "SELECT id_pregunta FROM preguntas WHERE grado = $grado";
    $result = mysqli_query($link, $query);
    return $result;
}

/*function aumentarVisita(){
    include("conexion.php");
    //Selecciono el registro de la estadistica
    $query = "SELECT * FROM estadisticas  WHERE id='1'";
    $result = mysqli_query($conn, $query);
    $estadistica = mysqli_fetch_assoc($result);
    $visitas = $estadistica['visitas'];
    $visitas = $visitas + 1;

    $query = "UPDATE estadisticas SET visitas = '$visitas' WHERE id='1'";
    $result = mysqli_query($conn, $query);
}*/

function aumentarRespondidas($id_e){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    //Selecciono el registro de la estadistica
    $query = "SELECT * FROM estadisticas  WHERE id_estadisticas='$id_e'";
    $result = mysqli_query($link, $query);
    $estadistica = mysqli_fetch_assoc($result);
    $respondidas = $estadistica['respondidas'];
    $respondidas = $respondidas + 1;

    $query = "UPDATE estadisticas SET respondidas = '$respondidas' WHERE id='$id_e'";
    $result = mysqli_query($link, $query);
}

function aumentarCorrectas($id_e){
    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    //Selecciono el registro de la estadistica
    $query = "SELECT * FROM estadisticas  WHERE id_estadisticas='$id_e'";
    $result = mysqli_query($link, $query);
    $estadistica = mysqli_fetch_assoc($result);
    $completados = $estadistica['correctas'];
    $completados = $completados + 1;

    $query = "UPDATE estadisticas SET correctas = '$completados' WHERE id='$id_e'";
    $result = mysqli_query($link, $query);
}