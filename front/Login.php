<style>
  .banner-danger {
    /* border-color: var(--cas-theme-danger, #b00020); */
    border-color: #f5c6cb;
    color: var(--cas-theme-danger, #b00020);
  }

  .banner-dismissible {
    padding-right: 4rem;
  }
</style>
<?php
session_start();

if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])) {
  header("Location: Accueil.php");
}

include('head.php');
include('../back/Authentification_fct.php');
?>

<body style="background: #007bff; background: linear-gradient(to right, #3a3c3e, #313435);">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="Accueil.php">
        <img src="..\image\logo.png" alt="..." height="30">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" aria-current="page" href="Accueil.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Dashboard</a>
          </li>
        </ul>
        <div class="form-inline ms-auto">
          <a class="btn btn-outline-light btn-sm mx-2" href="Login.php">Login</a>
          <a class="btn btn-primary btn-sm" href="SignUp.php">Sign Up</a>
        </div>
      </div>
    </div>
  </nav>
  <!--------------->

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 font-weight-bold fs-5">Login</h5>
            <div class="banner banner-danger banner-dismissible">
              <?php
              if (isset($_SESSION['errormsg'])) {
                echo "<p>" . $_SESSION['errormsg'] . "</p>";
                unset($_SESSION['errormsg']);
              }
              ?>
            </div>
            <form action="../back/Authentification_fct.php?action=login" method="post">
              <div class="form-floating mb-3">
                <input name="Login_Username" type="text" class="form-control bloc_input" id="Login_Username" placeholder="Username">
                <label for="Login_Username">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input name="Login_Password" type="password" class="form-control bloc_input" id="Login_Password" placeholder="Password">
                <label for="Login_Password">Password</label>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Login</button>
              </div>
            </form>
            <hr class="my-4">
            <div class="d-grid">
              <a class="btn btn-dark btn-login text-uppercase fw-bold" href="SignUp.php">Not registered? Create an account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>