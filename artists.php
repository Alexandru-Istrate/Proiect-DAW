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
        }
        .content{
            margin-left: 15px;
        }
    </style>
</head>
<body>

<?php include("menu.html"); ?>
    <div class="content">
<h1>Bine ai venit in pagina <?php  if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> </h1>
<h2>Rolul tau este <?php if(isset($_SESSION['username'])) echo $_SESSION['role']; else echo "guest"; ?> </h2>
<h3>Artists</h3>
<?php
$query = 'SELECT * FROM Artists';
$result = $link->query($query);
if ($result) {


    while ($row = $result->fetch_assoc()) {
        echo $row['name'] . '<br>';

    }
    $result->free();
} else {

    echo 'Query failed: ' . $link->error;
}

exit;
?>

    </div>
</body>
</html>

