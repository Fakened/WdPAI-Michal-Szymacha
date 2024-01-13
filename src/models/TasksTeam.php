<?

class TaskTeam 
{
    private $team_id;
    private $task_id;


    public function __construct(int $team_id, int $task_id) {
        $this->team_id = $team_id;
        $this->task_id = $task_id;
    }

    public function getTeamId(): int {
        return $this->team_id;
    }

    public function getTaskId(): int {
        return $this->task_id;
    }

    public function setTeamId(int $team_id) {
        $this->team_id = $team_id;
    }

    public function setTaskId(int $task_id) {
        $this->task_id = $task_id;
    }
}