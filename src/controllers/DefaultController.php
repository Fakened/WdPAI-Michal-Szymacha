<?php

require_once 'AppController.php';


class DefaultController extends AppController {

    public function index()
    {
        if (!isset($_SESSION['id'])) {
            $this->render('main');
            return;
        }
        $this->render('mainview');
    }

    

}