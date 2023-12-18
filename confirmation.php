<?php
$db_hostname = "localhost";
$db_username = "lightsan_alexandruistrate";
$db_password = "N&sl0dAt.;Z{";
$db_name = "lightsan_proiectphp";
$link = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);

if (!$link) {
    echo "Error: Unable to connect to MySQL.";
    exit;
}

$token = $_GET['token'];
$query = "SELECT * from temporary_users WHERE token = '$token'";
$result = $link->query($query);
if(mysqli_num_rows($result) != 1){
    echo "Something went wrong in the email confirmation process";
    exit();
}
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$username = $row['username'];
$email = $row['email'];
$password = $row['password'];
$role='customer';
$query = "INSERT INTO login(role, username, email, password) VALUES (?, ?, ?, ?)";
$stmt = $link->prepare($query);
$stmt->bind_param("ssss", $role, $username, $email, $password);
$result = $stmt->execute();
if ($result) {
    $query = "DELETE FROM temporary_users WHERE id = ?";
    $del_stmt = $link->prepare($query);
        $del_stmt->bind_param("i",$id);
        $del_stmt->execute();
        echo "Email confirmation was successful";
        $del_stmt->close();
        exit();
}
$stmt->close();
mysqli_close($link);