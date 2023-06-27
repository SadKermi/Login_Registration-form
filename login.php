<?php
    include("db_conn.php");

    session_start();
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($email) || empty($password)) {
            echo "Riempi tutti i campi";
        }
        else {
            // Esegui la query per verificare le credenziali nel database
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row["password"];

                // Verifica la password fornita con quella memorizzata nel database
                if(password_verify($password, $hashedPassword)) {
                    // Accesso riuscito, impostare le variabili di sessione e reindirizzare all'area riservata
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["surname"] = $row["surname"];
                    header("Location: pf_page.php");
            } 
            else {
                $error = "Credenziali non valide";
            }
        }
    }
}
    mysqli_close($connection);
?>