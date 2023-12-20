<?php

class User {
    private $id;
    private $is_admin;
    private $password;
    private $login;
    private $email;
    
    

    public function __construct(int $id, bool $is_admin, string $password, string $email) {
        $this->id = $id;
        $this->is_admin = $is_admin;
        $this->password = $password;
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setLogin(string $login) {
        $this->login = $login;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }


    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getIs_admin() {
        return $this->is_admin;
    }

    public function getLogin() {
        return $this->login;
    }

}