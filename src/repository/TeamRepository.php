<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Team.php';

class TeamRepository extends Repository {
    public function getYourTeam() {

        $team_id = $_SESSION['team_id'];
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM public.user WHERE team_id = :team_id
            ');
        $stmt->bindParam(':team_id', $team_id, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users_id = [];
        foreach ($users as $user) {
            $users_id[] = $user['id'];
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_information WHERE id IN ('.implode(',', $users_id).')
            ');
        $stmt->execute();
        $users_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users_info;
    }

    public function getUsersWithoutTeam() {
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM public.user WHERE team_id IS NULL
            ');
        $stmt->execute();
        $users_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users_id = [];
        foreach ($users_info as $user) {
            $users_id[] = $user['id'];
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_information WHERE id IN ('.implode(',', $users_id).')
            ');
        $stmt->execute();
        $users_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users_info;
    }

    public function addMember(string $id, string $teamId) {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.user SET team_id = ? WHERE id = ?
        ');
        $stmt->execute([
            $teamId,
            $id,
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function removeMember(string $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.user SET team_id = NULL WHERE id = ?
        ');
        $stmt->execute([
            $id,
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
}