<?php
session_set_cookie_params(0, '/');
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['role'] == 'administrator') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Page</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
            }
            .content{
                margin-left: 15px;
            }
            input{
                margin-bottom: 10px;
            }


        </style>
    </head>
    <body>
    <?php include("menu.html"); ?>
    <div class="content">
    <h1>Operatii CRUD</h1>
    <form method="post" name="crud" action="crud-handle.php">
        Artist's name  <input type="text" name="name"> <br>
        <input type="submit" name="action" value="Insert">
        <input type="submit" name="action" value="Delete">
    </form>

    </div>
    </body>
    </html>
    <?php
} else {
    header('Location: index.php');
    exit();
}


?>