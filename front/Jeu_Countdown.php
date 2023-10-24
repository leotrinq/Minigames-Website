<?php
session_start();

include('../back/Jeu_Countdown_fct.php');

$personalBest = GetPersonalBest();
if ($personalBest == null) {
  $personalBest = "";
}

//===============================================================
// Lecture du contenu du fichier CSV dans un tableau
$csv = array_map('str_getcsv', file("../back/data2.csv"));

// Parcours des lignes du fichier pour trouver la valeur à modifier
foreach ($csv as $index => $row) {
    if ($row[0] === 'PB1') {
        // Récupération de la valeur souhaitée
        $value = $row[1];
        // Vérification et modification de la valeur si nécessaire
        if ($value != $personalBest) {
            $csv[$index][1] = $personalBest;
        }
        // Sortie de la boucle une fois la ligne trouvée
        break;
    }
}

// Ouverture du fichier CSV en écriture
$file = fopen("../back/data2.csv", 'w');

// Écriture des lignes modifiées dans le fichier CSV
foreach ($csv as $row) {
    fputcsv($file, $row);
}

// Fermeture du fichier CSV
fclose($file);
//===============================================================


include('../back/Games_fct.php');
$totalplayers = GetTotalPlayer();
//===============================================================
  // Lecture du contenu du fichier CSV dans un tableau
  $csv = array_map('str_getcsv', file("../back/data2.csv"));

  // Parcours des lignes du fichier pour trouver la valeur à modifier
  foreach ($csv as $index => $row) {
      if ($row[0] === 'totalplayers') {
          // Récupération de la valeur souhaitée
          $value = $row[1];
          // Vérification et modification de la valeur si nécessaire
          if ($value != $totalplayers) {
              $csv[$index][1] = $totalplayers;
          }
          // Sortie de la boucle une fois la ligne trouvée
          break;
      }
  }

  // Ouverture du fichier CSV en écriture
  $file = fopen("../back/data2.csv", 'w');

  // Écriture des lignes modifiées dans le fichier CSV
  foreach ($csv as $row) {
      fputcsv($file, $row);
  }

  // Fermeture du fichier CSV
  fclose($file);
  //===============================================================

$rankgood = true;
try {
  $rank = GetRanking(1);
} catch (Exception $e) {
  $rankgood = false;
}
$leaderboard = GetLeaderBoard(1);

if ($rankgood){
  //===============================================================
  // Lecture du contenu du fichier CSV dans un tableau
  $csv = array_map('str_getcsv', file("../back/data2.csv"));

  // Parcours des lignes du fichier pour trouver la valeur à modifier
  foreach ($csv as $index => $row) {
      if ($row[0] === 'rank1') {
          // Récupération de la valeur souhaitée
          $value = $row[1];
          // Vérification et modification de la valeur si nécessaire
          if ($value != $rank) {
              $csv[$index][1] = $rank;
          }
          // Sortie de la boucle une fois la ligne trouvée
          break;
      }
  }

  // Ouverture du fichier CSV en écriture
  $file = fopen("../back/data2.csv", 'w');

  // Écriture des lignes modifiées dans le fichier CSV
  foreach ($csv as $row) {
      fputcsv($file, $row);
  }

  // Fermeture du fichier CSV
  fclose($file);
  //===============================================================
}


include('head.php');
?>

