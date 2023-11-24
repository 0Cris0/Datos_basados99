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
    <link rel="stylesheet" href="../Sites/styles/neoindex.css"> 

    <!-- para que una consulta.php pueda importarlo -->

<body>
  <div class="parte_superior">
    <div class='logo'>
      <a href="../Sites/index.php"><img src="../Sites/imagenes/logo2.png"></a>
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

    <?php
        
        require("../config/conexion.php");

        $username = $_POST["username"];
        $contrasena = $_POST["password"];

        $query = "credenciales_usuario($username, $contrasena)";
        # Se tiene que verificar que sea correcto el inicio de sesión

        # De ser correcto $_SESSION["username"] = $username_ingresado

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
        $resultado = $db -> prepare($query);
        $resultado -> execute();
        $correcto = $resultado -> fetchAll();
        
        #$estado = true
        # $estado = false

        # Debe redirigir al perfil
        # en caso de ser correcto

        # O mandar al inicio de sesión si falló
    ?>
    <?php if($correcto){
      $_SESSION["username"] = $username
       ?>
        <h2 class='sub-titulo'>Bienvenido:  <?php echo $_SESSION["username"]?></h2>

        <br>
        <p>Has logrado logguearte exitosamente, clickea el siguiente botón para continuar:</p>
        <br>

        <form action="/Sites/consultas/neoperfil.php">
        <input type="submit" value="Perfil" />
        </form>


    <?php }else{?>    

        <div class='error'>
            <p class='error'>Algo salió mal, por favor inténtelo nuevamente:</p>
        </div>

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

    <?php }?>
  

  <section class='contenido_contacto'>
  </section>
  
  <div class='parte_inferior'>
    <p>Fuente: de soda</p>
  </div>
    </body>
