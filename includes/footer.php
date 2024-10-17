<?php
// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['username'])) {
    $ingelogdeGebruiker = $_SESSION['username'];
} else {
    $ingelogdeGebruiker = "Niet ingelogd"; // Of een andere default waarde als niet ingelogd
}

// Definieer een array met de Nederlandse maandnamen
$maandNamen = array("januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december");

// Haal de huidige dag van de maand op
$vandaag = date("d");

// Haal de huidige maand op, verminderd met 1 omdat arrays op nul-index gebaseerd zijn
$maand = $maandNamen[date("n")-1];
?>

<footer>
    <!-- Toon de datum met de dag en maandnaam in het Nederlands -->
    <p>Ingelogd als: <?php echo htmlspecialchars($ingelogdeGebruiker); ?> | De datum vandaag is: <?php echo $vandaag . " " . $maand; ?></p>
</footer>
