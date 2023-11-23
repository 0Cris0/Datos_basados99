<?php
// Iniciar sesión
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>[Falta contexto]</title>
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

    <h2 class='sub-titulo'>Revisión de login</h2>

    <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        
        /*
        require("../config/conexion.php");

        $username = $_POST["username"];
        $password = $_POST["password"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];

        $query = "";
        # Probablemente sea una de UPDATE

        # $_SESSION["username"] = $username_ingresado

        #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
        $result = $db -> prepare($query);
        $result -> execute();
        $juegos = $result -> fetchAll();

        # Debe redirigir al perfil

        # No sé si deberíamos hacer las comprobaciones aquí de la validez
        # de la cosa o antes (de momento se está dando el espacio para que ocurra antes)
        */
        $estado = true
        # $estado = false
    ?>
    <?php if($estado){ ?>
        <h2 class='sub-titulo'>Bienvenido</h2>

        <br>
        <p>Has logrado registrarte exitosamente, clickea el siguiente botón para continuar:</p>
        <br>

        <form action="/Sites/consultas/neoperfil.php">
        <input type="submit" value="Perfil" />
        </form>


    <?php }else{?>

        <div class='error'>
            <p class='error'>Algo salió mal, por favor inténtelo nuevamente</p>
        </div>

        <div class='contenido_registro'>
            <h2 class='sub-titulo'>Registrarse</h2>
            <?php if(empty($_SESSION['username'])){?>
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
    <?php }?>
    </body>
