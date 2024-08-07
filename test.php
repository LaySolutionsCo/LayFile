<?php
$file = "C:\\Users\\sacha\\Pictures\\Screenshots\\6964512.png";
$remote_file = '/img.png';

$ftp_user_name = "guest1";
$ftp_user_pass = "quiche";
$ftp_server = "192.168.1.69";

$ftp = ftp_connect($ftp_server);

$login_result = ftp_login($ftp, $ftp_user_name, $ftp_user_pass);

if (ftp_put($ftp, $remote_file, $file, FTP_BINARY)) {
 echo "Le fichier $file a été chargé avec succès\n";
} else {
 echo "Il y a eu un problème lors du chargement du fichier $file\n";
}

ftp_close($ftp);
?>
