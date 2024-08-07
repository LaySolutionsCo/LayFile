<?php
$ID = $_GET['id'];
$link_img = 'http://lay-file.laysolutions.fr/index3_img.php?id=' . $ID;

$conn = new mysqli("localhost", "root", "", "bdd1");
$sql = "SELECT nom_fichier, nom_fichier_original FROM id_name WHERE nom_link = '$ID'";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $fileNamebdd = $row['nom_fichier'];
        $nom_fichier_original = $row['nom_fichier_original'];
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
    $fileName = basename($file);

    if (isset($_POST['submit'])) {
        $fileContent = file_get_contents($file);
        $encryptionKey = '588885';
        $decryptedContent = '';

        for ($i = 0; $i < strlen($fileContent); $i++) {
            $decryptedContent .= $fileContent[$i] ^ $encryptionKey[$i % strlen($encryptionKey)];
        }

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nom_fichier_original . '"');
        header('Content-Length: ' . strlen($decryptedContent));
        echo $decryptedContent;
        exit;
    }

    } else {
        header('Location: /error.php');
    }
?>
<html>

<head>
    <title>Lay File - Mon fichier</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.6" />
    <link href="style3.css" rel="stylesheet" />
</head>
<div class="title">
    <a href="/index.php" class="btn_pub">
        Découvrez Lay File
    </a>
    <h1>Téléchargez votre fichier.</h1>
</div>
<br>
<br>
<div class="content">
    <div class="content2">
        <img src="document.png" width="50px">
        <h2>
            <?php
            echo $nom_fichier_original;
            if (!$nom_fichier_original) {
                echo "Sans nom";
            }
            ?>
        </h2>
    </div>
    <form method="POST">
        <input type="submit" value="Télécharger" name="submit">
        <a class="link_img" href="<?php echo $link_img; ?>">
        <h2>Lien de l'image</h2>
        </a>
    </form>
</div>

</html>