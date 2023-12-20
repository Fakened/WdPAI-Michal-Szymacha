<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class SecurityController extends AppController {

    public function login()
    {
        $userRepository = new UserRepository();
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $user = $userRepository->getUser($email);
        if (!$user) {
            $this->render('login', ['messages' => ['User with this email not exist!']]);
            return;
        }
        if ($user->getEmail() !== $email) {
            $this->render('login', ['messages' => ['User with this email not exist!']]);
            return;
        }

        if (password_verify($password, $user->getPassword())) {
            $_SESSION["email"] = $user->getEmail();
            $_SESSION["id"] = $user->getId();
            if ($user->getIs_admin() === true) {
                $_SESSION["is_admin"] = "true";
            } else {
                $_SESSION["is_admin"] = "false";
            }
            return $this->render('mainview');
        } else {
            $this->render('login', ['messages' => ['Wrong password!']]);
        }
        
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }
        $email = $_POST['email'];
        $email = strtolower($email);
        $password = $_POST['pass'];
        if ($email === '' || $password === '') {
            $this->render('register', ['messages' => ['You have to fill all fields!']]);
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->render('register', ['messages' => ['Email is not valid!']]);
            return;
        }
        if (strlen($password) < 8) {
            $this->render('register', ['messages' => ['Password is too short!']]);
            return;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $this->render('register', ['messages' => ['Password must contain at least one capital letter!']]);
            return;
        }
        if (!preg_match('/[0-9]/', $password)) {
            $this->render('register', ['messages' => ['Password must contain at least one number!']]);
            return;
        }
        $userRepository = new UserRepository();
        $user = $userRepository->getUser($email);
        if ($user) {
            $this->render('register', ['messages' => ['User with this email already exist!']]);
            return;
        }
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $userRepository->addUser($email, $hash);
        $this->render('login', ['messages' => ['You have been successfully registered!']]);

    }


}