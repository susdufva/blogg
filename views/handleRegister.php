<?php 
    //set_include_path('/susannanoah_blogg/includes');
    include("../includes/database_connection.php");
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
    
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    $username = $_POST['username'];
    $userPassword = $_POST['password'];

    $salt = "lo&7äöpetn67^^7337--*)(&¤"; //salt används för att skydda krypteringen, för att försvåra lösenordet/krypteringen ännu mer 
    $userPassword = md5($userPassword.$salt); //
    
    $sql = "INSERT INTO users (username, password) VALUES(:username_IN, :password_IN)";
    
    $stm = $pdo->prepare($sql); 
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