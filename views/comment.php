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
</head>
<body>
<?php
     
    $stmt = $pdo->prepare("SELECT id, title, message FROM posts WHERE id=:id_IN");
    $stmt->bindParam(":id_IN", $_GET['id']);
 
    $success = $stmt->execute();
 
    if(!$success){
         echo "<h3>Något gick fel</h3>";
         die();
    }
     
    $userData = $stmt->fetch();
    
    //koden ovan behövs för att hämta meddelandet jag vill kommentera
?>
<p>
    <?=$userData['message']?> <!-- skriver ut meddelandet på sidan -->
</p>
<h3>Här kan du kommentera inlägget: </h3>
    <form method="post" action="comment.php?action=comment">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <b><?=$_SESSION['username']?> </b> </br>
        <label for="text">Kommentera: </label>
        <input type="text" name="comment">
        <input type="submit" value="Kommentera">
    </form>
    
<?php

    $action = (isset($_GET['action']) ? $_GET['action'] : "");
    
    if(isset($action) && $action == "comment"){
        $sql = "INSERT INTO comments (content, user, postsid) VALUES(:comment_IN, :user_IN, :id_IN)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comment_IN', $_POST['comment']);
        $stmt->bindParam(':user_IN', $_SESSION['username']);
        $stmt->bindParam(':id_IN', $_POST['id']); //kopplar foreign key postsid
    
    if($stmt->execute()) {
        header("location:comment.php");
    } 
}

    $stm = $pdo->query("SELECT * FROM comments WHERE postsid=".$_GET['id']);

    while($row = $stm->fetch()){
        echo "<p>";
        echo "<a href=\"editPosts.php?id=". $row['id'] . "\">"  .$row['id']. "</a>" . ". " . $row['content'] . "<br />" ;
        echo "</p>";
        
    }
    //if(isset($_SESSION['role']) && $_SESSION['role'] == "user") {
      
   // }

?>    
    <a href="homepage.php">Tillbaka</a>
</body>
</html>
