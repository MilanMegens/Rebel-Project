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

   Beschrijving: Dit is de overzicht pagina van mijn website
    -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht</title>
    <!--Link naar CSS-->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
<!--Navigatiebalk-->
<?php include "includes/navbar.php";  ?>

<!--Include van de database connect-->
<?php include "includes/database.php"; ?>

<main>
    <!--Activiteiten-->
    <div class="activiteiten">
        <h1>Activiteiten</h1>
        <!--Overzicht van activiteiten-->
        <?php include "overzicht-2.php"?>
    </div>
</main>

<!--Footer-->
<?php include "includes/footer.php";  ?>
</body>
</html>