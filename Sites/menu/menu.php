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

  <div class='contenido_paginas'>

    <h2 class='sub-titulo'> Menu</h2>

    <div class='opcion_pagina'>
      <h3>Subscripciones de streaming</h3>      
    </div>

    <div class='opcion_pagina'>
      <h3>Películas  de pago único</h3>      
    </div>

    <div class='opcion_pagina'>
      <h3>Juegos de pago único</h3>      
    </div>

    <div class='opcion_pagina'>
      <h3>[** Consulta estructurada]</h3>      
    </div>

    <div class='opcion_pagina'>
      <h3>[** Funcionalidad extra]</h3>      
    </div>
    <br/>
  </div>

  </body>
</html>
