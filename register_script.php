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
if(count($_POST)>0) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $re_password = mysqli_real_escape_string($link, $_POST['re-password']);
    $role = "customer";
    if (empty($username) || empty($email) || empty($password) || empty($re_password)) {
        echo "Please fill all the fields";
        exit();
    }
        if ($password != $re_password){
            echo "Passwords don't match";
        exit();
    }

    $query = "SELECT * FROM login WHERE username='$username'";
    $result = $link->query($query);
    if (mysqli_num_rows($result) > 0) {
        echo "Username already registered";
        exit();
    }
    $query = "SELECT * FROM login WHERE email='$email'";
    $result = $link->query($query);
    if (mysqli_num_rows($result) > 0) {
        echo "Email already registered";
        exit();
    }

        $query = "INSERT INTO temporary_users(role, username, email, password,token) VALUES (?, ?, ?, ?,?)";
        $stmt = $link->prepare($query);
        $tokenBytes = random_bytes(32);
        $token = bin2hex($tokenBytes);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sssss", $role, $username, $email, $hashedPassword,$token);
        $result = $stmt->execute();
        if ($result) {
            require_once("class.phpmailer.php");
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPSecure = "ssl";
            $mail->Host = 'mail.alexandruistrate.ro';
            $mail->Port = 465;


            $mail->SMTPAuth = true;
            $mail->Username = 'verification@alexandruistrate.ro';
            $mail->Password = 'jm^}FeB2iKCh';

            $mail->setFrom('verification@alexandruistrate.ro', 'DAW Music');
            $mail->addAddress($email, $username);

            $mail->IsHTML(true);
            $mail->Subject = 'DAW Registration confirmation link';
            $mail->Body = 'Click on the following link to verify your email address : <br> https://alexandruistrate.ro/confirmation.php?token='.$token;


            if ($mail->send()) {
                echo "Confirmation email has been sent to the address ".$email;

            } else {
                echo 'Error: ' . $mail->ErrorInfo;
            }

        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

}
mysqli_close($link);
?>