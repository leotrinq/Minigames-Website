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

function GetPB($idJeu)
{
    include('../../database/db.php');

    if(isset($_SESSION["logged_in"])){
        $idUser = $_SESSION['idUser'];       
        $query = "SELECT personalBest From score WHERE idUser=$idUser AND idJeu = $idJeu ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $res = $row['personalBest'];
        return $res;                   
    }

}

function GetRanking($idJeu)
    {
        include('../../database/db.php');

        if(isset($_SESSION["logged_in"])){
            $idUser = $_SESSION['idUser'];
            $query = "SELECT personalBest From score WHERE idUser = $idUser AND idJeu = $idJeu";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $PB = $row['personalBest'];

            $query = "SELECT Count(*) as rank From score WHERE idJeu=$idJeu AND personalBest < $PB+0.001";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $rank = $row['rank'];
            

            return $rank;                   
        }
    }

    function GetLeaderBoard($idjeu)
    {
        include('../../database/db.php');
        if(isset($_SESSION["logged_in"])){
            $query = "SELECT username FROM user,score WHERE user.idUser = score.idUser AND score.idJeu=$idjeu AND score.personalBest IS NOT NULL ORDER BY score.personalBest ASC  ";
            $result = mysqli_query($conn, $query);
            $i=0;
            while(($row = mysqli_fetch_assoc($result)) || ($i<3) )
            {
                if($row == null)
                {break;}
                $res[$i] = $row['username'];
                $i=$i +1;
            }
            return $res;   
        }
    }

?>