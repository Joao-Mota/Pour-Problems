<?php
declare(strict_types=1);

class Department
{
    public int $id;
    public string $question;
    public string $answer;
    public int $user_id;

    public function __construct(int $id, string $question, string $answer, int $user_id)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->user_id = $user_id;
    }

    static function getDepartment(PDO $db, int $id): Department
    {
        $stmt = $db->prepare('SELECT * FROM Department WHERE id = ?');

        $stmt->execute(array($id));
        $department = $stmt->fetch();

        return new Department($department['id'], $department['question'], $department['answer'], $department['name']);
    }
}
?>