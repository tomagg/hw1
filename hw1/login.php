<?php
include 'auth.php';

if(checkAuth())
{
    header("Location: home.php");
    exit;
}

//verifico i dati inseriti da post
if (!empty($_POST["username"]) && !empty($_POST["pass"]))
{
//creo la connessione
$connessione=mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['password'],$dbconfig['name']);   
// prendo i dati
$username=mysqli_real_escape_string($connessione,$_POST['username']);
$password=mysqli_real_escape_string($connessione,$_POST['pass']);
//creo la query
$query="SELECT* FROM utenti WHERE username ='".$username."'";

$res=mysqli_query($connessione,$query);
if(mysqli_num_rows($res)>0)
{
    $entry = mysqli_fetch_assoc($res);
     //Questa funzione serve a comparare la passqord immessa con quella hashata.
    if (password_verify($password, $entry['password']))
    {
    // Imposto una sessione dell'utente
    $_SESSION["hw_username"] = $entry['username'];
    $_SESSION["hw_id"] = $entry['id'];

    header("Location: home.php");
    mysqli_free_result($res);
    mysqli_close($conn);
    exit;
    }
}
$error = "Username e/o password errati.";
}
else if (isset($_POST["username"]) || isset($_POST["pass"])) 
{
    $error = "Inserisci username e password.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='login.css'>
    <script src="login.js" defer="true"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">  
</head>
<body>
<div class="login-content">
<div class="form">
    <h2><em>ACCEDI</em></h2>
    <?php
    
        if (isset($error)) 
     {
          echo "<p class='error'>$error</p>";
     }
                
            ?>
    <form action="login.php" method="POST">
        <div class="inputBox" id="userBox">
            <span id="tag"><strong>Username:</strong></span>
            <input type="text" name="username" id="username"<?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>         
            placeholder="Inserisci l'username" required>
            <span class='error'>Username non valido</span>
        </div>
        <div class="inputBox" id="passBox">
            <span id="tag"><strong>Password:</strong></span>
            <input type="password" name="pass"<?php if(isset($_POST["pass"])){echo "value=".$_POST["pass"];} ?>
             id="pass"placeholder="Inserisci la password" required>
            <span class='error'>Password non valida</span>
        </div>
        <div class="inputBox">
            <input type="submit" value="Accedi" id="submit">
        </div>
        <div class="inputBox">
            <p>Non possiedi un Account su G-SHOP? <a href="registrazione.php">Registrati!</p>
        </div>
    </form>
</div>
</div>
</body>
</html>