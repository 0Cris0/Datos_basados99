<?php
// Iniciar sesión
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Registrarse</title>
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
      <h1>Registrarse</h1>
    </div>
  </header>


  <div class='contenido_registro'>

    <h2 class='sub-titulo'>Registrarse</h2>

    
    <?php 
      if(empty($_SESSION['username'])){
      ?>
      <!--Aquí está verificando que la entidad que actualmente está conectada
       a la página web y que ha sido captada por la función $_SESSION no tenga
       un username-->
        <form align="center" action="/Sites/consultas/manejo_registro.php" method="post">
          <p>Por favor, ingrese sus datos:</p><br><br>
          <p>Nombre de usuario: </p><input type="text" name="username"><br><br>
          <p>Contraseña: </p><input type="password" name="password"><br><br>
          <p>Nombre: </p><input type="text" name="nombre"><br><br>
          <p>Email: </p><input type="text" name="email"><br><br>
          <p>Fecha de nacimiento: </p><input type="date" name="fecha_nacimiento"><br><br>
          <br/><br/>
          <input type="submit" value="Registrarse">
          <!--Encontrar la manera de que cuando se logre registrar (cumpliendo las condiciones)
          se coloque algo como $_SESSION["username"] = $username_ingresado-->
      </div>
      <?php } else {
        echo "Ya tienes estás registrado";
      }
    ?>
    <!--i no está asignada la variable mostrar form para ingresar-->
  </div>
  
  <section class='contenido_contacto'>
  </section>
  
  <div class='parte_inferior'>
    <p>Fuente: de soda</p>
  </div>
</body>