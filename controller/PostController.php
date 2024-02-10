<?php

function registerUser($pdo)
{
    User::register($pdo, $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['password_verify'], $_POST['tel']);
}

function loginUser($pdo)
{
    User::login($pdo, $_POST['email'], $_POST['password']);
}

function loginAdmin($pdo)
{
    Admin::login($pdo, $_POST['email'], $_POST['password']);
}

function registerAdmin($pdo)
{
    Admin::register($pdo, $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['password_verify'], $_POST['tel']);
}

function sendMessage($pdo)
{
    Message::send($pdo, $_POST['fullname'], $_POST['email'], $_POST['requestType'], $_POST['content']);
}

function getMembersForUsers($pdo)
{
    Member::getMembersForUsers($pdo);
}

function addMember($pdo)
{
    Member::encodeMember($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['role'], $_POST['description'], $_FILES['file'], $_POST['tel'], $_POST['email'], $_POST['adminId']);
}

function addArticle($pdo)
{
    Article::addArticle($pdo, $_POST['title'], $_POST['adminId']);
}

function getArticleById($pdo)
{
    Article::getArticleById($pdo, $_POST['articleId'], $_POST['adminId']);
}

function addArticleContent($pdo)
{
    Article::createContent($pdo, $_POST['articleId'], $_POST['type'], $_POST['adminId']);
}

function getArticlesForUsers($pdo)
{
    Article::getAllArticlesVisibles($pdo);
}

function getContentById($pdo)
{
    Article::getContentById($pdo, $_POST['adminId'], $_POST['cellId']);
}

function updateCellImage($pdo)
{
    Article::updateCellImage($pdo, $_POST['adminId'], $_FILES['file'], $_POST['cellId']);
}

function updatePara($pdo)
{
    Article::updatePara($pdo, $_POST['adminId'], $_POST['cellId'], $_POST['font_size'], $_POST['text_align'], $_POST['order_index'], $_POST['text_color']);
}

function updateLink($pdo)
{
    Article::updateLink($pdo, $_POST['adminId'], $_POST['cellId'], $_POST['font_size'], $_POST['text_align'], $_POST['order_index'], $_POST['text_color'], $_POST['link_to']);
}

function selectEvent($pdo)
{
    Event::selectEvent($pdo, $_POST['eventId']);
}

function getEvents($pdo)
{
    Event::getEvents($pdo);
}

function createEvent($pdo)
{
    Event::createEvent($pdo, $_POST['eventName'], $_POST['date'], $_POST['nbR'], $_POST['nbV'], $_POST['adminId']);
}

function getEventById($pdo)
{
    Event::getEventByIdForFront($pdo, $_POST['eventId']);
}

function webhook($pdo, $wh)
{
    $payload = @file_get_contents('php://input');
    $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    Stripe::webhook($pdo, $payload, $sigHeader, $wh);
}

function createReservation($pdo)
{
    Event::createReservation($pdo, $_POST['userId'], $_POST['type'], $_POST['eventId'], $_POST['nbPersons']);
}

function getMembersForAdmin($pdo)
{
    Member::getMembersForAdmin($pdo, $_POST['adminId']);
}

function getMemberById($pdo)
{
    Member::getMemberById($pdo, $_POST['adminId'], $_POST['memberId']);
}

function updateTextContent($pdo)
{
    Article::updateTextContent($pdo, $_POST['adminId'], $_POST['textContent'], $_POST['cellId'], $_POST['lang']);
}

function getAllArticles($pdo)
{
    Article::getAllArticles($pdo, $_POST['adminId']);
}

function publishArtcicle($pdo)
{
    Article::publishArtcicle($pdo, $_POST['adminId'], $_POST['articleId'], $_POST['visibility']);
}

function getEventByIdForAdmin($pdo)
{
    Event::getEventByIdForAdmin($pdo, $_POST['adminId'], $_POST['eventId']);
}
