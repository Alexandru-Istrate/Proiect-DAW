<!DOCTYPE html>
<html lang="eng">
<meta charset="UTF-8">
<head>
    <title> Contact </title>
    <style>
        textarea{
            width: 300px;
            height: 200px;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        input{
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 300px;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .contact-form{
            margin-top: 20px;
            margin-left: 20px;
        }


    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<?php include("menu.html"); ?>
<form method="post" action="contact_script.php" id="contact" class="contact-form">
    Your Name <br> <input type="text" name="name"><br>
    Your Email Address <br> <input type="text" name="email"><br>
    Subject <br> <input type="text" name="subject"><br>
    Message <br> <textarea id="message" name="message" placeholder="Enter your message here"></textarea> <br>
    <div class="g-recaptcha" data-sitekey="6LdwKDUpAAAAABM5jok4URIxQKBj6X4YjcjMevAl"></div>
    <input type="submit" value="Send">

</form>
</body>

</html>
