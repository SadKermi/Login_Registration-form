<?php
    include("db_conn.php");

    session_start();
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($name) || empty($surname) || empty($email) || empty($password)) {
            echo "Compila tutti i campi";
        }
        else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $result = false;

            // Per poterli utilizzare in altre pagine
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $name;
            $_SESSION["surname"] = $surname;

            // Nel caso in cui l'email è già stata usata
            try {
                $sql = "INSERT INTO users (name, surname, email, password) VALUES ('$name', '$surname', '$email', '$hash')";
                $result = mysqli_query($connection, $sql);

                // Va nell'altra pagina
                header("Location: pf_page.php");
            }
            catch (mysqli_sql_exception) {
                header("Location: UI/registration.html");
            }
        }
    }
?>