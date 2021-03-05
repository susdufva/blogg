<?php
    include("../includes/database_connection.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>

    <h1>Blogg</h1>
    <h4>Skapa ett inlägg och recensera en produkt</h4>

<?php

    $stmt = $pdo->query("SELECT * FROM posts");
    //sql fråga för att hämta info från databas

?>

    <form method="post" action="handlePosts.php">
        <input type="text" placeholder="Title" name="title"> <br>
        <textarea placeholder="message.." name="message"></textarea> <br>
        <!--<input type="image" src=" " name="image" alt="Submit">-->
        <span>Kategori:</span> <br>
        <select name="category" id="category">
            <option value="blank"></option>
            <option value="Clothing">Kläder</option>
            <option value="Accessoarer">Accessoarer</option>
            <option value="Inredning">Inredning</option>
        </select> <br>
        <input type="date" id="date" name="date" value=" " 
               min="2021-01-01" max="2021-12-31"> <br>
        <input type="submit" value="Posta">
    </form>

    <?php
     while($row = $stmt->fetch()){
        echo "<p>";
        echo "<a href=\"editPosts.php?id=". $row['id'] . "\">"  ."Ändra / Ta bort". "</a>" . "<br />" . $row['title'] . "<br />" . $row['message'] . "<br />";
        echo "</p>";
        
    }
    //while satsen skriver ut meddelandena på sidan
    
    ?>
    <a href="homepage.php">Tillbaka</a>
</body>
</html> 