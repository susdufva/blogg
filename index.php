<?php
    session_start();
    include("includes/database_connection.php");
    //include kopplar till databasen
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Välkommen</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Lobster&display=swap" rel="stylesheet">
</head>
<body class="index">
    <header>
        <h1>Millhouse</h1>
        <img class="divider" src="images/divider2.jpg" alt="divider">
    </header>
    <div class="decor">
            <h4 class="decor">Kläder </h4>
            <span class="dot"></span>
            <h4 class="decor">Accessoarer </h4>
            <span class="dot"></span>
            <h4 class="decor">Inredning </h4>
        </div>
    <?php

        $stm = $pdo->query("SELECT id, username, password, role FROM users");
        //sql fråga för att hämta info från databas

    ?>
    <div class="start">
    <h4>Registrera dig för att kunna logga in:</h4>

    <form method="post" action="views/handleRegister.php">
        <input type="text" placeholder="Användarnamn" name="username" required> <br>
        <input type="password" placeholder="Lösenord" name="password" required> <br>
        <input class="button" type="submit" value="Registrera">
    </form>
    <h4>Är du redan registrerad, logga in direkt</h4> 
    <form method="post" action="views/login.php">
    <button class="button" type="submit">Logga in</button>
    </form>
    </div>
</body>
</html> 