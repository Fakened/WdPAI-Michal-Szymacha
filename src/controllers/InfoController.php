<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserInfoRepository.php';

class InfoController extends AppController {

    public function editUserInfo() {
        if (!isset($_SESSION['id'])) {
            echo json_encode(["message" => "ID sesji nie istnieje"]);
            return;
        }
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = $_SESSION['id'];
        $user = new UserInfoRepository();
        $userInfo =$user->editUserInfo($id, $name, $surname, $phone);
        echo $userInfo;

    }

    public function getUserInfo() {
        if (!isset($_SESSION['id'])) {
            echo json_encode(["message" => "ID sesji nie istnieje"]);
            return;
        }
    
        $id = $_SESSION['id'];
        $userRepo = new UserInfoRepository();
        $userInfo = $userRepo->findUserInfoById($id);
    
        if (empty($userInfo)) {
            echo json_encode(["message" => "empty"]);
        } else {
            echo json_encode(["message" => "success", "user" => $userInfo]);
        }
    }
}