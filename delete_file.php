<?php
$conn = new mysqli("localhost", "root", "", "bdd1");

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

$sql = "SELECT date, nom_fichier, extension FROM id_name WHERE date <= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $nom_fichier = $row['nom_fichier'];

        // Ajouter la condition pour ne supprimer que les fichiers se terminant par "&&&&no"
        if (endsWith($nom_fichier, "&&&&no")) {
            $sql_delete = "DELETE FROM id_name WHERE nom_fichier = '$nom_fichier'";
            $result_delete = mysqli_query($conn, $sql_delete);

            if ($result_delete) {
                echo "$nom_fichier suppr de la bdd";
                echo '<br>';
            } else {
                echo " | Échec de la suppression de l'entrée de base de données : " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "Erreur de requête SELECT : " . mysqli_error($conn);
}

$conn->close();

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    return $length === 0 || (substr($haystack, -$length) === $needle);
}
?>

<html>

<head>
    <meta http-equiv="refresh" content="30">
</head>

</html>
