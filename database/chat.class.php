<?php
    declare(strict_types = 1);

    class Chat {
        public int $id;
        public int $ticket_id;

        public function __construct(int $id, int $ticket_id){
            $this->id = $id;
            $this->ticket_id = $ticket_id;
        }

        static function getChat(PDO $db, int $id): Chat{
            $stmt = $db->prepare('
            Select id, ticket_id
            from Chat
            where id = ?');
            $stmt->execute(array($id));
            $chat = $stmt->fetch();

            return new Chat($chat['id'], $chat['ticket_id']);
        }
    }
?>