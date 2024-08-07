<h1><p align="center">
<?php

    $serv="localhost:3306";
    $user="root";
    $pass="";
    $db="reg_snti";

    $conn = new mysqli($serv,$user,$pass,$db);
    if($conn){
        //echo "Database Connected";
    }

    
  
?>