<?php
    include("../includes/database_connection.php");
    session_start();

    $action = (isset($_GET['action']) ? $_GET['action'] : "");

    if(isset($action) && $action == "delete"){
        $stm = $pdo->prepare("DELETE FROM comments WHERE id=:id_IN");
        $stm->bindParam("id_IN", $_POST['id']);
        
        if($stm->execute()) {
            header("location:homepage.php");
            } 
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comments</title>
</head>
<body>
    <form method="post" action="editComments.php?action=delete">
        <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <input type="submit" value="Delete">
    </form>
    <a href="homepage.php">Tillbaka</a>
</body>
</html>