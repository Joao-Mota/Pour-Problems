<?php
    declare(strict_types = 1);

    class Message {
        public int $id;
        public string $text;
        public string $datetime;
        public int $chat_id;
        public int $user_id;

        public function __construct(int $id, string $text, string $datetime, int $chat_id, int $user_id){
            $this->id = $id;
            $this->text = $text;
            $this->datetime = $datetime;
            $this->chat_id = $chat_id;
            $this->user_id = $user_id;
        }

        static function getMessage(PDO $db, int $id): Message{
            $stmt = $db->prepare('
            Select *
            from Message
            where id = ?');
            $stmt->execute(array($id));
            $message = $stmt->fetch();

            return new Message($message['id'], $message['text'], $message['datetime'], $message['chat_id'], $message['user_id']);
        }
    }
?>