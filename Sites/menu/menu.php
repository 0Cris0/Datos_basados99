<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Menu</title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="/Sites/styles/neoindex.css">
    

    <!-- para que una consulta.php pueda importarlo -->

</head>

<body>
  <div class="parte_superior">
    <div class='logo'>
      <a href="/Sites/index.php"><img src="/Sites/imagenes/logo2.png"></a>
    </div>

    <nav class='barra_nav'>
      <a href= "/Sites/menu/menu.php">Menu</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>Defrosting Multimedia</h1>
    </div>
  </header>

  <div class='contenido_consultas'>

    <h2 class='sub-titulo'> Consultas</h2>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_1.php" method="post">
        <h3>Consulta 1</h3>
        <p>Ver los videojuegos con sus respectivos proveedores:</p>
        <input type="submit" value="Buscar">
      </form>
    </div>

    <br/>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_2.php" method="post">
        <h3>Consulta 2</h3>
        <p>Mostrar los videojuegos con al menos cierto número de reseñas positivas:</p>
        Numero de reseñas positivas:
        <input type="number" name="n_res" min=0>
        <br/><br/>
        <input type="submit" value="Buscar">
      </form>
    </div>

    <br/>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_3.php" method="post">
        <h3>Consulta 3</h3>
        <p>Buscar un juego con su respectivos proveedores a partir del título:</p>
        Ingrese el título de un videojuego:
        <input type="text" name="n_titulo">
        <br/><br/>
        <input type="submit" value="Buscar">
      </form>
    </div>

    <br/>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_4.php" method="post">
        <h3>Consulta 4</h3>
        <p>Mostrar los juegos que tengan a género específico o alguno de sus subgéneros inmediatos:</p>
        Ingrese un género:
        <input type="text" name="n_gen">
        <br/><br/>
        <input type="submit" value="Buscar">
      </form>
    </div>

    <br/>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_5.php" method="post">
        <h3>Consulta 5</h3>
        <p>Mostrar todos los juegos con sus proveedores asociados de un usuario determinado:</p>
        Ingrese un username:
        <input type="text" name="n_user">
        <br/><br/>
        <input type="submit" value="Buscar">
      </form>
    </div>

    <br/>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_6.php" method="post">
        <h3>Consulta 6</h3>
        <p>Mostrar todos los proveedores a los cuales un usuario específico ha preordenado más de un juego:</p>
        Ingrese un username:
        <input type="text" name="n_user">
        <br/><br/>
        <input type="submit" value="Buscar">
      </form>
    </div>

    <br/>

    <div class='Consulta'>
      <form align="center" action="consultas/consulta_7.php" method="post">
        <h3>Consulta 7</h3>
        <p>Mostrar el gasto total de cada usuario en juegos de subscripción:</p>
        <input type="submit" value="Buscar">
      </form>
    </div>

  </div>

  <section class='contenido_contacto'>
  </section>

  <div class='parte_inferior'>
    <p>Fuente: Miami me lo confirmó</p>
  </div>
</body>
<!--
  <br/><br/>

  <--?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT tipo FROM pokemones;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_tipo.php" method="post">
    Seleccinar un tipo:
    <select name="tipo">
      <--?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por tipo">
  </form>

  <br>
  <br>
  <br>
  <br>
</body>
->
</html>
