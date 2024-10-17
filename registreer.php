<!--
███╗░░░███╗██╗██╗░░░░░░█████╗░███╗░░██╗░█████╗░░██████╗░██████╗
████╗░████║██║██║░░░░░██╔══██╗████╗░██║██╔══██╗██╔════╝██╔════╝
██╔████╔██║██║██║░░░░░███████║██╔██╗██║██║░░██║╚█████╗░╚█████╗░
██║╚██╔╝██║██║██║░░░░░██╔══██║██║╚████║██║░░██║░╚═══██╗░╚═══██╗
██║░╚═╝░██║██║███████╗██║░░██║██║░╚███║╚█████╔╝██████╔╝██████╔╝
╚═╝░░░░░╚═╝╚═╝╚══════╝╚═╝░░╚═╝╚═╝░░╚══╝░╚════╝░╚═════╝░╚═════╝░
-->
<html>
<head>
    <!--
    Auteur: Milan Megens

   Beschrijving: Dit is de registreer pagina van mijn website
    -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreren</title>
    <!--Link naar CSS-->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
<!--Navigatiebalk-->
<?php include "includes/navbar.php";  ?>

<!--Php voor het registreren-->
<?php include("registreer-2.php") ?>

<main>
    <!--Registreer formulier-->
    <div class="login-container">
        <h1>Registreren</h1>
        <form action="registreer-2.php" method="post">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" placeholder="Gebruikersnaam...." required>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" placeholder="Wachtwoord...." required>
            <input type="submit" value="Verder">
        </form>
        <div class="register-link">
            <a href="login.php">Al een account? <span class="onderlijn">Log in</span></a>
        </div>
    </div>
</main>


<!--Footer-->
<?php include "includes/footer.php";  ?>
</body>
</html>