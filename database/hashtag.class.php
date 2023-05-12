<?php
    declare(strict_types = 1);

    class Hashtag {
        public int $id;
        public string $name;
        public int $ticket_id;

        public function __construct(int $id, string $name, int $ticket_id){
            $this->id = $id;
            $this->name = $name;
            $this->ticket_id = $ticket_id;
        }

        static function getChat(PDO $db, int $id): Hashtag{
            $stmt = $db->prepare('SELECT * FROM Hashtag WHERE id = ?');

            $stmt->execute(array($id));
            $chat = $stmt->fetch();

            return new Hashtag($chat['id'], $chat['name'], $chat['ticket_id']);
        }
    }
?>