<?php
session_start();
if (@$_SESSION['conn'] == TRUE) {
    $account_button = "account.php";
} else {
    $account_button = "login.php";
}

function generateRandomLetters($length)
{
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($letters), 0, $length);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Lay File</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.6" />
    <link href="style.css" rel="stylesheet" />
    <link rel="icon" src="icone.ico" />
    <meta name="google-site-verification" content="DuXyyEMMDlUUDL5p_SwXYoMu7rSR_9Z_CfpIzJ31p60" />
</head>
<header>
    <li>
        <img src='6964512.png' width="70px" style="border-radius: 5px; margin-top: 4px;">
    </li>
    <li>
        <a class="buttonheader" href="/index.php">
            <h3>Accueil</h3>
        </a>
    </li>
    <li>
        <a class="buttonheader" href="<?php echo $account_button; ?>">
            <h3>Mon compte</h3>
        </a>
    </li>
    <li>
        <a class="buttonheader" href="/index2.php">
            <h3>Conditions d'utilisations</h3>
        </a>
    </li>
</header>

<br>
<br>
<div class="content">
    <div class="content-wrapper">
        <div class="content4">
            <h2>La taille du fichier téléversé ne doit pas excèder 2Go.</h2>
            <h2>Le lien expire au bout de 7 jours.</h2>
            <h2>Il est fortement déconseillé de placer des fichiers pouvant contenir des informations sensibles telles que des données bancaires.</h2>
        </div>
        <br>
        <br>
        <form method="POST" enctype="multipart/form-data" style=" display: flex; flex-direction: column; text-align: center; justify-content: center; align-items: center; background-color: #121315; border-radius: 15px; padding: 15px; width: auto; margin-top: 15px;">
            <input type="file" name="uploaded_file[]" class="custom-file-input" multiple="multiple">
            <br>
            <div class="ud">
                <input type="checkbox" value="undelete" name="undelete">
                <label for="undelete" style="color: white;">Lien valable indéfiniment</label>
            </div>
            <br>
            <input type="submit" name="submit" value="Déposer">
            <h4 style="max-width: 500px;"><i>Le téléversement peut prendre quelques instants, ne quittez pas la page.</i></h4>
        </form>
    </div>
</div>

<?php
$conn = new mysqli("localhost", "root", "", "bdd1");

if (isset($_POST['submit'])) {
    foreach ($_FILES['uploaded_file']['name'] as $key => $originalName) {
        $randomLetters = generateRandomLetters(20);
        $min = 10000;
        $max = 1000000000000000;
        $rand = mt_rand($min, $max);
        $ID = "$rand" . "$randomLetters"; //ID du link
        $link = "http://lay-file.laysolutions.fr/index3.php?id=$ID"; //Link
        $qr_link = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$link"; //QR Code
        $date = date('Ymd'); //Date

        $fileSize = $_FILES['uploaded_file']['size'][$key];
        $maxSize = 4 * 1024 * 1024 * 1024;

        if ($fileSize < $maxSize) {

            if (@$_SESSION['conn'] == TRUE) {
                $id_rand = $_SESSION['id_rand'];
            } else {
                $id_rand = "0";
            }

            if (isset($_POST['undelete'])) {
                $ud = "yes";
            } else {
                $ud = "no";
            }

            $randomLetters1 = generateRandomLetters(20);
            $min1 = 10000;
            $max1 = 1000000000000000;
            $rand1 = mt_rand($min1, $max1);
            $fileName = "$rand1" . "$randomLetters1"; // Nom du fichier sur le SSD (intermédiaire)
            $originalName = $_FILES['uploaded_file']['name'][$key]; // Nom original du fichier uploadé
            $originalExt = pathinfo($originalName, PATHINFO_EXTENSION); // extension original
            $fileNameFinal = $fileName . "&&&&" . $ud; // Nom final du fichier sur le SSD
            $tmp_name = $_FILES['uploaded_file']['tmp_name'][$key]; // Nom temporaire
            $filePath = "D:\\file_upload_lf\\" . $fileNameFinal; // chemin du fichier sur le SSD

            $sql = "INSERT INTO id_name (nom_fichier, nom_link, date, extension, nom_fichier_original, id_account) VALUES ('" . $fileNameFinal . "', '" . $ID . "', '" . $date . "', '" . $originalExt . "', '" . $originalName . "', '" . $id_rand . "')";
            if (mysqli_query($conn, $sql)) {
            } else {
                echo "erreur";
            }

            if (move_uploaded_file($tmp_name, $filePath)) {
                $encryptionKey = '588885';
                $contents = file_get_contents($filePath);
                $encryptedContents = '';

                for ($i = 0; $i < strlen($contents); $i++) {
                    $encryptedContents .= $contents[$i] ^ $encryptionKey[$i % strlen($encryptionKey)];
                }

                file_put_contents($filePath, $encryptedContents);
            }

            echo '<div class="content3">';
            echo '<br>';
            echo '<h2>';
            echo '<div class="buttonlink">';
            echo "$originalName" . " :";
            echo '<br>';
            echo '<br>';
            echo '<a style="color: white;" href="' . $link . '">🔗 Lien du fichier</a>';
            echo '<br>';
            echo '<br>';
            echo '<img src="' . $qr_link . '">';
            echo '</div>';
            echo '</h2>';
            echo '</div>';
        }
    }
}

?>

</html>