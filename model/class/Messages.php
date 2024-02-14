<?php

class Message
{
    static function send($pdo, $fullname, $email, $quest_type, $content)
    {
        if (!verifyRegex('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            encodeError('Format de l\'email invalide.');
            return false;
        }
        if (!verifyStrlen($fullname, 4, 64)) {
            encodeError('Veuillez renseigner votre nom et prénom');
            return false;
        }
        if ($quest_type !== 'Demande d\'emplois' && $quest_type !== 'Concernant les dons' && $quest_type !== 'Autre') {
            encodeError('Une erreur est survenue, choisissez votre type de requête.');
            return false;
        }
        if (strlen($content) < 120) {
            encodeError('Merci de spécifier votre problème de manière plus précise... (au moin 120 caractères).');
            return false;
        }

        $questId = generateRandomString();
        while (verifyExisteRow($pdo, 'messages', 'id', $questId)) {
            $questId = generateRandomString();
        }

        $req = $pdo->prepare('INSERT INTO messages (id, email_sender, content, quest_type, full_name) VALUES (:id, :email_sender, :content, :quest_type, :full_name)');
        $req->execute([
            'id' => $questId,
            'email_sender' => $email,
            'content' => $content,
            'quest_type' => $quest_type,
            'full_name' => $fullname
        ]);

        return encodeSuccess($questId);
        return true;
    }

    static function getMessages($pdo, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé.');
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM messages;');
        $req->execute();

        encodeSuccess($req->fetchAll());
        return true;
    }
}
