<?php
session_start();

if (@$_SESSION['conn'] == TRUE) {
    $account_button = "account.php";
} else {
    $account_button = "login.php";
}

$conn = new mysqli("localhost", "root", "", "bdd1");
if (@!$_SESSION['conn'] == TRUE) {
    header('Location: /login.php');
} else {
    $sql = "SELECT * FROM id_name WHERE id_account = '" . $_SESSION['id_rand'] . "'";
    $result = mysqli_query($conn, $sql);

    $id_account = $_SESSION['id_rand'];
}
?>

<html>

<head>
    <title>Compte</title>
    <link href="style_acc.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=0.6" />
    <link rel="icon" src="6964512.png" />
    <meta name="google-site-verification" content="joU9yt2dR2TyrhUnMQ_Hh_UPPjgYHUG_LqFV7vB49IQ" />
</head>
<header>
    <li>
        <img src='6964512.png' width="70px" style="border-radius: 5px; margin: 0;">
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
<div class="title">
    <div>
        <h1>Mes fichiers</h1>
    </div>
    <div class="button_link_div">
        <a class="button_link" href="/stop_session.php">
            <h2>Se déconnecter</h2>
        </a>
    </div>
</div>

<h2 style="color: white; margin-left: 15px;"> Mon id : <?php echo $id_account; ?></h2>

</html>
<?php
foreach ($result as $row) {
    $nom_fichier_original = $row['nom_fichier_original'];
    $date = $row['date'];
    $id_link = $row['nom_link'];
    $id_rand = $_SESSION['id_rand'];
    $nom_fichier = $row['nom_fichier'];
    $extension = $row['extension'];
    $link = "http://lay-file.laysolutions.fr/index3.php?id=" . $id_link;

    echo "<div class='link_case'>";
    echo '<div class="button_link1">';
    echo '<a href="' . $link . '">' . $nom_fichier_original . '</a>';
    echo '</div>';
    
    echo '<div class="form_suppr_share">';
    /** Bouton suppression, envoie des donné pour l'execution de la suppression en bas (en _suppr) */
        /**Confirmation de suppression du fichier avec checkbox */
    echo '<form method="POST" style="margin: 0px;">';
    echo '<input type="hidden" name="id_link_suppr" value="' . $id_link . '">';
    echo '<input type="hidden" name="id_rand_suppr" value="' . $id_rand . '">';
    echo '<input type="submit" class="submit1" name="suppr" value="Supprimer">';
    echo '</form>';

    echo '</div>';
    echo "</div>";
}

if (isset($_POST['suppr'])) {
    $id_link_suppr = $_POST['id_link_suppr'];
    $id_rand_suppr = $_POST['id_rand_suppr'];

    $sql = "DELETE FROM id_name WHERE id_account = '$id_rand_suppr' AND nom_link = '$id_link_suppr'";
    mysqli_query($conn, $sql);
    
    header('Location: /redirect.php');
    exit();
}


