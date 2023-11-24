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
      <h1>Mi perfil</h1>
    </div>
  </header>

    <h2 class='sub-titulo'>Mis datos personales</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        
        
        require("../config/conexion.php");

        $username = $_POST["username"];

        $query = "info_perfil";
        # [OJO: Ver cómo eso funcionar]


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
        $datos = $result -> fetchAll();

    ?>
    <section class='contenedor_general'>
            <table class='tabla'>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Edad</th>
                    <th>Horas jugando</th>
                    <th>Horas viendo streaming</th>
                </tr>
                
                <tr>
                    <td>**nombre</td>
                    <td>**email</td>
                    <td>**edad</td>
                    <td>**username</td>
                    <td>**tiempo juegos</td>
                    <td>**tiempo streaming</td>
                </tr>
            </table>
    </section>

    <br>
    <h2 class='sub-titulo'>Subscripciones activas</h2>
    <br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Tipo</th>
                <th>Contenido</th>
                <th>Estado</th>
                <th>Fecha de inicio</th>

            </tr>
            <tr>
                <td>**juego/peli</td>
                <td>**juego/proveedor</td>
                <td>**estado</td>
                <td>**fecha de inicio</td>

            </tr>
        </table>
        
    </section>
    <br>
    <form action="/Sites/menu/menu.php">
      <input type="submit" value="Menu" />
    </form>

</body>