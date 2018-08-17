<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">App Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="administrador.php"><i class='fa fa-bar-chart'></i> Dashboard</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class='glyphicon glyphicon-plus'></i> Nuevo <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="Usuario.php">Usuario</a></li>
            <li><a href="TipoUsuario.php">Tipo Usuario</a></li>
            <li><a href="Region.php">Region</a></li>
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class='glyphicon glyphicon-list-alt'></i> Gestion <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="GestionarUsuario.php">Usuario</a></li>
            <li><a href="#">Tipo Usuario</a></li>
            <li><a href="#">Region</a></li>
          </ul>
        </li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class='glyphicon glyphicon-share'></i> Asignar <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="asignar.php">Cuestionario</a></li>
            <li><a href="#">Cliente a Usuario</a></li>
            <li><a href="#">Region a Usuario</a></li>
            <li><a href="#">Tipo Usuario a Usuario</a></li>
          </ul>
        </li>
       </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class='glyphicon glyphicon-user'></i> <?php echo $username ?></a></li>
		    <li><a href="logout.php"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
