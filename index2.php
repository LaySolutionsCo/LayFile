<?php
session_start();
if (@$_SESSION['conn'] == TRUE) {
    $account_button = "account.php";
} else {
    $account_button = "login.php";
}
?>
<html>

<head>
    <title>Lay File - CGU</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.6" />
    <link href="style2.css" rel="stylesheet" />
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
    <h1>Conditions d'utilisations</h1>
</div>
<div class="content">
    <h1>
        1. Acceptation des Conditions d'Utilisation
    </h1>
    <h2>
        En accédant et en utilisant Lay File, vous acceptez pleinement et sans réserve les présentes Conditions d'Utilisation. Si vous n'acceptez pas ces conditions, veuillez cesser d'utiliser le Site immédiatement.
    </h2>
    <h1>
        2. Utilisation Légitime
    </h1>
    <h2>
        Vous vous engagez à utiliser le Site conformément à toutes les lois et réglementations en vigueur. Vous acceptez de ne pas utiliser le Site à des fins illégales, frauduleuses, ou pour la diffusion, le stockage ou le partage de contenu illicite, diffamatoire, obscène, pédopornographique, ou en violation des droits de propriété intellectuelle d'autrui.
    </h2>
    <h1>
        3. Protection des Données
    </h1>
    <h2>
        Bien que nous mettions en place des mesures de sécurité pour protéger vos données, vous comprenez et acceptez que la sécurité des données sur Internet n'est pas garantie. Nous ne pouvons pas être tenus responsables des fuites de données, des accès non autorisés, ou de tout autre incident lié à la sécurité des données.
    </h2>
    <h1>
        4. Exonération de Responsabilité
    </h1>
    <h2>
        Vous utilisez le Site à vos propres risques. Lay File ne peut être tenu responsable des pertes, des dommages ou des conséquences résultant de l'utilisation du Site. En aucun cas Lay File ne peut être tenu responsable de tout dommage spécial, accessoire, indirect, ou consécutif, y compris la perte de données ou de profits, même si nous avons été informés de la possibilité de tels dommages.
    </h2>
    <h1>
        5. Modifications des Conditions d'Utilisation
    </h1>
    <h2>
        Lay File se réserve le droit de modifier les présentes Conditions d'Utilisation à tout moment. Les utilisateurs seront informés de toute modification importante. Votre utilisation continue du Site après de telles modifications constitue votre acceptation des nouvelles conditions.
    </h2>
    <h1>
        6. Droit Applicable
    </h1>
    <h2>
        Les présentes Conditions d'Utilisation sont régies par les lois Françaises. Tout litige découlant de l'utilisation du Site sera soumis à la compétence exclusive des tribunaux de France.
    </h2>
</div>

</html>