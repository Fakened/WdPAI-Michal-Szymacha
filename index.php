<?php

require 'Routing.php';


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::get('mainview', 'DefaultController');
Router::get('user', 'DefaultController');
Router::post('getDayTasks', 'TaskController');
Router::post('addTask', 'TaskController');
Router::post('addTeamTask', 'TaskController');
Router::post('doneTask', 'TaskController');
Router::get('logout', 'SecurityController');
Router::post('editUserInfo', 'InfoController');
Router::get('getUserInfo', 'InfoController');
Router::post('changePassword', 'SecurityController');
Router::get('getYourTeam', 'TeamController');
Router::get('getUsersWithoutTeam', 'TeamController');
Router::post('addMember', 'TeamController');
Router::post('removeMember', 'TeamController');

Router::run($path);