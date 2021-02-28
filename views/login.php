<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
</head>
<body>
    <form method="post" action="handleLogin.php?action=login">
        <input type="text" placeholder ="username" name="username" id="username" > <br> 
        <input type="password" placeholder="password" name="password" id="password" > <br>
        <input type="submit" name="login" value="Logga in">
    </form> 

    <?php
        $dsn = "mysql:host=localhost;dbname=blogg";
        $user = "root";
        $password = "";
 
        $pdo = new PDO($dsn, $user, $password); 


  
        $action = (isset($_GET['action']) ? $_GET['action'] : "");

        if(isset($action) && $action == "login"){
      
            $sql = "SELECT id, username, password FROM users WHERE username=:username_IN AND password=:password_IN"; 
            $stm = $pdo->prepare($sql);
            $stm->bindParam(":username_IN", $_POST['username']);
            $stm->bindParam(":password_IN", $_POST['password']); 
            $stm->execute();
            $return = $stm->fetch();

            if($return[0] > 0) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];

                echo "<h1>Välkommen ". $_SESSION['username'] ."</h1>";
            }
           
        }
        
        if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
            echo '<a href="logout.php">Logga ut </a>';
            die();
        }
        

    ?>
    
   
  
</body>
</html>