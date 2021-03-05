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
    <title>Handle Posts</title>
</head>
<body> 

<?php

$title = $_POST['title'];
$message = $_POST['message'];
//$image = $_POST['image'];
$date = $_POST['date'];
$category = $_POST['category'];

$sql = "INSERT INTO posts (title, message, date, category) VALUES(:title_IN, :message_IN, :date_IN, :category_IN)"; 
//name_IN osv byts ut till våra värden från input och sen in i databasen


$stmt = $pdo->prepare($sql); 
$stmt->bindParam(':title_IN', $title);
$stmt->bindParam(':message_IN', $message);
//$stmt->bindParam(':image_IN', $image);
$stmt->bindParam(':date_IN', $date);
$stmt->bindParam(':category_IN', $category);

if($stmt->execute()){
    header ("location:homepage.php");
}

?>

</body>
</html>