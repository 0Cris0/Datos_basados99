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
      <h1>Detalle del proveedor</h1>
    </div>
  </header>

    <h2 class='sub-titulo'>Información del servicio</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        
        
        require("../config/conexion.php");

        $username = $_SESSION["username"];
        $id_proveedor = $_POST["id_proveedor"];

        $query_top_s = "SELECT TOP 3 *
        FROM (
            SELECT s.serie, s.puntuacion, vs.n_visualizaciones
            FROM series as s, (
                SELECT c.id_serie, COUNT(*) as n_visualizaciones
                FROM visualizacion_c as vc, catalogo_s as cs, capitulo as c
                WHERE cs.id_prove == $id_proveedor
                AND c.id_capitulo == vc.id_capitulo
                GROUP BY c.id_serie
                ) as vs
            WHERE s.id_serie == vs.id_serie
            ORDER BY vs.n_visualizaciones) as datos";
        
        $result = $db -> prepare($query);
        $result -> execute();
        $top_s = $result -> fetchAll();
        # serie, puntuacion, n_vis
        
        $query_top_s = "SELECT TOP 3 *
        FROM (
            SELECT p.titulo, p.puntuacion, vp.n_visualizaciones
            FROM peliculas as p, (
                SELECT  (cpi.id_pelicula, COUNT(*) as n_visualizaciones)
                FROM visualizacion_p as vp, catalogo_p_incluida as cpi
                WHERE cpi.id_prove == $id_proveedor
                AND vp.id_pelicula == cpi.id_pelicula
                ) as vp
            WHERE p.id_pelicula == vp.id_pelicula
            ORDER BY vp.n_visualizaciones) as datos";

        $result = $db -> prepare($query);
        $result -> execute();
        $top_p = $result -> fetchAll();
        # titulo, puntuacion, n_visualizaciones
      
    ?>

<br>
    <h2 class='sub-titulo'>Top 3 de series</h2>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Serie</th>
                <th>Puntuación</th>
                <th>Visualizacione</th>
            </tr>

            <?php
                  // echo $pokemones;
                  # serie, puntuacion, n_vis
                  foreach ($top_s as $j) {
                    echo "<tr> <td>$j[0]</td> <td>$j[1]</td> <td>$j[2]</td></tr>";
                }
                ?>

        </table>     
        
    </section>
    <br>


    <h2 class='sub-titulo'>Top 3 de películas</h2>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Peliculas</th>
                <th>Puntuación</th>
                <th>N° de visualizaciones</th>
            </tr>
            <?php
                  // echo $pokemones;
                  # titulo, puntuacion, n_visualizaciones
                  foreach ($top_s as $j) {
                    echo "<tr> <td>$j[0]</td> <td>$j[1]</td> <td>$j[2]</td></tr>";
                }
                ?>
        </table>     
        
    </section>
    <br>

    <br>
    <form action="../menu/menu.php">
      <input type="submit" value="Menu" />
    </form>
</body>