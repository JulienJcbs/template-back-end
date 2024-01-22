<?php

try {

    // Créez une nouvelle instance PDO
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password);

    // Configurez le mode de gestion des erreurs pour PDO en mode exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, affichez un message d'erreur
    encodeError($e->getMessage());
    die();
}