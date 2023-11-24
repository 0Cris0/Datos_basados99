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
    <link rel="stylesheet" href="../styles/neoindex.css"> 

    <!-- para que una consulta.php pueda importarlo -->

</head>

<body>
  <div class="parte_superior">
    <div class='logo'>
      <a href="../index.php"><img src="../imagenes/logo2.png"></a>
    </div>

    <nav class='barra_nav'>
      <a href= "../menu/menu.php">Menu</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>Compras</h1>
    </div>
  </header>

    <h2 class='sub-titulo'>Películas de pago único</h2>


    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        
        /*
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
        */

    ?>

    <br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Titulo</th>
                <th>Duración</th>
                <th>Clasificación</th>
                <th>Puntuación</th>
                <th>Año</th>
                <th>Ver</th>
            </tr>
            <tr>
                <td>**titulo</td>
                <td>**duracion</td>
                <td>**clasificacion</td>
                <td>**puntuación</td>
                <td>**año</td>
                <td>
                    <form action="../consultas/neomostrar_proveedor.php">
                    <input type="submit" value="Ver" />
                    </form>
                </td>
            </tr>
        </table>
        
    </section>

    <br>
    <h2 class='sub-titulo'>Juegos de pago único</h2>
    <br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Titulo</th>
                <th>Puntuación</th>
                <th>Clasificación</th>
                <th>Fecha de lanzamiento</th>
                <th>Beneficio de preorden</th>
                <th>Ver</th>
            </tr>
            <tr>
                <td>**titulo</td>
                <td>**puntuación</td>
                <td>**clasificacion</td>
                <td>**fecha_lanzamiento</td>
                <td>**beneficio</td>
                <td>
                    <form action="../consultas/neomostrar_proveedor.php">
                    <input type="submit" value="Ver" />
                    </form>
                </td>
            </tr>
        </table>
        
    </section>

    <br>
    <form action="../menu/menu.php">
      <input type="submit" value="Menu" />
    </form>



    </body>