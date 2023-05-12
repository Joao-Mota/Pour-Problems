<?php
    declare(strict_types = 1);

    class Message {
        public int $id;
        public string $text;
        public string $datetime;
        public int $user_id;
        public int $ticket_id;

        public function __construct(int $id, string $text, string $datetime, int $user_id, int $ticket_id){
            $this->id = $id;
            $this->text = $text;
            $this->datetime = $datetime;
            $this->user_id = $user_id;
            $this->ticket_id = $ticket_id;
        }

        static function getMessage(PDO $db, int $id): Message{
            $stmt = $db->prepare('SELECT * FROM Message WHERE id = ?');

            $stmt->execute(array($id));
            $message = $stmt->fetch();

            return new Message($message['id'], $message['text'], $message['datetime'], $message['user_id'], $message['ticket_id']);
        }
    }
?>