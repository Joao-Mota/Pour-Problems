<?php
declare(strict_types=1);

class User_Department
{
    public int $user_id;
    public int $department_id;

    public function __construct(int $user_id, int $department_id)
    {
        $this->user_id = $user_id;
        $this->department_id = $department_id;
    }

    // maybe missing static function getArtistAlbums(PDO $db, int $id) : array

    static function getAgents_from_department(PDO $db, int $department_id): array
    {
        $stmt = $db->prepare('SELECT * FROM User_Department WHERE department_id = ?');

        $stmt->execute(array($department_id));

        $users = [];

        while ($user = $stmt->fetch()) {
            $users[] = new User_Department(
                intval($user['user_id']),
                intval($user['department_id'])
            );
        }
        return $users;
    }

    static function getDepartmentsFromUser(PDO $db, int $user_id): array
    {
        $stmt = $db->prepare('SELECT * FROM User_Department WHERE user_id = ?');

        $stmt->execute(array($user_id));

        $departments = [];

        while ($department = $stmt->fetch()) {
            $departments[] = new User_Department(
                intval($department['user_id']),
                intval($department['department_id'])
            );
        }
        return $departments;
    }

}
?>