<?php
require_once 'auth.php';

if(checkAuth())
{
    header("Location: home.php");
    exit;
}
//verifico i dati inviati dal post
if (!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) 
&& !empty($_POST["username"]))
{
//creo un array per salvare gli errori
$error= array();
 //creo la connessione al server
 $connessione=mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['password'],$dbconfig['name']);
 
 #Username
 if(!preg_match('/^[a-zA-Z0-9_]{5,15}$/',$_POST['username']))
 {
    $error[]="Username non valido";
 }else
 {
    $username= mysqli_real_escape_string($connessione,$_POST['username']);
    $query="SELECT username FROM utenti WHERE username = '$username'";
    $res = mysqli_query($connessione, $query);
    if (mysqli_num_rows($res) > 0) 
   {
     $error[] = "Username già utilizzato";
   }
 }
 # Nome
 if (strlen($_POST["nome"]) == 0) 
 {
    $error[] = "Caratteri Nome insufficienti";
 } 
 # Password
 if (strlen($_POST["cognome"]) == 0) 
 {
    $error[] = "Caratteri cognome insufficienti";
 } 
 # Password
 if (strlen($_POST["pass"]) < 8) 
 {
    $error[] = "Caratteri password insufficienti";
 } 
# Email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error[] = "Email non valida";
} else {
    $email = mysqli_real_escape_string($connessione, strtolower($_POST['email']));
    $res = mysqli_query($connessione, "SELECT email FROM utenti WHERE email = '$email'");
    if (mysqli_num_rows($res) > 0) {
        $error[] = "Email già utilizzata";
    }
}
 
//utilizzato per evitare i problemi di injection
if(count($error)==0)
{
$nome=mysqli_real_escape_string($connessione,$_POST['nome']);
$username=mysqli_real_escape_string($connessione,$_POST['username']);  
$cognome=mysqli_real_escape_string($connessione,$_POST['cognome']);
$Email=mysqli_real_escape_string($connessione,$_POST['email']);
$password=mysqli_real_escape_string($connessione,$_POST['pass']);
$password=password_hash($password,PASSWORD_BCRYPT);
//prepariamo la query
$query="INSERT INTO utenti (username,password,email,nome,cognome) VALUES ('$username','$password','$Email','$nome','$cognome')";
//$res=mysqli_query($connessione,$query);
if (mysqli_query($connessione, $query)) 
{
    $_SESSION["hw_username"] = $_POST["username"];
    $_SESSION["hw_id"] = mysqli_insert_id($connessione);
    mysqli_close($connessione);
    header("Location: login.php");
    exit;
}
else
{
 $error[] = "errore di connessione al database";
}
}
mysqli_close($connessione);
}
else if(isset($_POST["username"]))
{
    $error= array("RIEMPI TUTTI I CAMPI");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet'  href='registrazione.css'>
    <script src="registrazione.js" defer="true"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">  
</head>
<body>
<div class="login-content">
<div class="form">
    <h2><em>REGISTRATI</em></h2>
    <form action="registrazione.php" method="POST">
        <div class="inputBox" id="nameBox">
            <span id="tag"><strong>Nome:</strong></span>
            <input type="text" name="nome"<?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?> 
             id="nome"placeholder="Inserisci il nome" required>
            <span class='error'>Nome non valido</span>
        </div>
        <div class="inputBox" id="surnameBox">
            <span id="tag"><strong>Cognome:</strong></span>
            <input type="text" name="cognome"<?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>
             id="cognome"placeholder="Inserisci il cognome" required>
            <span class='error'>Cognome non valido</span>
        </div>
        <div class="inputBox" id="emailBox">
            <span id="tag"><strong>Email:</strong></span>
            <input type="text" name="email"<?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?> 
            id="email"placeholder="Inserisci l'email" required>
            <span class='error'>Email non valida</span>
        </div>
        <div class="inputBox" id="userBox">
            <span id="tag"><strong>Username:</strong></span>
            <input type="text" name="username"<?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?> 
            id="username"placeholder="Inserisci l'username" required>
            <span class='error'>Username non valido</span>
        </div>
        <div class="inputBox" id="passBox">
            <span id="tag"><strong>Password:</strong></span>
            <input type="password" name="pass"<?php if(isset($_POST["pass"])){echo "value=".$_POST["pass"];} ?>
             id="pass"placeholder="Inserisci la password" required>
            <span class='error'>Password non valida</span>
        </div>
        <?php if(isset($error)) 
        {
          foreach($error as $err)
         {
              echo "<div class='errorj'><span>".$err."</span></div>";
         }
         } 
                ?>
        <div class="inputBox">
            <input type="submit" value="Registrati" id="submit">
        </div>
        <div class="inputBox">
            <p>possiedi gia un Account su G-SHOP? <a href="login.php">Accedi!</p>
        </div>
    </form>
</div>
</div>
</body>
</html>