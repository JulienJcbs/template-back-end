<?php

$envFilePath = __DIR__ . '/../../.env';

if (file_exists($envFilePath)) {

    $envFileContents = file_get_contents($envFilePath);

    // Divisez le contenu en lignes
    $envFileLines = explode("\n", $envFileContents);

    // Parcourez chaque ligne et extrayez les variables d'environnement
    foreach ($envFileLines as $line) {
        // Ignorez les lignes vides ou les commentaires (commençant par #)
        if (!empty($line) && strpos($line, '#') !== 0) {
            // Divisez la ligne en clé et valeur
            list($key, $value) = explode('=', $line, 2);

            // Supprimez les espaces blancs autour de la clé et de la valeur
            $key = trim($key);
            $value = trim($value);

            // Définissez la variable d'environnement si elle n'est pas déjà définie
            if (!isset($_ENV[$key])) {
                $_ENV[$key] = $value;
            }
        }
    }

    $servername = $_ENV['DB_HOST']; // Adresse du serveur MySQL
    $username = $_ENV['DB_USER']; // Nom d'utilisateur MySQL
    $password = $_ENV['DB_PASSWORD']; // Mot de passe MySQL
    $database = $_ENV['DB_NAME']; // Nom de la base de données
    $port = $_ENV['PORT'];
    $wh = $_ENV['WH'];
} else {
    // Gérez le cas où le fichier .env n'existe pas
    encodeError("Le fichier .env n'a pas été trouvé.");
    die();
}