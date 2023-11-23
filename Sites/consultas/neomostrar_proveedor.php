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
  <div class="parte_superior">
    <div class='logo'>
      <a href="/Sites/index.php"><img src="/Sites/imagenes/logo2.png"></a>
    </div>

    <nav class='barra_nav'>
      <a href= "/Sites/menu/menu.php">Menu</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>Detalle del proveedor</h1>
    </div>
  </header>

    <h2 class='sub-titulo'>Información del servicio</h2>

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
                <th>Valor de la subscripcion</th>
                <th>Cantidad de películas</th>
                <th>Cantidad de series</th>
            </tr>
            <tr>
                <td>**costo proveedor</td>
                <td>**cantidad de películas</td>
                <td>**cantidad de series</td>
            </tr>
        </table>     
        
    </section>
    <br>
    
    <form action="/Sites/consultas/neomostrar_top.php">
      <input type="submit" value="Mostrar Top 3" />
    </form>
    <br>
    <form action="/Sites/menu/menu.php">
      <input type="submit" value="Menu" />
    </form>
    </body>