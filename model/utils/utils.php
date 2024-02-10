<?php

/**
 * ----------------------------------------
 * 
 *          En cas de réponse Api
 * 
 * ----------------------------------------
 */
function encodeSuccess($data)
{
    echo json_encode(['success' => true, 'data' => $data]);
}

function encodeError($msg)
{
    echo json_encode(['success' => false, 'msg' => $msg]);
}


/**
 * Move les fichiers upload
 */
function moveFileTo($file, $to)
{
    move_uploaded_file($file['tmp_name'], $to);
}

function generateRandomString($length = 36)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    $characterCount = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $characterCount - 1)];
    }

    return $randomString;
}

function verifyStrlen($str, $min, $max)
{
    return strlen($str) >= $min && strlen($str) <= $max;
}

function verifyExisteRow($pdo, $tableName, $columnName, $value)
{
    $sql = "SELECT COUNT(*) as nb FROM $tableName WHERE $columnName = :value";
    $req = $pdo->prepare($sql);
    $req->execute(['value' => $value]);
    return $req->fetch()['nb'] > 0;
}


function verifyRegex($pattern, $str)
{
    return preg_match($pattern, $str);
}

function timeIsPassed($timeStamp)
{
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $timeStamp);
    $now = new DateTime();

    return $date < $now;
}
