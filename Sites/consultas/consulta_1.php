<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 1 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../home/grupo50/Sites/styles/index.css">
    

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 1</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");

        #Se obtiene el valor del input del usuario
        # Aunque en este caso no hay input :P 


        #Se construye la consulta como un string
            $query = "(SELECT VP.titulo, P.nombre FROM Juegos_proveedor as JP, Proveedores as P, Videojuegos_pun as VP WHERE JP.id_prov = P.id_prov AND JP.id_juego = VP.id_juego) UNION (SELECT VS.titulo, P.nombre FROM Juegos_proveedor as JP, Proveedores as P, Videojuegos_sub as VS WHERE JP.id_prov = P.id_prov AND JP.id_juego = VS.id_juego) ;";

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
            $result = $db -> prepare($query);
            $result -> execute();
            $juegos = $result -> fetchAll();
    ?>
    <table>
        <tr>
        <th>Nombre Videojuego</th>
        <th>Nombre Proveedor</th>
        </tr>
        <?php
            # echo $juegos;
            foreach ($juegos as $j) {
            echo "<tr> <td>$j[0]</td> <td>$j[1]</td> </tr>";
        }
        ?>      
    </table>

  <a href="../home/grupo50/Sites/index.php">
        <button> Volver al índice </button>
    </a>
</body>

