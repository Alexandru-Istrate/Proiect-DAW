<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'administrator') {
    $db_hostname = "localhost";
    $db_username = "lightsan_alexandruistrate";
    $db_password = "N&sl0dAt.;Z{";
    $db_name = "lightsan_proiectphp";
    $link = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
    if (!$link) {
        echo "Error: Unable to connect to MySQL.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST["action"];

        if ($action == "Insert") {

            $name = $_POST["name"];
            $query = "INSERT INTO Artists(name) VALUES ('$name')";

            if (mysqli_query($link, $query)) {
                echo "Insert operation successful!";
            } else {
                echo "Error inserting record: " . mysqli_error($link);
            }

        } elseif ($action == "Delete") {

            $name = mysqli_real_escape_string($link, $_POST["name"]);  // Escape to prevent SQL injection
            $query = "DELETE FROM Artists WHERE name = '$name'";

            if (mysqli_query($link, $query)) {
                echo "Delete operation successful!";
            } else {
                echo "Error deleting record: " . mysqli_error($link);
            }
        }
    }
}
else {
    header('Location : index.php');
}
mysqli_close($link);
?>
