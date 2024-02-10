<?php

class User
{
    static $tableName = 'users';

    static function register($pdo, $email, $firstName, $lastName, $password, $passwordVerify, $tel = '')
    {
        if (!verifyRegex('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            encodeError('Format de l\'email invalide.');
            return false;
        }
        if (!verifyRegex('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]).{6,}$/', $password)) {
            encodeError('Le mot de passe doit contenir au moins 6 caractères dont un caractère spécial, une majuscule et un chiffre.');
            return false;
        }
        if (!verifyStrlen($firstName, 2, 32)) {
            encodeError('La longueur du prénom est invalide.');
            return false;
        }
        if (!verifyStrlen($lastName, 2, 32)) {
            encodeError('La longueur du nom est invalide.');
            return false;
        }
        if ($password != $passwordVerify) {
            encodeError('Les deux mots de passes doivent correspondre.');
            return false;
        }
        if (verifyExisteRow($pdo, 'users', 'email', $email)) {
            encodeError('Cette email est déjà utilisée');
            return false;
        }
        if (strlen($tel) > 0 && !verifyRegex('/^0[1-9][0-9]{8}$/', $tel)) {
            encodeError('Le numéro de téléphonne n\'est pas sous un format valide.');
            return false;
        }

        $userId = User::encodeUser($pdo, $email, $firstName, $lastName, $password, $tel);
        encodeSuccess([
            'userId' => $userId,
        ]);

        return true;
    }

    private static function encodeUser($pdo, $email, $firstName, $lastName, $password, $tel)
    {
        $userId = generateRandomString();
        while (verifyExisteRow($pdo, 'users', 'id', $userId)) {
            $userId = generateRandomString();
        }

        $req = $pdo->prepare('INSERT INTO users (id, email, first_name, last_name, tel, password) VALUES (:id, :email, :firstName, :lastName, :tel, :password);');
        $req->execute([
            'id' => $userId,
            'email' => $email,
            'lastName' => $lastName,
            'firstName' => $firstName,
            'tel' => $tel,
            'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 14])
        ]);

        return $userId;
    }

    static function login($pdo, $email, $password)
    {
        if (!verifyExisteRow($pdo, 'users', 'email', $email)) {
            encodeError('Cette adresse email n\'est pas enregistrée.');
            return false;
        }
        $req = $pdo->prepare('SELECT id, password FROM users WHERE email = :email');
        $req->execute([
            'email' => $email
        ]);
        $result = $req->fetch();
        if (password_verify($password, $result['password'])) {
            encodeSuccess([
                'userId' => $result['id'],
            ]);
            return true;
        } else {
            encodeError('Mot de passe incorrect.');
            return false;
        }
    }
}
