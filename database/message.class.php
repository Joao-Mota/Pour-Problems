<?php
declare(strict_types=1);

class Message
{
    public int $id;
    public string $text;
    public string $datetime;
    public int $user_id;
    public int $ticket_id;
    public array $files;

    public function __construct(int $id, string $text, string $datetime, int $user_id, int $ticket_id, array $files = array())
    {
        $this->id = $id;
        $this->text = $text;
        $this->datetime = $datetime;
        $this->user_id = $user_id;
        $this->ticket_id = $ticket_id;
        $this->files = $files;
    }

    static function getMessage(PDO $db, int $id): Message
    {
        $stmt = $db->prepare('SELECT * FROM Message WHERE id = ?');

        $stmt->execute(array($id));
        $message = $stmt->fetch();

        // get all files from Message_Files table for this message
        $stmt = $db->prepare('SELECT * FROM Message_Files WHERE message_id = ?');
        $stmt->execute(array($id));
        $files = $stmt->fetchAll();

        return new Message($message['id'], $message['text'], $message['datetime'], $message['user_id'], $message['ticket_id'], $files);
    }

    static function getMessages_from_ticket(PDO $db, int $ticket_id): array
    {
        $stmt = $db->prepare('SELECT * FROM Message WHERE ticket_id = ?');
        $stmt->execute(array($ticket_id));

        $messages = array();

        while ($message = $stmt->fetch()) {

            // get all files from Message_Files table for this message
            $stmt = $db->prepare('SELECT * FROM Message_Files WHERE message_id = ?');
            $stmt->execute(array($message['id']));
            $files = $stmt->fetchAll();

            $messages[] = new Message(
                $message['id'],
                strval($message['text']),
                strval($message['datetime']),
                $message['user_id'],
                $message['ticket_id'],
                $files
            );
        }
        return $messages;
    }
}
?>