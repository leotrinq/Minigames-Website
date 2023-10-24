<?php

    function GetTotalPlayer()
    {
        include('../../database/db.php');

        if(isset($_SESSION["logged_in"])){
            $query = "SELECT COUNT(*) as TotalPlayers From user";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $res = $row['TotalPlayers'];
            return $res;                   
        }
    }
    
    function GetRanking()
    {
        include('../../database/db.php');

        if(isset($_SESSION["logged_in"])){
            $idUser = $_SESSION['idUser'];
            $query = "SELECT Count(*) as TotalGames From jeu";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $totalgames = $row['TotalGames'];
            $rank = array();
            for ($i = 1; $i <= $totalgames; $i++) {
            $query = "SELECT personalBest From score WHERE idUser = $idUser AND idJeu = $i AND personalBest IS NOT NULL";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $PB = $row['personalBest'];
                $query = "SELECT Count(*) as rank From score WHERE idJeu=$i AND personalBest < $PB+0.001";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $rank[$i] = $row['rank'];
                }
            }    
            }

            return $rank;                   
        }
    }



?>
