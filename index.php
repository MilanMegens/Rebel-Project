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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rebel Food & Bar</title>
    <!-- Link naar het CSS bestand -->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
<!-- Navigatiebalk -->
<?php include "includes/navbar.php"; ?>

<main>
    <!-- Begin hoofdtekst -->
    <div class="maintekst">
        <h1 class="rebel">Rebel Food & Bar!</h1>
        <div class="lijntje">
            <hr>
        </div>
        <h2>Komende Activiteiten</h2>
    </div>

    <!-- Sectie voor activiteiten -->
    <div class="activiteiten">
        <?php
        // Include database
        include "includes/database.php";
        // Start de database verbinding
        startConnection();

        try {
            // Query om de eerste 3 activiteiten op te halen
            $query = "SELECT TOP 3 * FROM Diner ORDER BY Start";
            // Voorbereiden van de query
            $stmt = $pdo->prepare($query);
            // Uitvoeren van de query
            $stmt->execute();
            // Resultaten opslaan in een variabele
            $result = $stmt;

            // Weergave van de resultaten in een tabel
            echo "<table>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<th>Activiteit:</th>";
                echo "<td>" . htmlspecialchars($row["Description"]) . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Start:</th>";
                echo "<td>" . htmlspecialchars($row["Start"]) . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Eind:</th>";
                echo "<td>" . htmlspecialchars($row["End"]) . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Locatie:</th>";
                echo "<td>" . htmlspecialchars($row["Location"]) . "</td>";
                echo "</tr>";
                // Ruimte tussen activiteiten
                echo "<tr class='space'><td colspan='2'></td></tr>";
            }
            echo "</table>";
        } catch (PDOException $e) {
            // Foutmelding in geval van een database fout
            echo "Fout: " . $e->getMessage();
        }
        ?>
    </div>
</main>

<!-- Footer -->
<?php include "includes/footer.php"; ?>
</body>
</html>

