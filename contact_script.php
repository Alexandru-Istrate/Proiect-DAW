<?php

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])){
    echo "You have to fill all the fields";
    exit;
}
$recaptchaSecretKey = "6LdwKDUpAAAAAFeyKgjJUwIvxoWneRtmLikkUZ0b";
$recaptchaResponse = $_POST['g-recaptcha-response'];

$verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
$verifyData = [
    'secret' => $recaptchaSecretKey,
    'response' => $recaptchaResponse,
];

$options = [
    'http' => [
        'method' => 'POST',
        'content' => http_build_query($verifyData),
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($verifyUrl, false, $context);
$recaptchaResult = json_decode($response, true);

if ($recaptchaResult['success']) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email_address = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    require_once("class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPSecure = "ssl";
    $mail->Host = 'mail.alexandruistrate.ro';
    $mail->Port = 465;


    $mail->SMTPAuth = true;
    $mail->Username = 'contact@alexandruistrate.ro';
    $mail->Password = '[s5QfMK?ZkL(';

    $mail->setFrom($email_address, $name);
    $mail->addAddress('contact@alexandruistrate.ro', 'DAW Music');
    $mail->AddReplyTo($email_address);

    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;


    if ($mail->send()) {
        echo "Your message has been sent successfully";

    } else {
        echo 'Error: ' . $mail->ErrorInfo;
    }
} else {

    echo "reCAPTCHA verification failed.";
}
