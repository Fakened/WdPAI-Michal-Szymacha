<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserTaskRepository.php';

class TaskController extends AppController {

    public function getDayTasks()
    {
        // $response = ["messege" => "success"];
        
        // echo json_encode($response);

        $date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
        $id = $_SESSION['id'];
        $test = new UserTaskRepository();
        $tasks = $test->getTasks($id, $date);
        if ($tasks === []) {
            $response = ["messege" => "empty"];
            echo json_encode($response);
            return;
        } else {
            $response = ["messege" => "success", "tasks" => $tasks];
            echo json_encode($response);
            return;
        }

    }
    
    public function addTask()
    {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $id = $_SESSION['id'];
        $task = new UserTaskRepository();
        $test =$task->addTask($id, $title, $date, $time, $priority, $description);
        if ($test) {
            $response = ["messege" => "empty"];
            echo json_encode($response);
            return;
        } else {
            $response = ["messege" => "success", "task" => $test];
            echo json_encode($response);
            return;
        }
    }

}