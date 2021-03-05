<?php
    include("../includes/database_connection.php");
    session_start();

    $action = (isset($_GET['action']) ? $_GET['action'] : "");
    
    if(isset($action) && $action == "comment"){
        $sql = "INSERT INTO comments (content, date) VALUES(:comment_IN, :date_IN)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':comment_IN', $_POST['comment']);
        $stmt->bindParam(':date_IN', $_POST['date']);
        
        if($stmt->execute()) {
 
            header("location:comment.php");
        } 
    }
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
     
    $stmt = $pdo->prepare("SELECT id, title, message, category FROM posts WHERE id=:id_IN");
    $stmt->bindParam(":id_IN", $_GET['id']);
 
    $success = $stmt->execute();
 
    if(!$success){
         echo "<h3>Något gick fel</h3>";
         die();
    }
     
    $userData = $stmt->fetch();
?>
<h3>Här kan du kommentera inlägget: </h3>
    <form method="post" action="comment.php?action=comment">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <label for="textarea">Inlägg: </label>
        <input type="text" name="message" id="message" value="<?=$userData['message']?>" /> <br>
        <label for="text">Kommentera: </label>
        <input type="text" name="comment"> <br>
        <input type="date" id="date" name="date" value=" " 
               min="2021-01-01" max="2021-12-31"> <br>
        <input type="submit" value="Kommentera">
    </form>
    <a href="homepage.php">Tillbaka</a>
<?php

    $stm = $pdo->query("SELECT * FROM comments");

    while($row = $stm->fetch()){
        echo "<p>";
        echo "<a href=\"editPosts.php?id=". $row['id'] . "\">"  .$row['id']. "</a>" . "<br />" . $row['content'] . "<br />" ;
        echo "</p>";
        
    }
    if(isset($_SESSION['role']) && $_SESSION['role'] == "user") {
      
    }

?>    
</body>
</html>
