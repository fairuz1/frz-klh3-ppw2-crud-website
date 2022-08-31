<?php
    $id = $_POST["dataRemove"];
    
    $mysqli = require __DIR__ . "/connection.php";
    $sql = "DELETE FROM data WHERE ID='$id'";
    $data = mysqli_query($mysqli, $sql);
    if ($data) {
        header("Location: index.php");
        exit();
    } else {
        die("An error has occured! Please go back to main page!");
    }
?>