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
    <link rel='stylesheet'  href='prodotti.css'>
    <script src="prodotti.js" defer="true"></script>
    <title>Prodotti</title>
</head>
<body>
<header>
        <nav>
            <div id='Titolo'>PRODOTTI</div>
            <div id='link'>
                <a href="home.php">HOME</a>
                <a href="Prodotti.php">PRODOTTI</a>
                <a href="recensione.php">RECENSIONI</a>
                <a href="carrello.php">CARRELLO</a>
            </div>
            <a href="logout.php" class="bottone1">LOGOUT</a>
        </nav>
    <div id="lista">
        
    </div>
</header>
</body>
</html>