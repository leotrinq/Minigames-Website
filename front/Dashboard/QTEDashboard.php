<?php
  session_start();
  if (!isset($_SESSION["logged_in"])){
    header("Location: ../Login.php");
  }

  include('../../back/Games_Dashboard_fct.php');
  $totalplayers = GetTotalPlayer();
  $PB = GetPB(3);
  $rank = GetRanking(3);
  $leaderboard =GetLeaderBoard(3);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Own CSS -->
        <link rel="stylesheet" href="../../css/Style.css">        
    </head>
    <body >
        <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="../Accueil.php">
        <img src="../../image/logo.png" alt="..." height="30">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link " aria-current="page" href="../Accueil.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Dashboard</a>
          </li>
        </ul>
        <div class="form-inline ms-auto">
            <?php
            if (isset($_SESSION["logged_in"]) && ($_SESSION["logged_in"])){?>
              <label class="text-light mx-3" ><?php echo "Hello ".$_SESSION["username"];?></label>
              <a class="btn btn-outline-light btn-sm" href="../../back/Authentification_fct.php?action=logout">Logout</a>
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
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Games</div>
                            <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gamepad"></i></div> 
                                Games
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="CountdownDashboard.php">Countdown</a>
                                    <a class="nav-link" href="TimerDashboard.php">Timer</a>
                                    <a class="nav-link active" href="#">QTE</a>
                                </nav>
                            </div>

                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                            <?php echo $_SESSION['username'];?> 
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">QTE</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Here are all your stats when it comes to the QTE game</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Your Personal Best 
                                        <br>
                                        <h1 >                                         
                                        <?php
                                        if($PB != null)
                                        {
                                            echo $PB ;
                                        }
                                        else
                                        {
                                            echo '---';
                                        }?>s</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Your Rank 
                                        <br>
                                        <h1 >                                         
                                        <?php
                                        if($PB != null && $rank>0)
                                        {
                                            echo $rank ;
                                        }
                                        else
                                        {
                                            echo '---';
                                        }?>/<?php echo $totalplayers;?> </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Leaderboard
                                    <br> 
                                    <h5 class="card-title title_top2">1. <?php if(isset($leaderboard[0])){echo $leaderboard[0];} ?></h5> 
                                    <h5 class="card-title title_top2">2. <?php if(isset($leaderboard[1])){echo $leaderboard[1];} ?></h5> 
                                    <h5 class="card-title title_top2">3. <?php if(isset($leaderboard[2])){echo $leaderboard[2];} ?></h5> 
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                
                            <?php
                                if($PB != null)
                                {
                                    $place = $rank / $totalplayers ;
                                    if($rank==1)
                                    {
                                    ?>
                                    <div class="card text-white mb-4 color_top1">
                                        <div class="card-body">Wow, are you the fastest man alive?</div>
                                    </div>
                                    <?php
                                    }
                                    elseif($rank==2)
                                    {
                                    ?>
                                    <div class="card text-white mb-4 color_top2">
                                        <div class="card-body">You deserve this second place, well played.</div>
                                    </div>
                                    <?php
                                    }
                                    elseif($rank==3)
                                    {
                                    ?>
                                    <div class="card text-white mb-4 color_top3">
                                        <div class="card-body">You are on the podium, congratulations!</div>
                                    </div>
                                    <?php
                                    }
                                    elseif($place<0.25)
                                    {
                                    ?>    
                                    <div class="card text-white mb-4 color_top25">
                                        <div class="card-body">You are among the best players, well done!</div>
                                    </div>
                                    <?php
                                    }
                                    elseif($place<0.50)
                                    {
                                    ?>
                                    <div class="card text-white mb-4 color_top50">
                                        <div class="card-body">You are above the average, good job.</div>
                                    </div>
                                    <?php
                                    }
                                    elseif($place<0.75)
                                    {
                                    ?>
                                    <div class="card text-white mb-4 color_top75">
                                        <div class="card-body">Improve your scores to get above the top 50% of players.</div>
                                    </div>
                                    <?php
                                    }                                
                                    elseif($place<1)
                                    {
                                    ?>
                                    <div class="card text-white mb-4 color_top100">
                                        <div class="card-body">It could be worse... Oh wait.</div>
                                    </div>
                                    <?php
                                    }                                
                                }
                                else
                                {?>
                                    <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><h3><?php echo 'maybe you should think about playing some games first?';?></h3> </div>
                                    </div>
                                <?php
                                }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Global distribution by personal best
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ELA 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="chart-area-qte.js"></script>
        <script src="chart-bar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    </body>
</html>
