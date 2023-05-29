<?php
require_once 'database_config.php';
//verifico inviati dal form
if(isset($_POST["id"]))
      {
            // Connessione al database
            $connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
            // Aggiungi evento
            $evento = mysqli_real_escape_string($connessione, $_POST["id"]);
            mysqli_query($connessione, "DELETE FROM carrello where codice_acquisto ='".$evento."'");
            // Chiudi connessione
            mysqli_close($connessione);
      }
?>

?>