<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bdd1");
if (@$_SESSION['conn'] == TRUE) {
    header('Location: /account.php');
} else {
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pass = sha1($_POST['pass']);
        $post = $_POST['submit'];

        $sql =  "SELECT * FROM bdd_user WHERE user = ? and mdp = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        foreach ($result as $row) {
            $id_rand = $row['id_rand'];
        }

        if ($result->num_rows > 0) {
            $_SESSION['conn'] = TRUE;
            $_SESSION['user'] = $user;
            $_SESSION['id_rand'] = $id_rand;

            header('Location: /account.php');
            exit();
        } else {
            $_SESSION['conn'] = FALSE;
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}
?>
<html>

<head>
    <title>Lay File - Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.8" />
    <link href="style_conn.css" rel="stylesheet"/>
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
        <input type="submit" value="Se connecter" name="submit">
    </form>
    <br>
    <a class="button_change" href="/signin.php">Pas encore de compte?</a>
    </div>
</div>
</html>