<?php
    declare(strict_types = 1);

    class Department {
        public int $id;
        public string $name;
        public int $user_id;

        public function __construct(int $id, string $name, int $user_id){
            $this->id = $id;
            $this->name = $name;
            $this->user_id = $user_id;
        }

        static function getChat(PDO $db, int $id): Department{
            $stmt = $db->prepare('
            Select *
            from Department
            where id = ?');
            $stmt->execute(array($id));
            $department = $stmt->fetch();

            return new Department($department['id'], $department['name'], $department['user_id']);
        }
    }
?>