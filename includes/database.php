<?php
// Een "leeg" $pdo variabele aanmaken
$pdo = null;

// Starten van een DB connectie als de functie niet bestaat
if (!function_exists('startConnection')) {
    function startConnection()
    {
        global $pdo;
        // Open de database connectie en ODBC driver
        try
        {
            $pdo = new PDO("odbc:odbc3sqlserver");
            // Set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo "<h1>Database error:</h1>";
            echo $e->getMessage();
            die();
        }
    }
}

// Uitvoeren van een query als de functie niet bestaat
if (!function_exists('executeQuery')) {
    function executeQuery($sql)
    {
        global $pdo;

        try
        {
            // Start de database connectie indien nog niet gestart
            if (!$pdo) {
                startConnection();
            }

            // Query uitvoeren
            $result = $pdo->query($sql);

            return $result;
        }
        catch (PDOException $e)
        {
            echo 'Probleem:' . $e->getMessage();
            exit();
        }
    }
}
?>
