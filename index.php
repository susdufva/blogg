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
</head>
<body>
    <h1>Välkommen till Millhouse blogg!</h1>

    <?php

        $stm = $pdo->query("SELECT id, username, password FROM users");
        //sql fråga för att hämta info från databas

    ?>
    <h3>Registrera dig för att kunna logga in:</h3>

    <form method="post" action="views/handleRegister.php">
        <input type="text" placeholder="username" name="username"> <br>
        <input type="password" placeholder="password" name="password"> <br>
        <input type="submit" value="Registrera">
    </form>
    <h4>Är du redan registrerad, logga in direkt</h4> 
    <form method="post" action="views/login.php">
    <button type="submit">Logga in</button>
</form>
</body>
</html> 