<?php
    include("../includes/database_connection.php");
    session_start();

    $comment_stm = $pdo->query("SELECT id, content FROM comments");

    while($row = $comment_stm->fetch()){
        echo "<p>";
        echo "<a href=\"editComments.php?id=". $row['id'] . "\">"  .$row['id']. "</a>" . ". " . $row['content'] . "<br />" ;
        echo "</p>";
        
    }
?>