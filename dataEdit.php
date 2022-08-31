<?php
    $nama = $_POST["changeName"];
    $game = $_POST["changeGame"];
    $alasan = $_POST["changeReason"];
    $id = $_POST["dataChange"];
    
    $mysqli = require __DIR__ . "/connection.php";
    $sql = "UPDATE data SET Nama='$nama', Game='$game', Alasan='$alasan' WHERE ID='$id'";
    $data = mysqli_query($mysqli, $sql);
    if ($data) {
        header("Location: index.php");
        exit;
    } else {
        die("An error has occured! Please go back to main page!");
    }
?>