<?php
require_once 'database_config.php';

    if (!isset($_GET["q"])) {
        echo "SEI NEL POSTO SBAGLIATO";
        exit;
    }

    header('Content-Type: application/json');
    
    $connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($connessione, $_GET["q"]);

    $query = "SELECT username FROM utenti
                WHERE username = '$username'";

    $res = mysqli_query($connessione, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($connessione);
?>