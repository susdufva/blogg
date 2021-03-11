<?php
    include("../includes/database_connection.php");
    session_start();
    
    $action = (isset($_GET['action']) ? $_GET['action'] : "");
    //som en if sats fast enklare kod
    
    if(isset($action) && $action == "update"){
        $sql = "UPDATE posts SET title=:title_IN, message=:message_IN, category=:category_IN WHERE id=:id_IN";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title_IN', $_POST['title']);
        $stmt->bindParam(':message_IN', $_POST['message']);
        //$stmt->bindParam(':image_IN', $_POST['image']); kom ihåg image i sql frågan sen
        $stmt->bindParam(':category_IN', $_POST['category']);
        $stmt->bindParam("id_IN", $_POST['id']);
        //hoppar över datum så man inte kan ändra när det skapades
        
        if($stmt->execute()) {
 
            header("location:post.php");
            } 
    }
    if(isset($action) && $action == "delete"){
        $stm = $pdo->prepare("DELETE FROM posts WHERE id=:id_IN");
        $stm->bindParam("id_IN", $_POST['id']);
        
        if($stm->execute()) {
 
            header("location:post.php");
            } 
        
    }

?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Posts</title>   
    <link href="../css/post.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Lobster&display=swap" rel="stylesheet">
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
<header>
<div class="blogg">
    <h3>Här kan du göra ändringar i ditt inlägg: </h3>
    <form method="post" action="editPosts.php?action=update">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?=$userData['title']?>" /><br> 
        <label for="textarea">Text: </label>
        <input type="text" name="message" id="message" value="<?=$userData['message']?>" /> <br>
        <!--<input type="image" src=" " name="image" alt="Submit"> -->
        <select name="category" id="category" value="<?=$userData['category']?>">
            <option value="blank"></option>
            <option value="Clothing">Kläder</option>
            <option value="Accessoarer">Accessoarer</option>
            <option value="Inredning">Inredning</option>
        </select> <br>
        <input class="submit" type="submit" value="Uppdatera">
    </form>

    <form method="post" action="editPosts.php?action=delete">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <input class="submit" type="submit" value="Delete">
    </form>
</div>
</header>
<footer>
    <a class="button" href="homepage.php">Tillbaka</a>
</footer>
</body>
</html>