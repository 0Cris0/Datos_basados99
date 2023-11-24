<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 2 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../home/grupo50/Sites/styles/index.css">

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 2</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");

        #Se obtiene el valor del input del usuario
        $n_res = $_POST["n_res"];
        $n_res = intval($n_res);

        #Se construye la consulta como un string
            $query = "SELECT *
            FROM (
                SELECT VP.nombre as nombre, COUNT(R.id_res) as cont
                FROM Resenas as R, Videojuegos_pun as VP
                WHERE veredicto = 'positivo'
                AND R.id_juego = VP.id_juego
                GROUP BY VP.nombre
                --
                UNION
                --
                SELECT VS.nombre as nombre, COUNT(R.id_res) as cont
                FROM Resenas as R, Videojuegos_sub as VS
                WHERE veredicto = 'positivo'
                AND R.id_juego = VS.id_juego
                GROUP BY VS.nombre
            ) as conjunto
            WHERE conjunto.cont > $n_res
            ;";
            # Retorna: nombre, cont

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
            $result = $db -> prepare($query);
            $result -> execute();
            $juegos = $juegos -> fetchAll();
    ?>
    <table>
        <tr>
        <th>Nombre videojuego</th>
        <th>Número de reseñas positivas</th>
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
