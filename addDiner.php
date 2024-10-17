<?php
// Database include
include "includes/database.php";
startConnection(); // Start de databaseverbinding

// Controleer of het formulier is verzonden met de POST-methode
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verzamel de gegevens van het formulier
    $description = $_POST['description']; // Haal de beschrijving van de activiteit op
    $start = date('Y-m-d H:i:s', strtotime($_POST['start'])); // Zet de startdatum om naar het juiste formaat
    $end = date('Y-m-d H:i:s', strtotime($_POST['end'])); // Zet de einddatum om naar het juiste formaat
    $location = $_POST['location']; // Haal de locatie van de activiteit op

    // Bereid de SQL-query voor om een nieuwe activiteit toe te voegen
    $query = "INSERT INTO Diner (Description, Start, [End], Location) VALUES (:description, :start, :end, :location)";
    $stmt = $pdo->prepare($query); // Bereid de query voor met PDO

    // Koppel de waarden van het formulier aan de placeholders in de query
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':start', $start);
    $stmt->bindValue(':end', $end);
    $stmt->bindValue(':location', $location);

    // Voer de query uit
    if ($stmt->execute()) {
        // Als de query succesvol is uitgevoerd, stuur de gebruiker terug naar de overzichtspagina
        header("Location: overzicht.php");
        exit(); // Zorg ervoor dat het script stopt na de redirect
    } else {
        // Als er een fout is opgetreden bij het uitvoeren van de query, toon een foutmelding
        echo "Er is een fout opgetreden bij het toevoegen van de activiteit.";
    }
}
?>
