<?php
require_once 'database_config.php';
require_once 'auth.php';
    if (!$userid = checkAuth()) {
        exit;
    }
//verifico i dati inseriti da post
if(isset($_POST["recensione"]))
      {
            // Connessione al database
            $connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
            $userid=mysqli_real_escape_string($connessione, $userid);
            // Aggiungi evento
            $recensione = mysqli_real_escape_string($connessione, $_POST["recensione"]);
            mysqli_query($connessione, "INSERT INTO recensioni(id_utente,descrizione) VALUES( \"$userid\",\"$recensione\")");
            // Chiudi connessione
            mysqli_close($connessione);
      }
?>