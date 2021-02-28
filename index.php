<?php
    session_start();
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
    <?php
        
        include("database_connection.php");

        //include kopplar till databasen

        echo "<h2>Välkommen till millhouse blogg!</h2>";

        $stm = $pdo->query("SELECT id, username, password FROM users");
        //sql fråga för att hämta info från databas

        echo "<h3>Registrera dig för att kunna logga in:</h3>";

    ?>

    <form method="post" action="views/handleRegister.php">
        <input type="text" placeholder="username" name="username"> <br>
        <input type="password" placeholder="password" name="password"> <br>
        <input type="submit" value="Register">
    </form>
   
</body>
</html> 