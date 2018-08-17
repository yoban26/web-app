<?php
    session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>App Admin - Login</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-4">
                <h3 style="text-align: center;">Login - WS Administrator</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="account-wall">
                    <img class="profile-img" src="https://www.ourmycis.com/mycis_ws/user_image/user-default.png"
                        alt="">
                        <form class="form-signin" method="POST" action="controller/autentication.php">
                            <input type="text" class="form-control" placeholder="nombre de usuario" name="username" required autofocus>
                            <input type="password" class="form-control" placeholder="contraseña" name="password" required>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>

                                <?php
                                    if(isset($_SESSION["error"])){
                                        $error = $_SESSION["error"];
                                        echo "<span>$error</span>";
                                    }
                                ?>
                        </form>
                </div>
            </div>
        </div>
    </div>
  </body>
  <?php
    unset($_SESSION["error"]);
  ?>
  <?php
    require '/Plantilla/footer_buttom.php';
  ?>
</html>
