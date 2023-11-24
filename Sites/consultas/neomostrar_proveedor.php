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

        $query_detalle_prov = "detalle_proveedor($id_proveedor)";
        # monto, cantidad_pelis_cantidad_series

        $result = $db -> prepare($query_detalle_prov);
        $result -> execute();
        $detalle_prov = $result -> fetchAll();
      
      
    ?>

<br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Valor de la subscripcion</th>
                <th>Cantidad de películas</th>
                <th>Cantidad de series</th>
            </tr>

            <?php
                  // echo $pokemones;
                  # monto, cantidad_pelis, cantidad_series
                  foreach ($detalle_prov as $j) {
                    echo "<tr> <td>$j[0]</td> <td>$j[1]</td> <td>$j[2]</td> </tr>";
                }
                ?>
        </table>     
        
    </section>
    <br>
    
    <form action="../consultas/neomostrar_top.php">
      <?php foreach ($detalle_prov as $j) {
        echo "<input type='text' name='id_proveedor, value=$j[2]'>";
      } ?>
      <input type="submit" value="Mostrar Top 3" />
    </form>
    <br>
    <form action="../menu/menu.php">
      <input type="submit" value="Menu" />
    </form>
    </body>