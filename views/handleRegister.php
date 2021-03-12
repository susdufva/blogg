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
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Lobster&display=swap" rel="stylesheet">
</head>
<body class="login">

<?php
    
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    $username = $_POST['username'];

    //följande kod kollar efter dubbletter i databasen
    $userSql = "SELECT * FROM users WHERE username=:username_IN";
    $stmt = $pdo->prepare($userSql); 
    $stmt->bindParam(':username_IN', $username);
    $stmt->execute();
    
    if($stmt->rowCount()){ //Om det returneras rader så finns redan användarnamnet
        echo "<div class='start'>";
        echo "<h4>";
        echo "Användarnamnet upptaget <br />";
        echo "</h4>";
        echo '<a class="button" href="../index.php">Tillbaka</a>';
        echo "</div>";
        die();
    }

    

    $password = $_POST['password'];

    $salt = "lo&7äöpetn67^^7337--*)(&¤"; //salt används för att skydda krypteringen, för att försvåra lösenordet/krypteringen ännu mer 
    $password = md5($password.$salt); 

    if(!empty($username)){
        echo "<div class='start'>";
        echo "<h4>";
        echo "Du måste fylla i både användarnamn och lösenord!";
        echo "</h4>";
        echo '<a class="button" href="../index.php">Tillbaka</a>';
        echo "</div>";
        die;
    }

    if(!empty($password)){
        echo "<div class='start'>";
        echo "<h4>";
        echo "Du måste fylla i både användarnamn och lösenord!";
        echo "</h4>";
        echo '<a class="button" href="../index.php">Tillbaka</a>';
        echo "</div>";
        die;
    }
    
    $sql = "INSERT INTO users (username, password) VALUES(:username_IN, :password_IN)";
    //queryn lägger till nya unika användare i databasen 
    $stm = $pdo->prepare($sql); 
    $stm->bindParam(':username_IN', $username);
    $stm->bindParam(':password_IN', $password);
    if($stm->execute()){ //kör sql frågan
        header ("location:login.php");
    } else {
        echo "Något gick fel!";
    }
 
 
?>
</body>
</html>