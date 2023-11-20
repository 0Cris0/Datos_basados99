<?php
// Iniciar sesión
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Mi Perfil</title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="/Sites/styles/neoindex.css"> 

    <!-- para que una consulta.php pueda importarlo -->

</head>
    <body>
    <h2 class='sub-titulo'>Mi perfil</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");

        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "";
        # Obtener qué usuario es
        # Obtener su información (nombre, email, username)
        # Mosttar edad
        # Listado de subs activas en juegos o streaming
            # Ordenado por fecha
        # Suma de horas viendo contenido y aparte jugando


        # Hacer que esto sea vista materializada con actualización diaria
        

        # De ser correcto $_SESSION["username"] = $username_ingresado

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
        $result = $db -> prepare($query);
        $result -> execute();
        $juegos = $result -> fetchAll();

        # Debe redirigir al perfil
        # en caso de ser correcto

        # O mandar al inicio de sesión si falló
    ?>
    </body>