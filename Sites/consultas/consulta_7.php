<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 7 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../home/grupo50/Sites/styles/index.css">

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 7</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("../config/conexion.php");

        #Se construye la consulta como un string
            $query = "SELECT U.username as username, SUM(PA.monto) as gasto total
            FROM Pagos_sub AS PS, Usuarios as U, Pagos as PA
            WHERE PS.id_pago = PA.id_pago
            AND U.id_usuario = PA.id_usuario
            GROUP BY U.username
            ;";

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
            $result = $db -> prepare($query);
            $result -> execute();
            $usuarios = $result -> fetchAll();
    ?>

        <table>
            <tr>
            <th>Nombre de usuario</th>
            <th>Gasto total</th>
            </tr>
        
            <?php
                // echo $pokemones;
                foreach ($usuarios as $u) {
                echo "<tr> <td>$u[0]</td> <td>$u[1]</td> </tr>";
            }
            ?>
            
        </table>

  <a href="../home/grupo50/Sites/index.php">
        <button> Volver al índice </button>
    </a>
</body>



