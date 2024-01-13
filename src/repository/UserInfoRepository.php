<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserInfo.php';

class UserInfoRepository extends Repository
{
    public function findUserInfoById(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_information WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editUserInfo(int $id, string $name, string $surname, string $phone)
    {
    try {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_info WHERE user_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() == 0) {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO public.user_info (user_id, name, surname, phone)
                VALUES (?, ?, ?, ?)
            ');
            $stmt->execute([
                $id,
                $name,
                $surname,
                $phone,
            ]);
            return json_encode(["message" => "success"]);
        } else {
            $stmt = $this->database->connect()->prepare('
                UPDATE public.user_info SET name = ?, surname = ?, phone = ? WHERE user_id = ?
            ');
            $stmt->execute([
                $name,
                $surname,
                $phone,
                $id,
            ]);
            return json_encode(["message" => "success"]);
        } 
    } catch (PDOException $e) {
        return json_encode(["error" => $e->getMessage()]);
    }
    }   
}