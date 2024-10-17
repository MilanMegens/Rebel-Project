<?php
session_start(); // Start de sessie

// Controleer of de gebruiker al is ingelogd
if (isset($_SESSION['username'])) {
    // Redirect naar overzichtspagina als de gebruiker al is ingelogd
    header('Location: overzicht.php');
    exit(); // Zorg ervoor dat het script stopt na de redirect om verdere uitvoering te voorkomen
}

// Controleer of het verzoek een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal de gebruikersnaam en het wachtwoord op uit het POST-verzoek en verwijder eventuele spaties aan het begin en einde
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Maak een nieuwe PDO-verbinding met de ODBC-driver voor SQL Server
        $conn = new PDO("odbc:odbc3sqlserver");

        // Stel de PDO-foutmodus in op uitzondering, zodat PDO uitzonderingen gooit bij fouten
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Bereid een SQL-query voor om de gebruiker op te halen met de opgegeven gebruikersnaam
        $stmt = $conn->prepare('SELECT * FROM [User] WHERE UserName = :username');
        $stmt->bindParam(':username', $username); // Bind de gebruikersnaam aan de placeholder in de query
        $stmt->execute(); // Voer de query uit

        // Haal de gebruiker op als een associatieve array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Controleer of de gebruiker bestaat
        if ($user) {
            // Vergelijk het opgegeven wachtwoord met het wachtwoord in de database
            if ($user['Password'] === $password) {
                // Als het wachtwoord correct is, sla de gebruikersnaam op in de sessie en redirect naar de overzichtspagina
                $_SESSION['username'] = $username;

                // Debug: controleer of de gebruikersnaam is ingesteld in de sessie
                var_dump($_SESSION['username']); // Hiermee wordt de gebruikersnaam weergegeven

                header('Location: overzicht.php');
                exit(); // Zorg ervoor dat het script stopt na de redirect om verdere uitvoering te voorkomen
            } else {
                // Als het wachtwoord incorrect is, toon een foutmelding
                echo 'Incorrect wachtwoord';
            }
        } else {
            // Als de gebruiker niet gevonden is, toon een foutmelding
            echo 'Gebruiker niet gevonden';
        }
    } catch (PDOException $e) {
        // Als er een PDO-exceptie optreedt, toon een foutmelding met de boodschap van de exceptie
        echo 'Connectie mislukt: ' . $e->getMessage();
    }
}
?>
