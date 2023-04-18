<?php
declare(strict_types = 1);

class Ticket{
    public int $id;
    public string $subject;
    public string $datetime;
    public int $chat_id;
    public int $status_id;
    public int $client_id;
    public int $officer_id;


public function __construct(int $id, string $subject, string $datetime, int $chat_id, int $status_id, int $client_id, int $officer_id){
    $this->id = $id;
    $this->subject = $subject;
    $this->datetime = $datetime;
    $this->chat_id = $chat_id;
    $this->status_id = $status_id;
    $this->client_id = $client_id;
    $this->officer_id = $officer_id;
}

// maybe missing static function getArtistAlbums(PDO $db, int $id) : array
static function getTicket(PDO $db, int $id): Ticket{
    $stmt = $db->prepare('
    Select id, subject, datetime, chat_id, status_id, client_id, officer_id
    from Ticket
    where id = ?');
    $stmt->execute(array($id));
    $ticket = $stmt->fetch();

    return new Ticket($ticket['id'], $ticket['subject'], $ticket['datetime'], $ticket['chat_id'], $ticket['status_id'], $ticket['client_id'], $ticket['officer_id']);
}

//maybe missing function save(PDO $db)
}
?>