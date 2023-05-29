<?php
    
    require_once 'database_config.php';
    session_start();

    function checkAuth() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['hw_id']))
         {
            return $_SESSION['hw_id'];
        } else 
            return 0;
    }
?>