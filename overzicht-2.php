<?php
// Database include
include "includes/database.php";
startConnection(); //Connectie starten

// Debuggingfunctie om berichten te loggen
function log_message($message) {
    error_log($message, 3, 'debug.log');
}

// Controleren of het formulier is ingediend om wijzigingen op te slaan na het bewerken
if (isset($_POST['saveChanges'])) {
    $dinerID = $_POST['DinerID'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $location = $_POST['location'];

    // Omzetten van het datetime-local-formaat naar SQL Server datetime-formaat
    $start = date("Y-m-d H:i:s", strtotime($start));
    $end = date("Y-m-d H:i:s", strtotime($end));

    // Bijwerken van de record in de database
    try {
        $query = "UPDATE Diner SET Description = :description, Start = :start, [End] = :end, Location = :location WHERE DinerID = :dinerID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':dinerID', $dinerID);
        $stmt->execute();
        log_message("Update succesvol.\n");
    } catch (PDOException $e) {
        log_message("Fout: " . $e->getMessage() . "\n");
        echo "Fout: " . $e->getMessage();
    }
}

// Ophalen van de zoekparameters
$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
$searchLocation = isset($_GET['searchLocation']) ? $_GET['searchLocation'] : '';

// Opbouwen van de query met zoekparameters
$query = "SELECT * FROM Diner WHERE Description LIKE :searchName AND Location LIKE :searchLocation ORDER BY Start";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':searchName', '%' . $searchName . '%');
$stmt->bindValue(':searchLocation', '%' . $searchLocation . '%');
$stmt->execute();
$result = $stmt;

// Formulier voor het toevoegen van een nieuwe activiteit
echo "<div class='toevoeg'>";
echo "<form method='post' action='addDiner.php'>";
echo "<h1>Een activiteit toevoegen</h1>";
echo "<label for='description'>Activiteit:</label><br>";
echo "<input type='text' id='description' name='description' required><br>";
echo "<label for='start'>Start:</label><br>";
echo "<input type='datetime-local' id='start' name='start' required><br>";
echo "<label for='end'>Eind:</label><br>";
echo "<input type='datetime-local' id='end' name='end' required><br>";
echo "<label for='location'>Locatie:</label><br>";
echo "<input type='text' id='location' name='location' required><br><br>";
echo "<input type='submit' value='Activiteit toevoegen' class='mooie-knop'>";
echo "</form>";
echo "</div>";

// Formulier voor het zoeken en filteren van activiteiten
echo "<div class='zoek'>";
echo "<form method='get' action='overzicht.php'>";
echo "<h1>Een activiteit zoeken</h1>";
echo "<label for='searchName'>Activiteit zoeken:</label><br>";
echo "<input type='text' id='searchName' name='searchName' value='$searchName'><br><br>";
echo "<input type='submit' value='Zoeken' class='mooie-knop'>";
echo "</form>";
echo "</div>";

// Controleren of een activiteit wordt bewerkt
if (isset($_POST['editDiner'])) {
    $dinerID = $_POST['DinerID'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $location = $_POST['location'];

    // Het bewerkingsformulier weergeven met de huidige waarden
    echo "<div class='bewerk'>";
    echo "<form method='post' action='overzicht.php'>";
    echo "<h1>Activiteit bewerken</h1>";
    echo "<input type='hidden' name='DinerID' value='$dinerID'>";
    echo "<label for='description'>Activiteit:</label><br>";
    echo "<input type='text' id='description' name='description' value='$description' required><br>";
    echo "<label for='start'>Start:</label><br>";
    echo "<input type='datetime-local' id='start' name='start' value='$start' required><br>";
    echo "<label for='end'>Eind:</label><br>";
    echo "<input type='datetime-local' id='end' name='end' value='$end' required><br>";
    echo "<label for='location'>Locatie:</label><br>";
    echo "<input type='text' id='location' name='location' value='$location' required><br><br>";
    echo "<input type='submit' name='saveChanges' value='Wijzigingen opslaan' class='mooie-knop'>";
    echo "</form>";
    echo "</div>";
}

// Tabel om de resultaten weer te geven
echo "<table>";
// Doorlopen van de resultaten
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
    echo "<tr>";
    echo "<th>Bewerken:</th>";
    echo "<td>";
    echo "<form method='post' action='overzicht.php'>";
    echo "<input type='hidden' name='DinerID' value='" . htmlspecialchars($row["DinerID"]) . "'>";
    echo "<input type='hidden' name='description' value='" . htmlspecialchars($row["Description"]) . "'>";
    echo "<input type='hidden' name='start' value='" . htmlspecialchars($row["Start"]) . "'>";
    echo "<input type='hidden' name='end' value='" . htmlspecialchars($row["End"]) . "'>";
    echo "<input type='hidden' name='location' value='" . htmlspecialchars($row["Location"]) . "'>";
    echo "<input type='submit' name='editDiner' value='Activiteit bewerken' class='mooie-knop'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Verwijderen:</th>";
    echo "<td>";
    echo "<form method='post' action='deleteDiner.php'>";
    echo "<input type='hidden' name='DinerID' value='" . htmlspecialchars($row["DinerID"]) . "'>";
    echo "<input type='submit' value='Activiteit verwijderen' class='mooie-knop'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    // Een lege rij toevoegen voor tussenruimte
    echo "<tr class='space'><td colspan='2'></td></tr>";
}
echo "</table>";

// Uitloggen knop
echo "<div class='uitloggen'>";
echo "<form method='post' action='logout.php'>";
echo "<input type='submit' value='Uitloggen' class='mooie-knop'>";
echo "</form>";
echo "</div>";

?>

