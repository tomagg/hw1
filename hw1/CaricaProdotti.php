<?php
require_once 'database_config.php';


$connessione = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['password'],$dbconfig['name']) or die(mysqli_error($connessione));


$query = "SELECT id_prodotto,immagine,descrizione,tipologia,prezzo FROM prodotto" ;

// Esecuzione
$res = mysqli_query($connessione, $query) or die(mysqli_error($connessione));

if (mysqli_num_rows($res) > 0) {
    // Se ci sono risultati, li scorro e riempio l'array che ritornerò al frontend
    while($entry = mysqli_fetch_assoc($res)) {
        $prod[] = array( "id" => $entry["id_prodotto"], 
                            "img" => $entry["immagine"], "descrizione" => $entry["descrizione"], "tipologia" => $entry["tipologia"],
                        "prezzo" => $entry["prezzo"]);
    }
}
mysqli_close($connessione);
echo json_encode($prod);
exit;
?>