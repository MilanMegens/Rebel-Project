<?php
session_start(); // Start de sessie

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

        // Genereer een uniek studentnummer voor de nieuwe gebruiker
        $studentNr = generateUniqueStudentNumber($conn);

        // Voeg een nieuwe gebruiker toe aan de database
        $stmt = $conn->prepare('INSERT INTO [User] (UserName, [Password], StudentNr) VALUES (:username, :password, :studentNr)');
        // Bereid de SQL-query voor om een nieuwe gebruiker in te voegen
        $stmt->bindParam(':username', $username); // Bind de gebruikersnaam aan de placeholder in de query
        $stmt->bindParam(':password', $password); // Bind het wachtwoord aan de placeholder in de query
        $stmt->bindParam(':studentNr', $studentNr); // Bind het studentnummer aan de placeholder in de query
        $stmt->execute(); // Voer de query uit om de nieuwe gebruiker toe te voegen

        // Stuur de gebruiker door naar de inlogpagina na succesvolle registratie
        header('Location: login.php');
        exit(); // Zorg ervoor dat het script stopt na de redirect om verdere uitvoering te voorkomen

    } catch (PDOException $e) {
        // Als er een PDO-exceptie optreedt, toon een foutmelding met de boodschap van de exceptie
        echo 'Connection failed: ' . $e->getMessage();
    }
}

// Functie om een uniek studentnummer te genereren
function generateUniqueStudentNumber($conn) {
    // Genereer een willekeurig studentnummer
    $studentNr = generateRandomStudentNumber(); // Roep de functie aan om een willekeurig studentnummer te genereren

    // Controleer of het gegenereerde studentnummer al bestaat in de database
    $stmt = $conn->prepare('SELECT StudentNr FROM [User] WHERE StudentNr = :studentNr');
    // Bereid de SQL-query voor om te controleren of het studentnummer al bestaat
    $stmt->bindParam(':studentNr', $studentNr); // Bind het studentnummer aan de placeholder in de query
    $stmt->execute(); // Voer de query uit

    // Als het studentnummer al bestaat, genereer een nieuw uniek studentnummer
    if ($stmt->fetch(PDO::FETCH_ASSOC)) { // Controleer of het studentnummer al bestaat
        return generateUniqueStudentNumber($conn); // Roep de functie opnieuw aan om een nieuw uniek studentnummer te genereren
    }

    return $studentNr; // Retourneer het unieke studentnummer
}

// Functie om een willekeurig studentnummer te genereren
function generateRandomStudentNumber() {
    // Genereer een willekeurig getal tussen 10000000 en 99999999
    return mt_rand(10000000, 99999999); // Retourneer het willekeurige studentnummer
}
?>
