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
      <a href= "/menu/menu.php">Menu</a>
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

        $query_perfil = "info_perfil";
        $query_subs_j = "subs_j_perfil";
        $query_subs_ps = "subs_ps_perfil";


        $result = $db -> prepare($query_perfil);
        $result -> execute();
        $datos_perfil = $result -> fetchAll();
        # id, nombre, mail, username, duracion_ps, duracion_j, edad

        $result = $db -> prepare($query_subs_j);
        $result -> execute();
        $datos_subs_j = $result -> fetchAll();
        # id, titulo (juego), fecha_inicio

        $result = $db -> prepare($query_subs_ps);
        $result -> execute();
        $datos_subs_ps = $result -> fetchAll();
        # id, nombre (proveedor), fecha_inicio

        # [OJO: Ver cómo eso funcionar]

        # Hacer que esto sea vista materializada con actualización diaria


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

                <?php
                  // echo $pokemones;
                  # id, nombre, mail, username, duracion_ps, duracion_j, edad
                  foreach ($datos_perfil as $j) {
                    echo "<tr> <td>$j[1]</td> <td>$j[2]</td> <td>$j[3]</td> <td>$j[6]</td> <td>$j[5]</td> <td>$j[4]</td></tr>";
                }
                ?>
            </table>
    </section>

    <br>
    <h2 class='sub-titulo'>Subscripciones streaming activas</h2>
    <br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Proveedor</th>
                <th>Fecha de inicio</th>

            </tr>
            <?php
                  // echo $pokemones;
                  # id, nombre (proveedor), fecha_inicio
                  foreach ($datos_subs_ps as $j) {
                    echo "<tr> <td>$j[1]</td> <td>$j[2]</td> </tr>";
                }
            ?>
        </table>
        
    </section>

    <br>
    <h2 class='sub-titulo'>Subscripciones videojuegos activas</h2>
    <br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Videojuego</th>
                <th>Fecha de inicio</th>

            </tr>
            <?php
                  // echo $pokemones;
                  # id, titulo (juego), fecha_inicio
                  foreach ($datos_subs_j as $j) {
                    echo "<tr> <td>$j[1]</td> <td>$j[2]</td> </tr>";
                }
            ?>
        </table>
        
    </section>

    <br>
    <form action="/menu/menu.php">
      <input type="submit" value="Menu" />
    </form>

</body>