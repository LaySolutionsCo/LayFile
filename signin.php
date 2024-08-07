<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bdd1");
if (@$_SESSION['conn'] == TRUE) {
    header('Location: /account.php');
} else {
    if (isset($_POST['submit'])) {
        $id_rand = mt_rand(1000, 10000000);
        $user = $_POST['user'];
        $pass = sha1( $_POST['pass']);
        $post = $_POST['submit'];

        $sql = "INSERT INTO bdd_user (user, mdp, id_rand) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $user, $pass, $id_rand);

        if ($stmt->execute()) {
            $_SESSION['conn'] = FALSE;
            header('Location: /account.php');
            exit();
        } else {
            echo "Erreur lors de l'insertion dans la base de données.";
        }
    }
}
?>
<html>

<head>
    <title>Lay File - Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.8" />
    <link href="style_conn.css" rel="stylesheet" />
</head>
<div class="form_div">
    <div class="form_div_1">
    <form method="POST" class="form">
        <input type="text" name="user" placeholder="Nom d'utilisateur">
        <br>
        <br>
        <input type="password" name="pass" placeholder="Mot de passe">
        <br>
        <br>
        <input type="submit" value="S'inscrire" name="submit">
    </form>
    <br>
    <a class="button_change" href="/login.php">Déjà un compte?</a>
    </div>
</div>

</html>