<?

class Task {
    private $id;
    private $name;
    private $date;
    private $time;
    private $prio;
    private $description;
    private $status;

    public function __construct(int $id, string $name, string $date, string $time, string $prio, string $description, string $status) {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->time = $time;
        $this->prio = $prio;
        $this->description = $description;
        $this->status = $status;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function getTime(): string {
        return $this->time;
    }

    public function getPrio(): string {
        return $this->prio;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setDate(string $date) {
        $this->date = $date;
    }

    public function setTime(string $time) {
        $this->time = $time;
    }

    public function setPrio(string $prio) {
        $this->prio = $prio;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

}