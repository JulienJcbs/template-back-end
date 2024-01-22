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