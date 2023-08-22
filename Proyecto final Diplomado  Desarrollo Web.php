<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
 
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login");
    } else {
      $message = 'Tus datos no coinciden';
    }
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>Iniciar Sesion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <style>
    @import url(style.css);
 </style>
    
  </head>
  <body id="bodylogin">
  
   

</body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1 style="color: white" class="tl">Inicia sesión</h1>
    
    <form action="login.php" method="POST">
      <input class="login" name="email" type="text" placeholder="Ingresa tu email">
      <input class="login"name="password" type="password" placeholder="Ingresa tu Password">
      <input class="login"type="submit" value="Enviar">

      <a href="./index.php"><img src="./Imagenes/Logo.PNG"id="img-logo1" width="320px" height="320px" alt="" srcset=""></a>
    </form>
  </body>
</html>