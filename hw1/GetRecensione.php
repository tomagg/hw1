<?php
require_once "database_config.php";
require_once "auth.php";
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}
      $connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
      $userid=mysqli_real_escape_string($connessione, $userid);
      $eventi = array();
      $res = mysqli_query($connessione, "SELECT * FROM recensioni");
      while($row = mysqli_fetch_assoc($res))
      {
            $eventi[] = $row;
      }
      mysqli_free_result($res);
      mysqli_close($connessione);
      echo json_encode($eventi);


?>