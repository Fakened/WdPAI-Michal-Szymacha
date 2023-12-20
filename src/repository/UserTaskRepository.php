<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserTaskRepository extends Repository {
    public function getTasks(int $id, string $date): array
    {
        $stmt = $this->database->connect()->prepare('
        select * from "task", "tasks_user" where "tasks_user".user_id = ? and "tasks_user".task_id = "task".id and "task".date = ?
        ');
        $stmt->execute([
            $id,
            $date,
        ]);

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

    public function addTask(int $id, string $name, string $date, string $time, int $priority, string $description)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.task ( name, date, time, prio, description, status)
            VALUES (?, ?, ?, ?, ?, false) RETURNING *
        ');

        $stmt->execute([
            $name,
            $date,
            $time,
            $priority,
            $description,
        ]);

        if ($stmt->fetchAll(PDO::FETCH_ASSOC) == false) {
            return null;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT id FROM public.task WHERE name = ? and description = ? and date = ?
        ');

        $stmt->execute([
            $name,
            $description,
            $date,
        ]);

        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($task == false) {
            return null;
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.tasks_user ( user_id, task_id)
            VALUES (?, ?) RETURNING *
        ');

        $stmt->execute([
            $id,
            $task['id'],
        ]);

        if ($stmt->fetchAll(PDO::FETCH_ASSOC) == false) {
            return null;
        } 
        
        return true;
        
        
    }

}