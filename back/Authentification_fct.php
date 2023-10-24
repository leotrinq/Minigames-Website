<?php
    if (isset ($_GET['action'])){
        switch($_GET['action'])
    { 
        case 'login':
            Login();
            break;

        case 'signup':
            SignUp();
            break;

        case 'logout':
            Logout();
            break;
    }
    }

// Enregistrement d'un nouvel utilisateur
function SignUp()
{
    include('../database/db.php');

    if (isset($_POST["SignUp_Username"]) && isset($_POST["SignUp_Password"])) {
        $pseudo = $_POST['SignUp_Username'];
        $mdp = $_POST['SignUp_Password'];

        $query = "SELECT * FROM user WHERE username = '$pseudo' ";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // User already exists
            session_start();
            $_SESSION['errormsg'] = "Username already exists";
            header("Location: ../front/SignUp.php");
            exit();
        }

        if (empty($_POST["SignUp_Username"])) {
            session_start();
            $_SESSION['errormsg'] = "Username is empty";
            header("Location: ../front/SignUp.php");
            exit();
        } else if (empty($_POST["SignUp_Password"])) {
            session_start();
            $_SESSION['errormsg'] = "Password is empty";
            header("Location: ../front/SignUp.php");
            exit();
        } else if ($_POST["SignUp_Password"] != $_POST["SignUp_ConfirmPassword"]) {
            session_start();
            $_SESSION['errormsg'] = "Different Password and Confirmation Password";
            header("Location: ../front/SignUp.php");
            exit();
        } else {
            $query = "INSERT INTO user (username, password) VALUES ('$pseudo', '$mdp')";

            if (mysqli_query($conn, $query)) {
                // Enregistrement réussi
                echo "test";
                $query = "SELECT idUser from user where username = '$pseudo' and password = '$mdp'";
                $result = mysqli_query($conn, $query);
                echo mysqli_num_rows($result);
                if (mysqli_num_rows($result) == '1') {
                    $row = mysqli_fetch_assoc($result);
                    $idUser = $row['idUser'];
                    echo $idUser;
                }

                $query = "INSERT INTO score (idUser, idJeu) VALUES ('$idUser', '1')";
                mysqli_query($conn, $query);
                $query = "INSERT INTO score (idUser, idJeu) VALUES ('$idUser', '2')";
                mysqli_query($conn, $query);
                $query = "INSERT INTO score (idUser, idJeu) VALUES ('$idUser', '3')";
                mysqli_query($conn, $query);

                $file = fopen("data2.csv", "w");
                file_put_contents("data2.csv", "");
                fclose($file);

                //===============================================================
                // Lecture du contenu du fichier CSV dans un tableau
                $csv = array_map('str_getcsv', file("data2.csv"));
                // Parcours des lignes du fichier pour trouver la valeur à modifier
                foreach ($csv as $index => $row) {
                    if ($row[0] === 'totalplayers') {
                        // Récupération de la valeur souhaitée
                        $value = $row[1];
                        $csv[$index][1] = $value+1;
                        // Sortie de la boucle une fois la ligne trouvée
                        break;
                    }
                }

                // Ouverture du fichier CSV en écriture
                $file = fopen("data2.csv", 'w');

                // Écriture des lignes modifiées dans le fichier CSV
                foreach ($csv as $row) {
                    fputcsv($file, $row);
                }

                // Fermeture du fichier CSV
                fclose($file);
                //===============================================================

                header("Location: ../front/Login.php");
            } else {
                // Enregistrement échoué
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }

    mysqli_close($conn);
}

    // Connexion d'un utilisateur existant
    function Login()
    {
        include('../database/db.php');

        if (isset($_POST["Login_Username"])  && isset($_POST["Login_Password"])) {
            $pseudo = $_POST['Login_Username'];
            $mdp = $_POST['Login_Password'];
    
            $query = "SELECT * FROM user WHERE username = '$pseudo' AND password = '$mdp'";
            $result = mysqli_query($conn, $query);
    
            if (mysqli_num_rows($result) == 1) {
                // Connexion réussie
                session_start();
                // Récupérer une seule ligne
                while ($row = mysqli_fetch_row($result)) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["idUser"] = $row[0];
                    $_SESSION["username"] = $row[1];
                    $userId = $_SESSION["idUser"];
                    $file = fopen("data2.csv", "w");
                    file_put_contents("data2.csv", "");
                    fclose($file);
                    $file = fopen("data2.csv", "a");
                    $val = array("DATAS","VAL");
                    $data = array("idUser",$_SESSION["idUser"]);
                    $pb1 = array("PB1","");
                    $pb2 = array("PB2","");
                    $pb3 = array("PB3","");
                    $rank1 = array("rank1","");
                    $rank2 = array("rank2","");
                    $rank3 = array("rank3","");
                    $totalplayers = array("totalplayers","");
                    fputcsv($file, $val);
                    fputcsv($file, $data);
                    fputcsv($file, $pb1);
                    fputcsv($file, $pb2);
                    fputcsv($file, $pb3);
                    fputcsv($file, $rank1);
                    fputcsv($file, $rank2);
                    fputcsv($file, $rank3);
                    fputcsv($file, $totalplayers);
                    fclose($file);
                }
                mysqli_free_result($result);
    
                header("Location: ../front/Accueil.php");
            } else {
            // Connexion échouée
            session_start();
            $_SESSION['errormsg'] = "Incorrect username or password";
            header("Location: ../front/Login.php");
            }

        }

        mysqli_close($conn);
    }

    // Déconnexion d'un utilisateur
    function Logout()
    {
        session_start();
        $file = fopen("data2.csv", "w");
        file_put_contents("data2.csv", "");
        fclose($file);
        session_destroy();
        header("Location: ../front/Accueil.php");
    }
?>
<script src="chat-bar-demo.js"></script>