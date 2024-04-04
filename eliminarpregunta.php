<?php

    $link=mysqli_connect("localhost", "root", "", "mathkingdom");
    $id = $_GET['idPregunta'];

    $query = "DELETE FROM preguntas WHERE id = '$id'";
    mysqli_query($link, $query);
?>
<script>
    window.location.href = 'listadopreguntas.php';
</script>