<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 3 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../home/grupo50/Sites/styles/index.css">

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 3</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");

        #Se obtiene el valor del input del usuario
        $n_titulo = $_POST["n_titulo"];
        # $n_titulo = intval($n_titulo);
        # [OJO] Ver si es necesario algún cambio de atributo

        #Se construye la consulta como un string
            $query = "SELECT *
            FROM (
                SELECT VP.titulo, P.nombre
                FROM Juegos_proveedor as JP, Proveedores as P, Videojuegos_pun as VP
                WHERE JP.id_prov = P.id_prov
                AND JP.id_juego = VP.id_juego
                --
                UNION
                --
                SELECT VS.titulo, P.nombre
                FROM Juegos_proveedor as JP, Proveedores as P, Videojuegos_sub as VS
                WHERE JP.id_prov = P.id_prov
                AND JP.id_juego = VS.id_juego
            ) as conjunto
            WHERE conjunto.titulo = $n_titulo
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
