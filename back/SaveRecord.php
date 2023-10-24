<?php
    session_start();
    include('../database/db.php');
    $score = $_GET['score'];
    $idjeu = $_GET['idjeu'];
    $action =$_GET['action']; 
    if (isset($_SESSION["logged_in"]) && $action=='savepb'){
        $idJoueur = $_SESSION['idUser'];
        $query = "UPDATE score SET personalBest ='$score' WHERE idUser = '$idJoueur' AND idJeu = $idjeu";
        $result = mysqli_query($conn, $query);
        
    }
    if($idjeu == 1)
    {
        header("Location:../front/Jeu_Countdown.php?ecartFinal=$score");
    }
    elseif($idjeu == 2)
    {
        header("Location:../front/Jeu_Timer.php?ecartFinal=$score");
    }
    elseif($idjeu == 3)
    {
        header("Location:../front/Jeu_QTE.php?ecartFinal=$score");
    }
    
    die();
?>