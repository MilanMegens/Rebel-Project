<?php
// Database include
include "includes/database.php";
startConnection(); // Start de databaseverbinding

// Controleer of er een DinerID is verzonden via POST
if(isset($_POST['DinerID'])) {
    $dinerID = $_POST['DinerID']; // Haal de DinerID op uit het POST-verzoek

    // Bereid de query voor om het diner te verwijderen
    $query = "DELETE FROM Diner WHERE DinerID = :dinerID";
    // SQL-query om een diner te verwijderen op basis van de DinerID
    $stmt = $pdo->prepare($query); // Bereid de query voor met behulp van PDO
    $stmt->bindValue(':dinerID', $dinerID); // Bind de DinerID waarde aan de placeholder in de query

    // Voer de query uit
    if ($stmt->execute()) { // Voer de query uit en controleer of deze succesvol is
        // Als de query succesvol is uitgevoerd, stuur de gebruiker terug naar de pagina waar de lijst met diners wordt weergegeven
        header("Location: overzicht.php");
        exit(); // Zorg ervoor dat het script stopt na de redirect om verdere uitvoering te voorkomen
    } else {
        // Als er een fout is opgetreden bij het uitvoeren van de query, toon een foutmelding
        echo "Er is een fout opgetreden bij het verwijderen van het diner.";
    }
} else {
    // Als er geen DinerID is verzonden, toon een foutmelding
    echo "Geen DinerID ontvangen om te verwijderen.";
}
?>
