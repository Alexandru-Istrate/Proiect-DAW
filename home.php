<?php
session_set_cookie_params(0, '/');
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
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
</head>
<body>
<h1>Bine ai venit in pagina <?php echo $_SESSION['username']; ?> </h1>
<h2>Rolul tau este <?php echo $_SESSION['role'] ?> </h2>
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

?>
<?php if($_SESSION['role'] == 'administrator') { ?>
   <br> <a href="https://alexandruistrate.ro/crud.php">SPRE PAGINA ADMIN</a>

<?php  exit();} ?>

</body>
</html>

<?php
}
else header('Location : index.html');
session_unset();
session_destroy();
mysqli_close($link);
?>

