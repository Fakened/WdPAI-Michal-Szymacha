<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/TeamRepository.php';

class TeamController extends AppController {
    
        public function getYourTeam() {
            if (!isset($_SESSION['id'])) {
                echo json_encode(["message" => "ID sesji nie istnieje"]);
                return;
            }

            $teamRepository = new TeamRepository();
            $team = $teamRepository->getYourTeam();
            echo json_encode(['team' => $team] + ['message' => 'success']);
        }

        public function getUsersWithoutTeam() {
            if (!isset($_SESSION['id'])) {
                echo json_encode(["message" => "ID sesji nie istnieje"]);
                return;
            }
            if (!isset($_SESSION['is_admin'])) {
                echo json_encode(["message" => "Nie jesteś adminem"]);
                return;
            }


            $teamRepository = new TeamRepository();
            $users = $teamRepository->getUsersWithoutTeam();
            echo json_encode(['users' => $users] + ['message' => 'success']);
        }

        public function addMember() {
            if (!isset($_SESSION['id'])) {
                echo json_encode(["message" => "ID sesji nie istnieje"]);
                return;
            }
            if (!isset($_SESSION['is_admin'])) {
                echo json_encode(["message" => "Nie jesteś adminem"]);
                return;
            }
            $id = $_POST['id'];
            $teamId = $_SESSION['team_id'];
            $teamRepository = new TeamRepository();
            $resoult = $teamRepository->addMember($id, $teamId);
            if ($resoult == false) {
                echo json_encode(['message' => 'error']);
                return;
            }
            echo json_encode(['message' => 'success']);
        }

        public function removeMember() {
            if (!isset($_SESSION['id'])) {
                echo json_encode(["message" => "ID sesji nie istnieje"]);
                return;
            }
            if (!isset($_SESSION['is_admin'])) {
                echo json_encode(["message" => "Nie jesteś adminem"]);
                return;
            }
            $id = $_POST['id'];
            $teamRepository = new TeamRepository();
            $resoult = $teamRepository->removeMember($id);
            if ($resoult == false) {
                echo json_encode(['message' => 'error']);
                return;
            }
            echo json_encode(['message' => 'success']);
        }
}

