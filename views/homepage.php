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
</head>
<body>
<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        echo '<a href="post.php"> Skapa och redigera inlägg </a>';
    }
    

    $stmt = $pdo->query("SELECT * FROM posts");

    while($row = $stmt->fetch()){
        echo "<p>";
        echo $row['title'] . "<br />" . $row['message'] . "<br />" . "<a href=\"comment.php?id=". $row['id'] . "\">" ."Kommentera". "</a>";
        echo "</p>"; 
    }
    //while satsen skriver ut meddelandena på sidan
   

    if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
        echo '<a href="logout.php">Logga ut </a>';
        die();
    } //om vi är inloggade kommer länk för att logga ut
    
?>
</body>
</html>
