<?php
    session_start();
    include("../includes/database_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Lobster&display=swap" rel="stylesheet">
</head>
<body class="login">
    <div class="start">
    <form method="post" action="login.php?action=login">
        <input type="text" placeholder ="username" name="username" id="username" > <br> 
        <input type="password" placeholder="password" name="password" id="password" required> <br>
        <input class="button" type="submit" name="login" value="Logga in">
    </form> 
    <?php
 
    $action = (isset($_GET['action']) ? $_GET['action'] : "");

    if(isset($action) && $action == "login"){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
     
        $username = $_POST['username'];
        $userPassword = $_POST['password'];

        $salt = "lo&7äöpetn67^^7337--*)(&¤";
        $userPassword = md5($userPassword.$salt); //för att logga in och hitta det krypterade lösenordet från databasen
      
        $sql = "SELECT id, username, password, role FROM users WHERE username=:username_IN AND password=:password_IN"; 
        $stm = $pdo->prepare($sql);
        $stm->bindParam(":username_IN", $username); //$_POST['username']
        $stm->bindParam(":password_IN", $userPassword); //$_POST['password']
        $stm->execute();
        $return = $stm->fetch();

        if($return) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $userPassword;
            $_SESSION['role'] = $return['role'];

            header("location:homepage.php");
        }else {
            echo "<h4>";
            echo "Fel användarnamn eller lösenord!";
            echo "</h4>";
        }
           
    }       
?>
    </div>



</body>
</html>