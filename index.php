<?php
session_start();

if(isset($_SESSION['id']) && empty($_SESSION['id']) == false){
    echo "Area Restrita...";
}
else{
    header("Location: login.php");
}

?>