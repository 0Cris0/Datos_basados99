<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 4 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="/home/grupo50/Sites/styles/index.css">

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 4</h2>

    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se obtiene el valor del input del usuario
      $n_gen = $_POST["n_gen"];
      # $n_gen = intval($n_gen);
      # OJO: Ver si es necesario cambio de tipo

      #Se construye la consulta como un string
      $query = "SELECT VS.titulo as titulo
        FROM (
            SELECT GV.id_juego
            FROM (
                -- Subgenero inmediatos
                SELECT GS.genero as categoria
                FROM Generos_subgeneros as GS
                WHERE GS.genero = $n_gen
                --
                UNION
                --
                SELECT GS.subgenero as categoria
                FROM Generos_subgeneros as GS
                WHERE GS.genero = $n_gen
            ) as conjunto, Generos_videojuego as GV
            WHERE conjunto.categoria = GV.genero
        ) as ides, Videojuegos_sub as VS
        WHERE ides.id_juego = VS.id_juego
        --
        UNION
        --
        SELECT VP.titulo as titulo
        FROM (
            SELECT GV.id_juego
            FROM (
                -- Subgenero inmediatos
                SELECT GS.genero as categoria
                FROM Generos_subgeneros as GS
                WHERE GS.genero = $n_gen
                --
                UNION
                --
                SELECT GS.subgenero as categoria
                FROM Generos_subgeneros as GS
                WHERE GS.genero = $n_gen
            ) as conjunto, Generos_videojuego as GV
            WHERE conjunto.categoria = GV.genero
        ) as ides, Videojuegos_pun as VP
        WHERE ides.id_juego = VP.id_juego
        ;";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db -> prepare($query);
      $result -> execute();
      $juegos = $result -> fetchAll();
      ?>

      <table>
        <tr>
          <th>Nombre videojuego</th>
        </tr>
      
          <?php
            // echo $pokemones;
            foreach ($juegos as $j) {
              echo "<tr> <td>$j[0]</td> </tr>";
          }
          ?>
          
      </table>

  <a href="/home/grupo50/Sites/index.php">
        <button> Volver al índice </button>
    </a>
</body>



