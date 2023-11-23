<?php
// Iniciar sesión
  session_start();
?>

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
      <a href= "/Sites/index.php">Inicio</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>Login</h1>
    </div>
  </header>


  <div class='contenido_login'>

  <h2 class='sub-titulo'>Login</h2>


  <?php if(empty($_SESSION['username']))?>
      <!--i no está asignada la variable mostrar form para ingresar-->

      <form align="center" action="/Sites/consultas/manejo_inicio_sesion.php" method="post">
          <p>Por favor, ingrese sus datos:</p><br><br>
          <p>Nombre de usuario: </p><input type="text" name="username"><br><br>
          <p>Contraseña: </p><input type="password" name="password"><br><br>
          <br/><br/>
          <input type="submit" value="Login">
      </div>
  </div>

  <section class='contenido_contacto'>
  </section>
  
  <div class='parte_inferior'>
    <p>Fuente: de soda</p>
  </div>
</body>
    
    
