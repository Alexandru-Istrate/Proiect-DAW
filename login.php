<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            text-align: center;
            width: 300px;
        }

        input {
            margin-bottom: 10px;
        }

        .register_button{
            position: absolute;
            top: 417px;
            left: 47.7%;
        }


    </style>
</head>
<body>
<form method="post" action="login_script.php" id="Auth">
    <label for="username">Username</label>
    <br>
    <input type="text" name="username" id="username">
    <br>

    <label for="password">Password</label>
    <br>
    <input type="password" name="password" id="password">
    <br>

    <input type="submit" value="Login">
</form>
<a href="register.php" ><button class="register_button"> Register </button> </a>
</body>
</html>
