<?

class TasksUser {
    private $user_id;
    private $task_id;

    public function __construct(int $user_id, int $task_id) {
        $this->user_id = $user_id;
        $this->task_id = $task_id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function getTaskId(): int {
        return $this->task_id;
    }
}