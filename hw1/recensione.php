<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

  <?php 
    $connessione = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($connessione, $userid);
    $query = "SELECT * FROM utenti WHERE id = $userid";
    $res = mysqli_query($connessione, $query);
    $userinfo = mysqli_fetch_assoc($res);   
  ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet'  href='recensione.css'>
    <script src="recensione.js" defer="true"></script>
    <title>RECENSIONE</title>
</head>
<body>
<header>
        <nav>
            <div id='Titolo'> RECENSIONI</div>
            <div id='link'>
                <a href="home.php">HOME</a>
                <a href="Prodotti.php">PRODOTTI</a>
                <a href="recensione.php">RECENSIONE</a>
                <a href="carrello.php">CARRELLO</a>
            </div>
            <a href="logout.php" class="bottone">LOGOUT</a>
        </nav>  
        <div id="contenuto">
<form action="recensione.php" method="post">
 <span id="tag"><strong>Recensione:</strong></span>
<input type="text" name="recensione" id="recensione"placeholder="Inserisci la recensione" required>
<input type="submit" value="Invia" id="submit">
    </form>
    <div id=lista_recensioni>

    </div>
</div>     
</header>


</body>
</html>