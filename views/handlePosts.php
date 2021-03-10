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
$upload_dir = "../images/"; //här hamnar våra uppladdade filer
$image = $upload_dir . basename($_FILES['image']['name']);
$imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION)); //denna kod kollar vad filen slutar på, ex jpg

if(isset($_POST['submit'])){
    $check = getimagesize($_FILES['image']['tmp_name']); //inbyggd function som kollar om det ens är en bild vi försöker ladda upp
    if($check == false){
        echo "<p>";
        echo "Filen du försöker ladda upp är ingen bild";
        echo "</p>";
        die;
    }
}

if(file_exists($image)){ //file_exists är en inbyggd php funktion som kollar dubletter
    echo "<p>";
    echo "Bilden du har valt är redan uppladdad";
    echo "</p>";
    die;
}

if($_FILES['image']['size'] > 1000000){
    echo "<p>";
    echo "Bilden du försöker ladda upp är för stor";
    echo "</p>";
    die;
}

if($imageType !== "png" && $imageType !== "gif" && $imageType != "jpg" && $imageType != "jpeg") {
    echo "<p>";
    echo "Bilden du försöker ladda upp har fel filformat, använd en bild med png, gif, jpg, eller jpeg";
    echo "</p>";
    die;
}

move_uploaded_file($_FILES['image']['tmp_name'], $image);
//flyttar filen från temp till vald mapp 

$title = $_POST['title'];
$message = $_POST['message'];
$date = $_POST['date'];
$category = $_POST['category'];
//sökvägen till $image finns på rad 18

$sql = "INSERT INTO posts (title, message, image, date, category) VALUES(:title_IN, :message_IN, :image_IN, :date_IN, :category_IN)"; 
//name_IN osv byts ut till våra värden från input och sen in i databasen


$stmt = $pdo->prepare($sql); 
$stmt->bindParam(':title_IN', $title);
$stmt->bindParam(':message_IN', $message);
$stmt->bindParam(':image_IN' ,$image);
$stmt->bindParam(':date_IN', $date);
$stmt->bindParam(':category_IN', $category);

if($stmt->execute()){
    header ("location:homepage.php");
}else {
    echo "<p>";
    echo "Uppladdningen misslyckades, vänligen försök igen";
    echo "</p>";
    die;
}

?>

</body>
</html>