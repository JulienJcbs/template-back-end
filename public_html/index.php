<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS, GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Max-Age: 86400');

date_default_timezone_set('Europe/Brussels');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/utils/utils.php';
require_once __DIR__ . '/../model/utils/read_env.php';
require_once __DIR__ . '/../model/utils/pdo.php';
require_once __DIR__ . '/../controller/PostController.php';

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
        encodeSuccess(['message' => 'API_BACK']);
        break;
    case '/user/register':
        registerUser($pdo);
        break;
    case '/user/login':
        loginUser($pdo);
        break;
    case '/user/getEvents':
        getEvents($pdo);
        break;
    case '/user/getBackgroundImage':
        getBackgroundImageByRoute($pdo);
        break;
    case '/user/getEventById':
        getEventById($pdo);
        break;
    case '/user/createReservation':
        createReservation($pdo);
        break;
    case '/user/selectEvent':
        selectEvent($pdo);
        break;
    case '/admin/register':
        registerAdmin($pdo);
        break;
    case '/admin/login':
        loginAdmin($pdo);
        break;
    case '/sendMessage':
        sendMessage($pdo);
        break;
    case '/user/getMembers':
        getMembersForUsers($pdo);
        break;
    case '/user/getArticles':
        getArticlesForUsers($pdo);
        break;
    case '/admin/addMember':
        addMember($pdo);
        break;
    case '/admin/addArticle':
        addArticle($pdo);
        break;
    case '/admin/getArticleById':
        getArticleById($pdo);
        break;
    case '/admin/getContentById':
        getContentById($pdo);
        break;
    case '/admin/addArticleContent':
        addArticleContent($pdo);
        break;
    case '/admin/updateCellImage':
        updateCellImage($pdo);
        break;
    case '/admin/updatePara':
        updatePara($pdo);
        break;
    case '/admin/updateLink':
        updateLink($pdo);
        break;
    case '/admin/createEvent':
        createEvent($pdo);
        break;
    case '/admin/getMembers':
        getMembersForAdmin($pdo);
        break;
    case '/admin/getMemberById':
        getMemberById($pdo);
        break;
    case '/admin/updateTextContent':
        updateTextContent($pdo);
        break;
    case '/admin/getAllArticles':
        getAllArticles($pdo);
        break;
    case '/admin/publish':
        publishArtcicle($pdo);
        break;
    case '/admin/getEventById':
        getEventByIdForAdmin($pdo);
        break;
    case '/admin/getEvents':
        getEventsForAdmin($pdo);
        break;
    case '/webhook':
        webhook($pdo, $wh);
        break;
    case '/admin/getMessages':
        getMessages($pdo);
        break;
    case '/admin/updateEventVisibility':
        updateEventVisibility($pdo);
        break;
    default:
        http_response_code(404);
        break;
}
