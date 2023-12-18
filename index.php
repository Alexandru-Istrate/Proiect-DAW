<?php
session_set_cookie_params(0, '/');
session_start();

$db_hostname = "localhost";
$db_username = "lightsan_alexandruistrate";
$db_password = "N&sl0dAt.;Z{";
$db_name = "lightsan_proiectphp";
$link = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);

if (!$link) {
    echo "Error: Unable to connect to MySQL.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('dambu.png');
            background-size: cover;
            background-repeat: no-repeat;
        .navbar{
            opacity: 82%;
        }

        }
    </style>
</head>
<body>

<?php include("menu.html"); ?>
<
</body>
</html>

