<?php
// Iniciar sesión
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Menu</title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="../styles/neoindex.css">
    

    <!-- para que una consulta.php pueda importarlo -->

</head>

<body>
  <div class="parte_superior">
    <div class='logo'>
      <a href="../Sites/index.php"><img src="../imagenes/logo2.png"></a>
    </div>

    <nav class='barra_nav'>
      <a href= "../menu/menu.php">Menu</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>[WIP]</h1>
    </div>
  </header>

  <div class='contenido_menu'>

    <h2 class='sub-titulo'>[WIP / Easter egg]</h2>

    <audio controls>
      <source src="../easter_egg/defrost.mp3" type="audio/mp3">
      Your browser does not support the audio element.
    </audio>

    <br>

    <img src="../imagenes/defrost.jpg">
    <br>
    <form action="#">
      <input type="submit" value="[WIP]" />
    </form>

    <form action="../menu/menu.php">
      <input type="submit" value="Menu" />
    </form>
  </div>

  <section class='contenido_contacto'>
  </section>
  
  <div class='parte_inferior'>
    <p>Fuente: de soda</p>
  </div>

    


  </body>
</html>