<?php

    // Récupération du meilleur score actuel
    function GetPersonalBest()
    {
        include('../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $idUser = $_SESSION['idUser'];
            $query = "SELECT personalBest FROM score WHERE idUser = '$idUser' AND idJeu = 2";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $res = $row['personalBest'];
                return $res;   
            }                   
        }
    }   


?>
