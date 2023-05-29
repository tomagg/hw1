<?php
require_once 'database_config.php';
    

if (!isset($_GET["q"])) {
    echo "SEI NEL POSTO SBAGLIATO";
    exit;
}

header('Content-Type: application/json');
$connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$email = mysqli_real_escape_string($connessione, $_GET["q"]);
$query = "SELECT email FROM utenti WHERE email = '$email'";
$res = mysqli_query($connessione, $query) or die(mysqli_error($connessione));
echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));
mysqli_close($connessione);

?>