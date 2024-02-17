<?php

class Images
{

    static function getBackgroundImagesByRoute($pdo, $route)
    {
        $req = $pdo->prepare('SELECT * FROM images WHERE type = "background" AND page_route = :route;');
        $req->execute([
            'route' => $route,
        ]);

        encodeSuccess($req->fetchAll());
    }

    static function sendImage($pdo, $file, $route, $type, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            return false;
            encodeError('Accès refusé');
        }

        $uri = generateRandomString(48);
        moveFileTo($file, __DIR__ . '/../../public_html/assets/pictures/' . $uri . '.png');

        $req = $pdo->prepare('INSERT INTO images (type, uri, page_route) VALUES (:type, :uri, :page_route);');
        $req->execute([
            'type' => $type,
            'uri' => $uri,
            'page_route' => $route
        ]);

        return encodeSuccess(['uri' => $uri]);
        return true;
    }

    static function removeImage($pdo, $image_id, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            return false;
            encodeError('Accès refusé');
        }

        $uri = Images::getImageById($pdo, $image_id)['uri'];
        unlink(__DIR__ . '/../../public_hml/assets/pictures/' . $uri . '.png');

        $req = $pdo->prepare('DELETE FROM images WHERE id = :id');
        $req->execute([
            'id' => $image_id
        ]);

        encodeSuccess(true);
        return true;
    }

    private static function getImageById($pdo, $image_id)
    {
        $req = $pdo->prepare('SELECT * FROM images WHERE id = :id;');
        $req->execute(['id' => $image_id]);

        return $req->fetch();
    }
}