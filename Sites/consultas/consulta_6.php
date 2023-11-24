<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Consulta 6 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../home/grupo50/Sites/styles/index.css">

    <!-- para que una consulta.php pueda importarlo -->

</head>


<body>
    <h2 align="center">Consulta 6</h2>

    <?php
      #Llama a conexión, crea el objeto PDO y obtiene la variable $db
      require("../config/conexion.php");

      #Se obtiene el valor del input del usuario
      $n_user = $_POST["n_user"];
      # $n_user = intval($n_user);

      #Se construye la consulta como un string
      $query = "SELECT P.nombre, conjunto.contador
        FROM (
            -- número de preórdenes
            SELECT PP.id_proveedor as proveedor, count(PP.id_juego) as contador
            FROM Pagos_pun as PP, Pagos as PA, Usuarios as U
            WHERE PP.preorden = true
            AND PP.id_pago = PA.id_pago
            AND U.id_usuario = PA.id_usuario
            AND U.username = $n_user
            GROUP BY PP.id_proveedor
        ) as conjunto, Proveedores as P
        WHERE contador > 1
        AND P.id_prov = conjunto.proveedor
        ;";

      #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
      $result = $db -> prepare($query);
      $result -> execute();
      $prove = $result -> fetchAll();
    ?>

      <table>
        <tr>
          <th>Nombre proveedor</th>
          <th>Cantidad de preórdenes</th>
        </tr>
          <?php
            // echo $pokemones;
            foreach ($prove as $p) {
              echo "<tr> <td>$p[0]</td> <td>$p[1]</td> </tr>";
          }
          ?>
      </table>

  <a href="../home/grupo50/Sites/index.php">
        <button> Volver al índice </button>
    </a>
</body>




