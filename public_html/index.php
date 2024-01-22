<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS, GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Max-Age: 86400');

date_default_timezone_set('Europe/Brussels');

require_once __DIR__ . '/../model/utils/read_env.php';
require_once __DIR__ . '/../model/utils/utils.php';
require_once __DIR__ . '/../model/utils/pdo.php';
require_once __DIR__ . '/../controller/Controller.php';

$files = glob(__DIR__ . '/../model/class/*.php');

foreach ($files as $file) {
    require_once $file;
}

$url_parts = parse_url($_SERVER['REQUEST_URI']);
$path = $url_parts['path'];

// Ajout des paramètres à la route
if (isset($url_parts['query'])) {
    $path .= '?' . $url_parts['query'];
}

$jsonData = file_get_contents('php://input');
$formData = json_decode($jsonData, true);

$path = explode('?', $path)[0];

/**
 * Liste des routes
 * 
 * Accèssibles
 */
switch ($path) {
    case '/':
        encodeSuccess(['message'=>'API_BACK']);
        break;
    default:
        http_response_code(404);
        break;
}