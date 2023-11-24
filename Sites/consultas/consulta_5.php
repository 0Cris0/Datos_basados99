<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 5 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../home/grupo50/Sites/styles/index.css">

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 5</h2>

    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se obtiene el valor del input del usuario
      $n_user = $_POST["n_user"];
      # $n_user = intval($n_user);

      #Se construye la consulta como un string
      $query = "SELECT VP.titulo as titulo, P.nombre as nombre
        -- Respectivos nombres y proveedores
        FROM (
            -- Juegos del usuario
            SELECT VU.id_juego
            FROM Usuarios as U, Videojuegos_usuario as VU
            WHERE U.username = $n_user
            AND U.id_usuario = VU.id_usuario
        ) as ides, Juegos_proveedor as JP, Videojuegos_pun as VP, Proveedores as P
        WHERE ides.id_juego = JP.id_juego
        AND ides.id_juego = VP.id_juego
        AND P.id_prov = JP.id_prov
        --
        UNION
        --
        SELECT VS.titulo as titulo, P.nombre as nombre
        FROM (
            -- Juegos del usuario
            SELECT VU.id_juego
            FROM Usuarios as U, Videojuegos_usuario as VU
            WHERE U.username = $n_user
            AND U.id_usuario = VU.id_usuario
        ) as ides, Juegos_proveedor as JP, Videojuegos_sub as VS, Proveedores as P
        WHERE ides.id_juego = JP.id_juego
        AND ides.id_juego = VS.id_juego
        AND P.id_prov = JP.id_prov
        ;";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db -> prepare($query);
      $result -> execute();
      $juegos = $result -> fetchAll();
    ?>

      <table>
        <tr>
          <th>Nombre videojuego</th>
          <th>Nombre proveedor</th>
        </tr>
      
          <?php
            // echo $pokemones;
            foreach ($juegos as $j) {
              echo "<tr> <td>$j[0]</td> <td>$j[1]</td> </tr>";
          }
          ?>
          
      </table>

  <a href="../home/grupo50/Sites/index.php">
        <button> Volver al índice </button>
    </a>
</body>




