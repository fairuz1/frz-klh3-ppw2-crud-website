<?php
    $nama = $_POST["name"];
    $game = $_POST["game"];
    $alasan = $_POST["reason"];

    $mysqli = require __DIR__ . "/connection.php";
    $sql = "INSERT INTO data(nama, game, alasan) VALUES('$nama', '$game', '$alasan')";
    $data = mysqli_query($mysqli, $sql);
    if ($data) {
        header("Location: index.php");
        exit();
    } else {
        die("An error has occured! Please go back to main page!");
    }
?>