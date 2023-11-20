<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Login</title>
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


  <div class='contenido_login'>

  <h2 class='sub-titulo'>Login</h2>


  <?php if(empty($_SESSION['username']))?>
    <!--i no está asignada la variable mostrar form para ingresar-->
    <form method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    ‹button type="submit" name="login"›Login‹/button>
    </form>
  </div>

  <section class='contenido_contacto'>
  </section>
  
  <div class='parte_inferior'>
    <p>Fuente: de soda</p>
  </div>
</body>
    
    
