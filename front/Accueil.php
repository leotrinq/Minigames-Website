<?php
  session_start();

  include('head.php');
?>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="..\image\logo.png" alt="..." height="30">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Dashboard/index.php">Dashboard</a>
            </li>
          </ul>
          <div class="form-inline ms-auto">
            <?php
              if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])){
            ?>
                <label class="text-light mx-3" ><?php echo "Hello ".$_SESSION["username"];
            ?>
                </label>
                <a class="btn btn-outline-light btn-sm" href="../back/Authentification_fct.php?action=logout">Logout</a>
            <?php
              }
              else{
            ?>
                <a class="btn btn-outline-light btn-sm mx-2" href="Login.php">Login</a>
                <a class="btn btn-primary btn-sm" href="SignUp.php">Sign Up</a>
            <?php
              }
            ?>            
          </div>
        </div>
      </div>
    </nav>

    <!-- Bloc Gris-->
    <div class="bg-secondary text-center d-flex align-items-center py-5 mb-5 fond_color" style="height: 50vh">
      <div class="container">
        <h1 class="fw-light text-white ">Test your skills</h1>
        <a class="btn btn-primary btn-lg btn_start" href="Jeu_Countdown.php">Start</a>
      </div>    
    </div>

    <!-- Bloc Jeux-->
    <div class="container">
      <div class="row justify-content-center">
        <!-- Countdown -->
        <a class="d-flex align-items-center mx-5 accueil_bloc_jeux" href="Jeu_Countdown.php">
          <div class="text-center center">
            <img src="..\image\countdown.png" class="logo_size" alt="...">
            <div class="text-center">
              <h5 class="card-title">Countdown</h5>
            </div>
          </div>
        </a>

        <!-- Timer -->
        <a class="d-flex align-items-center mx-5 accueil_bloc_jeux" href="Jeu_Timer.php">
          <div class="text-center center">
            <img src="..\image\timer.png" class="logo_size" alt="...">
            <div class="card-body text-center">
              <h5 class="card-title mb-0">Timer</h5>
            </div>
          </div>
        </a>

        <!-- QTE -->
        <a class="d-flex align-items-center mx-5 accueil_bloc_jeux" href="Jeu_QTE.php">
          <div class="text-center center">
            <img src="..\image\QTE.png" class="logo_size" alt="...">
            <div class="card-body text-center">
              <h5 class="card-title mb-0">QTE</h5>
            </div>
          </div>
        </a>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </body>

</html>