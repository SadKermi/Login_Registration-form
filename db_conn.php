<?php
    // Ci sono due modi per connettersi al database
    // 1. mysqli, questo è senza oggetti
    // 2. PDO (PHP Data Objects), questo è con oggetti
    
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "mydb";

    // Connessione al database
    // try-catch è un metodo per gestire gli errori/eccezzioni in PHP
    try {
        $connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    } 
    catch(mysqli_sql_exception) {
        echo "Errore di connessione al database";
    }
?>