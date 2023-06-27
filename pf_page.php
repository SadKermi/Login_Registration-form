<?php
    include("db_conn.php");

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="Stylesheet" href="UI/styles/pf_page.css">
</head>
<body>
  <div class="profile">
    <div class="top-elements">
        <img src="UI/Images/pf_pic.jpeg" alt="Profile Picture">
        <h2><?php echo "{$_SESSION["name"]} " . "{$_SESSION["surname"]}" ?></h2>
        <p>Gmail: <?php echo $_SESSION["email"] ?></p>
    </div>
    <div class="bottom-elements">
        <form action="pf_page.php" method="post">
            <input type="submit" name="logout" value="logout" id="logout">
        </form>
  </div>
</body>
</html>

<?php
    if(isset($_POST["logout"])) {
        // Termina la sessione 
        session_destroy();
        // e manda l'utente alla pagina di login
        header("Location: UI/login.html");
    }
?>
