<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hanlde registration</title>
</head>
<body>

<?php
    $dsn = "mysql:host=localhost;dbname=blogg";
    $user = "root";
    $password = "";
    
    $pdo = new PDO($dsn, $user, $password); 
    
    //koden ovan kopplar till databas
    
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    $username = $_POST['username'];
    $userPassword = $_POST['password'];
    
    $sql = "INSERT INTO users (username, password) VALUES(:username_IN, :password_IN)";
    
    $stm = $pdo->prepare($sql); //säger åt pdo att förbereda queryn 
    //ersätter IN i vår query med värdet på $username
    $stm->bindParam(':username_IN', $username);
    $stm->bindParam(':password_IN', $userPassword);
    if($stm->execute()){ //kör sql frågan
        header ("location:login.php");
    } else {
        echo "Något gick fel!";
    }
 
 
?>
</body>
</html>