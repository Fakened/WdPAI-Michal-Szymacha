<?php

require 'Routing.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::get('mainview', 'DefaultController');
Router::post('getDayTasks', 'TaskController');
Router::post('addTask', 'TaskController');

Router::run($path);