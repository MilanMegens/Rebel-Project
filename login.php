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

   Beschrijving: Dit is de inlog pagina van mijn website
    -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!--Link naar CSS-->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
        <!--Navigatiebalk-->
        <?php include "includes/navbar.php";  ?>

        <!--Login formulier-->
        <div class="login-container">
            <h1>Inloggen</h1>
            <form action="login-2.php" method="post">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" placeholder="Gebruikersnaam...." required>
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" placeholder="Wachtwoord...." required>
                <input type="submit" value="Verder">
            </form>
            <div class="register-link">
                <a href="registreer.php">Geen account? <span class="onderlijn">Registreer</span></a>
            </div>
        </div>


        <!--Footer-->
        <?php include "includes/footer.php";  ?>
</body>
</html>