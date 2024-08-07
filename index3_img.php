<?php
$ID = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "bdd1");
$sql = "SELECT nom_fichier FROM id_name WHERE nom_link = '$ID'";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $fileNamebdd = $row['nom_fichier'];
    }
} else {
    header('Location: /error.php');
}

if (!$fileNamebdd) {
    header('Location: /error.php');
}

$place_upload = "D:\\file_upload_lf\\";
$fileMatch_upload = glob($place_upload . $fileNamebdd);

if (!empty($fileMatch_upload)) {
    $file = $fileMatch_upload[0];

        $encryptionKey = '588885';
        $decryptedContent = file_get_contents($file);

        // Déchiffrement avec XOR
        for ($i = 0; $i < strlen($decryptedContent); $i++) {
            $decryptedContent[$i] = $decryptedContent[$i] ^ $encryptionKey[$i % strlen($encryptionKey)];
        }

        // Afficher l'image
        header('Content-Type: image/png');
        echo $decryptedContent;
        exit;
} else {
    $place_upload1 = "D:\\upload\\";
    $fileMatch_upload1 = glob($place_upload1 . $fileNamebdd . ".*");

    if (!empty($fileMatch_upload1)) {
        $file1 = $fileMatch_upload1[0];

            $encryptionKey = '588885';
            $decryptedContent1 = file_get_contents($file1);

            // Déchiffrement avec XOR
            for ($i = 0; $i < strlen($decryptedContent1); $i++) {
                $decryptedContent1[$i] = $decryptedContent1[$i] ^ $encryptionKey[$i % strlen($encryptionKey)];
            }

            // Afficher l'image
            header('Content-Type: image/png');
            echo $decryptedContent1;
            exit;
    } else {
        header('Location: /error.php');
    }
}
?>
<html>

<head>
    <title>Image</title>
</head>
</html>
