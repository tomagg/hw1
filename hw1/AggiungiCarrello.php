<?php
require_once 'database_config.php';
require_once 'auth.php';
    if (!$userid = checkAuth()) {
        exit;
    }

$connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        
        $userid = mysqli_real_escape_string($connessione, $userid);
        $id = mysqli_real_escape_string($connessione, $_POST['id']);
        $img = mysqli_real_escape_string($connessione, $_POST['img']);
        $descrizione = mysqli_real_escape_string($connessione, $_POST['descrizione']);
        $tipologia = mysqli_real_escape_string($connessione, $_POST['tipologia']);
        $prezzo = mysqli_real_escape_string($connessione, $_POST['prezzo']);
        $query="INSERT INTO carrello(id_utente, id_prodotto, content) VALUES('$userid','$id', 
        JSON_OBJECT('id_prodotto', '$id', 'img', '$img', 'descrizione', '$descrizione', 'tipologia', '$tipologia',
         'prezzo', '$prezzo'))";

    if(mysqli_query($connessione, $query) or die(mysqli_error($connessione))) {
    echo json_encode(array('ok' => true));
    exit;
    }

mysqli_close($connessione);
echo json_encode(array('ok' => false))
?>