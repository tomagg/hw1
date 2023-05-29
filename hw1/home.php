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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HW1</title>
    <link rel='stylesheet'  href='home.css'>
    <script src="home.js" defer="true"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div id='Titolo'>GSHOP</div>
            <div id='link'>
                <a href="home.php">HOME</a>
                <a href="Prodotti.php">PRODOTTI</a>
                <a href="recensione.php">RECENSIONE</a>
                <a href="carrello.php">CARRELLO</a>
            </div>
            <a href="logout.php" class="bottone">LOGOUT</a>
            <div id="mobile">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </nav>
        <h1>LO SHOP CHE TUTTI I GAMER ASPETTAVANO DA TEMPO</h1>
        <h3>TUTTI I GIOCHI CHE CERCATE,OLD GEN NEXT GEN LI TROVERETE DA NOI</h3>
    </header>
    <section>
        <div id="Menu">
        <h1>DA NOI PUOI ACQUISTARE:</h1>
            <div id="flexbox">
                <div id='blocco1'>
                    <img src="videogame.jpeg">
                    <h2>VIDEOGIOCHI</h2>
                    <a href="videogame.php" class="bottone">ACQUISTA</a>
                </div>
                <div id="blocco2">
                    <img src="Console.jpeg">
                    <h2>CONSOLE</h2>
                    <a href="console.php" class="bottone">ACQUISTA</a>
                </div>
            </div>
        </div>
    </section>
    <footer>
 <h1>
    Tomaselli Giovanni </br>
    matricola:1000003857
</h1>
    
</footer>
</body>
</html>