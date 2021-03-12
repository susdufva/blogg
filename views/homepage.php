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
    <title>Document</title>
    <link href="../css/homepage.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        echo "<div class='logout' >";
        echo '<a class="button" href="post.php"> Skapa och redigera inlägg </a>';
        echo "</div>";
    }
    
    if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
        echo "<div class='logout' >";
        echo '<a class="button" href="logout.php">Logga ut </a>';
        echo "</div>";
    } //om vi är inloggade kommer länk för att logga ut

    $stmt = $pdo->query("SELECT * FROM posts ORDER BY id DESC");

    if(isset($_SESSION['role']) && $_SESSION['role'] == "user") {
        while($row = $stmt->fetch()){
            echo "<div class='field'>";
            echo "<h4>" . $row['title'] . "</h4>" . "<br />" . "<p>" . $row['message'] . "</p>" . "<br />" . '<img class="image" src="'. $row['image'] . '" /> <br/> ' . "<a class='comment' href=\"comment.php?id=". $row['id'] . "\">" ."Kommentera". "</a>";
            echo "</div>"; 
        }
    } 
    //while satsen skriver ut meddelandena på sidan

    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        while($row = $stmt->fetch()){
            echo "<div class='field'>";
            echo "<h4>" . $row['title'] . "</h4>" . "<br />" . "<p>" . $row['message'] . "</p>" . "<br />" . '<img class="image" src="'. $row['image'] . '" /> <br/> ' . "<a class='comment' href=\"comment.php?id=". $row['id'] . "\">" ."Kommentera". "</a>" . "  " .  "<a class='comment' href=\"editPosts.php?id=". $row['id'] . "\">"  ."Ta bort inlägget". "</a>" . "<br />";
            echo "</div>"; 
        }
    }
    //om man är inloggad som admin finns även en knapp för att radera inlägg
   
    
?>
</body>
</html>
