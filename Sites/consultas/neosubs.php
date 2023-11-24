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
      <h1>Subscripciones</h1>
    </div>
  </header>

    <h2 class='sub-titulo'>Proveedores de streaming</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        
        
        require("../config/conexion.php");

        $username = $_SESSION["username"];
        

        $query_prov = "SELECT * FROM proveedores_ps";
        # id_prov, nombre, costo

        $result = $db -> prepare($query_prov);
        $result -> execute();
        $proveedores = $result -> fetchAll();



        # Debe redirigir al perfil
        # en caso de ser correcto

        # O mandar al inicio de sesión si falló
        
    ?>
    <br>
    <section class='contenedor_general'>
    <table class='tabla'>
            <tr>
                <th>Nombre proveedor</th>
                <th>Ver provedor</th>
            </tr>
            <?php
                  // echo $pokemones;
                  # id_prov, nombre, costo
                  foreach ($proveedores as $j) {
                    echo "tr> <td>$j[1]</td> 
                    <td>
                    <form action='../consultas/neomostrar_proveedor.php'>
                    <input type='text' name='id_proveedor, value=$j[2]'>
                    <input type='submit' value='Ver' />
                    </form>
                </td>
                </tr>";
                }
                ?>
        </table>
        
    </section>
    <br>
    <form action="../menu/menu.php">
      <input type="submit" value="Menu" />
    </form>



    </body>