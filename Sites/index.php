<?php include('templates/header.html');   ?>

<body>
  <div class="parte_superior">
    <div class='logo'>
      <a href="../Sites/index.php"><img src="../Sites/imagenes/logo2.png"></a>
    </div>

    <nav class='barra_nav'>
      <!--a href= "menu/menu.php">Menu</a-->
      <a href= "../Sites/login/login.php">Iniciar sesión</a>
      <a href= "../Sites/login/registro.php">Registrarse</a>
    </nav>
  </div>

  <header class='contenedor_header'>
    <div class='titulo'>
      <h1>Defrosting Multimedia</h1>
    </div>

    <div id='bienvenida'>
      <p  id='bienvenida'>Bienvenido a un interesante modelo de compra y subscripción de películas, series y videojuegos</p>
    </div>
  </header>

  <section class= 'logo_brande'>
      <h2 class='sub-titulo'>Descripción</h2>
      <img id='logo_grande' src="../Sites/imagenes/logo2.png">
  </section>     
    <br>
  <section class='contenido_equipo'>
    <p>En esta aplicación podrás ver las distintas películas y series que ofrecen cada uno de nuestros proveedores, al igual que todos los videojuegos ofrecidos por las distintas plataformas asociadas</p>
    <br>
    <p>Ven y aprovecha los distintos contenidos multimedia que ofrece nuestra app mediante sistemas de subscripción o pago único según el caso</p>
    <br>
    <p>Para acceder a todas las funcionalidades por favor regístrese o inicie sesión</p>
  </section>

  <section class='contenido_equipo'>
    <h2 class='sub-titulo'>Equipo de desarrollo</h2>
      <li>Benjamín Peña</li>
      <li>Sebasstían Beltran</li>
      <li>Maximiliano Valdivia</li>
      <li>Cristóbal Albornoz</li>
  </section>

  <section class='contenido_contacto'>
    <form action="../Sites/login/login.php">
      <input type="submit" value="Login" />
    </form>
    <br>
    <form action="../Sites/login/registro.php">
      <input type="submit" value="Registrarse" />
    </form>
    <br>
  </section>

  <div class='parte_inferior'>
    <p>Fuente: Sus amogus</p>
  </div>
  </body>
</html>
