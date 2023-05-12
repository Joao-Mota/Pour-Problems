<?php
    declare(strict_types = 1);

    class Status {
        public int $id;
        public string $stat;

        public function __construct(int $id, string $stat){
            $this->id = $id;
            $this->stat = $stat;
        }

        static function getStatus(PDO $db, int $id): Status{
            $stmt = $db->prepare('SELECT id, stat FROM Status WHERE id = ?');

            $stmt->execute(array($id));
            $status = $stmt->fetch();

            return new Status($status['id'], $status['stat']);
        }
    }
?>