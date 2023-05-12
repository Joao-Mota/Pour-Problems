<?php
    declare(strict_types = 1);

    class Department {
        public int $id;
        public string $name;

        public function __construct(int $id, string $name){
            $this->id = $id;
            $this->name = $name;
        }

        static function getDepartment(PDO $db, int $id): Department{
            $stmt = $db->prepare('SELECT * FROM Department WHERE id = ?');

            $stmt->execute(array($id));
            $department = $stmt->fetch();

            return new Department($department['id'], $department['name']);
        }
    }
?>