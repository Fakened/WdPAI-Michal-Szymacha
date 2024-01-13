<?

class Team
{
    private $id;
    private $users_id;
    private $name;

    public function __construct(int $id, int $users_id, string $name)
    {
        $this->id = $id;
        $this->users_id = $users_id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsersId(): int
    {
        return $this->users_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setUsersId(int $users_id)
    {
        $this->users_id = $users_id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    
}