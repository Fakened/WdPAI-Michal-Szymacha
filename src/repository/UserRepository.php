<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return null;
        }
        return new User(
            $user['id'],
            $user['is_admin'],
            $user['pass'],
            $user['email'],
            $user['team_id']
        );
    }

    public function addUser(string $email, string $pass): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user ( pass, email, is_admin, login)
            VALUES (?, ?, false, ?)
        ');
        
        $stmt->execute([
            $pass,
            $email,
            $email,
        ]);
    }

    public function changePassword(string $password, string $id)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.user SET pass = ? WHERE id = ?
        ');
        $stmt->execute([
            $password,
            $id,
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
}