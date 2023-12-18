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
if(count($_POST)>0) {
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $password = mysqli_real_escape_string($link,$_POST['password']);
    $role = mysqli_real_escape_string($link,$_POST['role']);
    if (empty($username))
        echo 'Introduceti username!';
    else if(empty($password))
        echo "Introduceti parola!";
    else {

        $query = "SELECT * FROM login WHERE username = '$username'";
        $result = $link->query($query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['username'] == $username && password_verify($password,$row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                header("Location: https://alexandruistrate.ro/");
                exit();
            } else echo 'Date de logare incorecte !';
        } else echo 'Date de logare incorecte !';
    }
}
session_unset();
session_destroy();
mysqli_close($link);
?>