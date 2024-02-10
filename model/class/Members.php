<?php

class Member
{
    static $tableName = 'members';

    static function getMembersForUsers($pdo)
    {
        $req = $pdo->prepare('SELECT id, first_name, last_name, role, description, image_uri FROM members');
        $req->execute();
        encodeSuccess($req->fetchAll());
        return true;
    }

    static function encodeMember($pdo, $firstName, $lastName, $role, $description, $file, $tel, $email, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé');
            return false;
        }
        if (strlen($firstName < 2) || strlen($firstName) > 64) {
            encodeError('La longueur du prénom est invalide');
            return false;
        }
        if (strlen($lastName < 2) || strlen($lastName) > 64) {
            encodeError('La longueur du nom est invalide');
            return false;
        }
        if (!verifyRegex('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            encodeError('L\'adresse email n\'est pas sous format valide.');
            return false;
        }
        if (strlen($tel) > 0 && !verifyRegex('/^0[1-9][0-9]{8}$/', $tel)) {
            encodeError('Le numéro de téléphonne n\'est pas sous un format valide.');
            return false;
        }
        if (verifyExisteRow($pdo, 'members', 'email', $email)) {
            encodeError('Cette email est déjà utilisée');
            return false;
        }
        if (strlen($role) < 2 || strlen($role) > 64) {
            encodeError('Le rêle est invalide');
            return false;
        }
        if (!verifyStrlen($description, 0, 255)) {
            encodeError('La description est trop longue');
            return false;
        }

        $id = generateRandomString();

        while (verifyExisteRow($pdo, 'members', 'id', $id)) {
            $id = generateRandomString();
        }

        $uri = generateRandomString(48);

        moveFileTo($file, __DIR__ . '/../../public_html/assets/pictures/' . $uri . '.png');

        $req = $pdo->prepare('INSERT INTO `members`(`id`, `first_name`, `last_name`, `role`, `description`, `image_uri`, `tel`, `email`)
            VALUES (:id, :firstName, :lastName, :role, :description, :image_uri, :tel, :email);');
        $req->execute([
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'role' => $role,
            'description' => $description,
            'image_uri' => $uri,
            'tel' => $tel,
            'email' => $email,
        ]);

        encodeSuccess(true);
    }

    static function getMembersForAdmin($pdo, $adminId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé');
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM members');

        $req->execute();

        encodeSuccess($req->fetchAll());
        return true;
    }

    static function getMemberById($pdo, $adminId, $memberId)
    {
        if (!Admin::verifyAdminExiste($pdo, $adminId)) {
            encodeError('Accès refusé');
            return false;
        }

        $req = $pdo->prepare('SELECT * FROM members WHERE id= :id');

        $req->execute(['id' => $memberId]);

        encodeSuccess($req->fetchAll());
        return true;
    }
}
