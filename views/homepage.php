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
    $stmt = $pdo->query("SELECT * FROM posts");

    while($row = $stmt->fetch()){
        echo "<p>";
        echo "<a href=\"editPosts.php?id=". $row['id'] . "\">" . $row['id'] . "</a>" . ". " . "<br />" . $row['title'] . "<br />" . $row['message'] . "<br />";
        echo "</p>";
        
    }
    //while satsen skriver ut meddelandena på sidan
    
?>
</body>
</html>
