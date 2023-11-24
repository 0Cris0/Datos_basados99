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
      <a href="../index.php"><img src="../imagenes/logo2.png"></a>
    </div>

    <nav class='barra_nav'>
      <a href= "../menu/menu.php">Menu</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>Defrosting Multimedia</h1>
    </div>
  </header>

  <div class='contenido_menu'>

    <h2 class='sub-titulo'> Menu</h2>

    <br>
    <form action="../consultas/neoperfil.php">
      <input type="submit" value="Perfil" />
    </form>
    
    <form action="../consultas/neosubs.php">
      <input type="submit" value="Subscripciones" />
    </form>

    <form action="../consultas/neocompras.php">
      <input type="submit" value="Compras" />
    </form>

    <form action="../consultas/neoconsulta_e.php">
      <input type="submit" value="Consulta estructurada" />
    </form>

    <form action="../consultas/neoextra.php">
      <input type="submit" value="Funcionalidad extra" />
    </form>


  </div>

  <section class='contenido_contacto'>
  </section>
  
  <div class='parte_inferior'>
    <p>Fuente: de soda</p>
  </div>

    


  </body>
</html>
