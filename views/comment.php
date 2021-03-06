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
    <title>Comments</title>
    <link href="../css/post.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
<?php
     
    $stmt = $pdo->prepare("SELECT id, title, message, image FROM posts WHERE id=:id_IN");
    $stmt->bindParam(":id_IN", $_GET['id']);

    $success = $stmt->execute();

    while($message = $stmt->fetch()){
        echo "<p class='left'>";
        echo $message['title'] . "<br/>" . $message['message'] . "<br/>" .'<img class="image" src="'. $message['image'] . '" /> <br/> ';
        echo "</p>";
    }
    
    //koden ovan behövs för att hämta meddelandet jag vill kommentera
?>

<div class='left'>
    <h4>Här kan du kommentera produkten: </h4>
        <form method="post" action="comment.php?action=comment">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <input type="hidden" name="username" value="<?=$_SESSION['username']?>"> </br>
            <input type="text" placeholder="kommentera.." name="comment" required>
            <input class="submit" type="submit" value="Skicka"> 
        </form> 
</div>
    
<?php

    $action = (isset($_GET['action']) ? $_GET['action'] : "");
    
    if(isset($action) && $action == "comment"){
        $sql = "INSERT INTO comments (content, user, postsid) VALUES(:comment_IN, :username_IN, :id_IN)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comment_IN', $_POST['comment']);
        $stmt->bindParam(':username_IN', $_SESSION['username']);
        $stmt->bindParam(':id_IN', $_POST['id']); //kopplar foreign key postsid
    
    if($stmt->execute()) {
        header("location:comment.php?id=".$_POST['id']);
    } 
}

    $comment_stm = $pdo->query("SELECT id, content FROM comments WHERE postsid=".$_GET['id']);

    if(isset($_SESSION['role']) && $_SESSION['role'] == "user") {
        while($row = $comment_stm->fetch()){
            echo "<p class='left'>";
            echo $row['content'] . "<br />" ;
            echo "</p>";
            
        }
    }

    if(isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        while($row = $comment_stm->fetch()){
            echo "<p class='left'>";
            echo $row['content'] . " " . "<a class='comment' href=\"editComments.php?id=". $row['id'] . "\">"  ."Ta bort". "</a>" . "<br />" ;
            echo "</p>";
            
        }
    } //om man är inloggad som admin finns länk för att radera kommentar

?>    
<footer>
    <a class="button" href="homepage.php">Tillbaka</a>
</footer>
</body>
</html>
