<?php
require_once "database_config.php";
require_once "auth.php";

if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}
      header('Content-Type: application/json');

      $connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
      $userid=mysqli_real_escape_string($connessione, $userid);
      $res = mysqli_query($connessione, "SELECT codice_acquisto,id_utente,id_prodotto,content FROM carrello where id_utente=$userid");
      $Array = array();
    while($entry = mysqli_fetch_assoc($res)) {
        // Scorro i risultati ottenuti e creo l'elenco di post
        $Array[] = array('codice_acquisto'=> $entry['codice_acquisto'],'id_utente' => $entry['id_utente'],
                            'id_prodotto' => $entry['id_prodotto'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($Array);
    exit;
    


?>