<script>
  var startTime;
  var timer;
  var etat = 0;
  var target_time;
  var stop = false;


  function jeuStart() {

    var fond_timer = document.getElementById("fond_timer");
    var txt_timer = document.getElementById("timer");
    var txt_target = document.getElementById("target");
    var txt_result = document.getElementById("result");
    var txt_retry = document.getElementById("retry");
    var txt_personalBest = document.getElementById("personalBest");

    // Start
    if (etat == 0) {
      //Si on est en off  
      fond_timer.style.background = 'rgb(' + 85 + ',' + 89 + ',' + 92 + ')';
      txt_timer.style.opacity = 100;
      random_start = Math.floor(Math.random() * (10 - 5) + 5) * 1000;
      startTime = new Date().getTime();
      timer = setInterval(updateTimer, 10); // update every 10 milliseconds            
      txt_target.innerHTML = "Your target time is <b><span style='color: #ffca18'>" + "0" + "</span></b> seconds";
      txt_target.style.opacity = 100;

      txt_result.style.opacity = 0;
      txt_retry.style.opacity = 0;

      etat = 1; //Passe en on
    }
    // Stop
    else {
      clearInterval(timer);
      txt_timer.style.opacity = 0;
      var currentTime = new Date().getTime();
      var elapsed = currentTime - startTime;
      var difference = Math.abs((elapsed) / 1000);
      var ecart = random_start / 1000 - difference;
      var ecartFinal = ecart.toFixed(2);

      txt_result.innerHTML = "You were <b>" + ecartFinal + "</b> seconds away from the target time.";
      if (txt_personalBest.innerHTML == "" || ecartFinal < Number(txt_personalBest.innerHTML)) {
        txt_personalBest.innerHTML = ecartFinal;
        <?php if (isset($_SESSION["logged_in"])) { ?>
          window.location = `../back/SaveRecord.php?score=${ecartFinal}&idjeu=1&action=savepb`;
        <?php
        } ?>
      } else {
        <?php $nopb = true; ?>
      }

      txt_result.style.opacity = 100;
      txt_retry.innerHTML = "Click to retry";
      txt_retry.style.opacity = 100;

      // If the user was exactly on time
      if (difference == 0) {
        txt_result.innerHTML += " Congratulations, you were spot on!";
      }

      stop = false;
      etat = 0; //Passe en off
    }
  }

  function updateTimer() {

    var txt_timer = document.getElementById("timer");
    var currentTime = new Date().getTime();
    var elapsed = random_start - (currentTime - startTime);

    var minutes = Math.floor(elapsed / 60000);
    var seconds = Math.floor((elapsed % 60000) / 1000);
    var milliseconds = elapsed % 1000;

    // Add leading zeros to seconds and milliseconds
    if (seconds < 10) {
      seconds = seconds;
    }
    if (milliseconds < 100) {
      milliseconds = "0" + milliseconds;
    }
    if (milliseconds < 10) {
      milliseconds = "0" + milliseconds;
    }
    if (seconds < 0) {
      //stop = true;
      txt_timer.style.opacity = 0;
      jeuLose();
    }

    if (!stop) {
      txt_timer.innerHTML = seconds + "." + milliseconds;
    }
  }

  function jeuLose() {

    var fond_timer = document.getElementById("fond_timer");
    var txt_result = document.getElementById("result");
    var txt_retry = document.getElementById("retry");

    clearInterval(timer);
    txt_result.innerHTML = "You took too much time...";
    txt_result.style.opacity = 100;
    txt_retry.innerHTML = "Click to retry";
    txt_retry.style.opacity = 100;
    fond_timer.style.background = 'rgb(' + 207 + ',' + 47 + ',' + 53 + ')';
    etat = 0; //Passe en off      
  }
</script>

<body>
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
            <a class="nav-link" href="Dashboard\index.php">Dashboard</a>
          </li>
        </ul>
        <div class="form-inline ms-auto">
          <?php
          if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])) {
          ?>
            <label class="text-light mx-3"><?php echo "Hello " . $_SESSION["username"]; ?></label>
            <a class="btn btn-outline-light btn-sm" href="../back/Authentification_fct.php?action=logout">Logout</a>
          <?php
          } else {
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
  <div class="text-center d-flex align-items-center py-5 mb-5 fond_color" id="fond_timer" onclick="jeuStart();" style="height: 50vh">
    <div class="container">
      <p class="fw-light text-white align-items-top btn_target" id="target">Your target time is x seconds</p>
      <h1 class="fw-light text-white btn_timer" id="timer">Countdown</h1>
      <?php
      if (isset($_GET['ecartFinal']) && $nopb != true) {
        $res = $_GET['ecartFinal'];
        echo "<p class='fw-light text-white' >You were $res seconds away from the target time.</p>";
      } ?>
      <p class='fw-light text-white btn_result' id='result'>You were x seconds away from the target time.</p>
      <p class="fw-light text-white btn_retry" id="retry">Click to start</p>
    </div>
  </div>

  <!-- Bloc Jeux-->
  <div class="container">
    <div class="row justify-content-center">
      <!-- Personal Record -->
      <div class="bloc_jeux1">
        <div class="text-center center">
          <h5 class="card-title title_score">Score</h5>
          <h5 class="card-title title_pr">Personal record :</h5>
          <h5 class="card-title title_cd" id="personalBest"><?php echo $personalBest; ?></h5>
        </div>
      </div>
      <!-- Leaderboard -->
      <div class="bloc_jeux1">
        <h5 class="card-title title_ldb">Leaderboard :</h5>
        <h5 class="card-title title_top">1. <?php if (isset($leaderboard[0])) {echo $leaderboard[0];} ?></h5>
        <h5 class="card-title title_top">2. <?php if (isset($leaderboard[1])) {echo $leaderboard[1];} ?></h5>
        <h5 class="card-title title_top">3. <?php if (isset($leaderboard[2])) {echo $leaderboard[2];} ?></h5>
        <h5 class="card-title title_top">Your rank. <?php if ($rankgood && $rank>0) {echo $rank;} else {echo '---';} ?>/<?php echo $totalplayers; ?></h5>
      </div>

      <!-- Rules -->
      <div class="bloc_jeux2">
        <div class="">
          <h5 class="card-title title_rules">Rules</h5>
          <h5 class="card-title title_text">Countdown is a reflex game that tests your ability to stop a countdown timer as close to 0 as possible without going over it. Click once to start the timer, and then click again as close to 0 as possible to stop it.</h5>
        </div>
      </div>

      <!-- Statistics -->
      <div class="bloc_jeux3">
        <div class="">
          <h5 class="card-title title_rules">Statistics</h5>
          <div>
              <div class="card-body" style="background-color:(153,205,254,0.1);"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="chart-area-countdown.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
</body>

</html>