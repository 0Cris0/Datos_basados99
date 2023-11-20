<?php
// Iniciar sesión
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>[Falta contexto]</title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="/Sites/styles/neoindex.css"> 

    <!-- para que una consulta.php pueda importarlo -->

</head>
    <body>
    <h2 class='sub-titulo'>Manejo de sesión</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");

        $username = $_POST["username"];
        $password = $_POST["password"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];

        $query = "";
        # Probablemente sea una de UPDATE

        # $_SESSION["username"] = $username_ingresado

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
        $result = $db -> prepare($query);
        $result -> execute();
        $juegos = $result -> fetchAll();

        # Debe redirigir al perfil

        # No sé si deberíamos hacer las comprobaciones aquí de la validez
        # de la cosa o antes (de momento se está dando el espacio para que ocurra antes)
    ?>
    </body>
