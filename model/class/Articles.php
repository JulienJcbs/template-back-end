<?php

class Article
{
    static $tableName = 'articles';

    static function getAllArticlesVisibles($pdo)
    {

        $req = $pdo->prepare('SELECT * FROM articles WHERE visible = 1');

        $req->execute();

        $articles = $req->fetchAll();

        for ($i = 0; $i < count($articles); ++$i) {
            $req = $pdo->prepare('SELECT * from article_content WHERE article_id = :articleId ORDER BY order_index ASC');
            $req->execute([
                'articleId' => $articles[$i]['id'],
            ]);
            $articleComponents = $req->fetchAll();
            $articles[$i]['components'] = $articleComponents;
        }

        encodeSuccess($articles);
        return true;
    }

    static function addArticle($pdo, $title, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyStrlen($title, 1, 255)) {
            encodeError('La longueur du titre doit être entre 1 et 255 caractères.');
            return false;
        }

        $id = generateRandomString();

        while (verifyExisteRow($pdo, 'articles', 'id', $id)) {
            $id = generateRandomString();
        }

        $req = $pdo->prepare('INSERT INTO articles (id, title) VALUES (:id, :title);');
        $req->execute([
            'id' => $id,
            'title' => $title,
        ]);

        encodeSuccess(['articleId' => $id]);
        return true;
    }

    static function getAllArticlesForAdmin($pdo, $adminId)
    {
    }

    static function getArticleById($pdo, $articleId, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'articles', 'id', $articleId)) {
            encodeError(false);
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM articles WHERE id = :id;');
        $req->execute([
            'id' => $articleId
        ]);

        $article = $req->fetch();

        $req = $pdo->prepare('SELECT * FROM article_content WHERE article_id = :articleId ORDER BY order_index ASC');
        $req->execute(
            ['articleId' => $articleId]
        );

        $contents = $req->fetchAll();

        $article['components'] = $contents;

        encodeSuccess($article);
        return true;
    }

    static function createContent($pdo, $articleId, $contentType, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'articles', 'id', $articleId)) {
            encodeError('Article introuvable.');
            return false;
        }

        $idContent = generateRandomString();

        while (verifyExisteRow($pdo, 'article_content', 'id', $idContent)) {
            $idContent = generateRandomString();
        }

        $req = $pdo->prepare('INSERT INTO article_content (id, article_id, type, text_content_fr) VALUES (:id, :article_id, :type, :cell);');
        $req->execute([
            'id' => $idContent,
            'article_id' => $articleId,
            'type' => $contentType,
            'cell' => $contentType,
        ]);

        encodeSuccess(['content_id' => $idContent]);
        return true;
    }

    static function getContentById($pdo, $adminId, $cellId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'article_content', 'id', $cellId)) {
            encodeError('Cell introuvable.');
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM article_content WHERE id = :id');
        $req->execute(['id' => $cellId]);

        encodeSuccess($req->fetch());
        return true;
    }

    static function updateCellImage($pdo, $adminId, $file, $cellId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }

        if (!verifyExisteRow($pdo, 'article_content', 'id', $cellId)) {
            encodeError('Cell introuvable');
            return false;
        }

        $uri = generateRandomString(48);

        moveFileTo($file, __DIR__ . '/../../public_html/assets/pictures/' . $uri . '.png');

        $req = $pdo->prepare('UPDATE article_content SET uri = :uri WHERE id = :id');
        $req->execute([
            'id' => $cellId,
            'uri' => $uri,
        ]);

        encodeSuccess(['uri' => $uri]);
        return true;
    }

    static function updatePara($pdo, $adminId, $cellId, $fs, $align, $orderIndex, $textColor)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'article_content', 'id', $cellId)) {
            encodeError('Cell introuvable');
            return false;
        }
        if ($fs <= 0 || $fs > 5) {
            encodeError('La taille de la police doit être entre 0.1 et 5 (nombres à virgules compris).');
            return false;
        }

        $req = $pdo->prepare('UPDATE article_content SET font_size = :fs, text_align= :align, order_index = :orderIndex, text_color = :text_color WHERE id = :cellId');
        $req->execute([
            'fs' => $fs,
            'align' => $align,
            'orderIndex' => $orderIndex,
            'cellId' => $cellId,
            'text_color' => $textColor,
        ]);

        encodeSuccess(true);
        return true;
    }

    static function updateLink($pdo, $adminId, $cellId, $fs, $align, $orderIndex, $textColor, $linkTo)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'article_content', 'id', $cellId)) {
            encodeError('Cell introuvable');
            return false;
        }
        if ($fs <= 0 || $fs > 5) {
            encodeError('La taille de la police doit être entre 0.1 et 5 (nombres à virgules compris).');
            return false;
        }

        $req = $pdo->prepare('UPDATE article_content SET font_size = :fs, text_align= :align, order_index = :orderIndex, text_color = :text_color, link_to = :link_to WHERE id = :cellId');
        $req->execute([
            'fs' => $fs,
            'align' => $align,
            'orderIndex' => $orderIndex,
            'cellId' => $cellId,
            'text_color' => $textColor,
            'link_to' => $linkTo,
        ]);

        encodeSuccess(true);
        return true;
    }

    static function updateTextContent($pdo, $adminId, $textContent, $cellId, $lang)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'article_content', 'id', $cellId)) {
            encodeError('Cell introuvable');
            return false;
        }
        if ($lang != 'fr' && $lang != 'nl' && $lang != 'en') {
            encodeError('Langue invalide.');
            return false;
        }

        $req = $pdo->prepare('UPDATE article_content SET text_content_' . $lang . ' = :textContent WHERE id = :id');
        $req->execute(
            [
                'id' => $cellId,
                'textContent' => $textContent
            ]
        );
        encodeSuccess(true);
        return true;
    }

    static function getAllArticles($pdo, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM articles');

        $req->execute();

        encodeSuccess($req->fetchAll());
        return true;
    }

    static function publishArtcicle($pdo, $adminId, $articleId, $visibility)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }
        if (!verifyExisteRow($pdo, 'articles', 'id', $articleId)) {
            encodeError('Article introuvable.');
            return false;
        }
        if ($visibility !== 'true' && $visibility !== 'false') {
            encodeError('Type incorrecte');
            return false;
        }

        $visible = false;

        if ($visibility == 'true') {
            $visible = true;
        }

        $req = $pdo->prepare('UPDATE articles SET visible = :visibility WHERE id = :id');
        $req->execute([
            'visibility' => $visible,
            'id' => $articleId,
        ]);
        encodeSuccess(true);
        return false;
    }
}
