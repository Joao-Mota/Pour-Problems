<?php
    declare(strict_types = 1);

    class Ticket{
        public int $id;
        public string $subject;
        public string $datetime;
        public int $status_id;


        public function __construct(int $id, string $subject, string $datetime, int $status_id){
            $this->id = $id;
            $this->subject = $subject;
            $this->datetime = $datetime;
            $this->status_id = $status_id;
        }

        // maybe missing static function getArtistAlbums(PDO $db, int $id) : array
        static function getTicket(PDO $db, int $id): Ticket{
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE id = ?');
            
            $stmt->execute(array($id));
            $ticket = $stmt->fetch();

            return new Ticket($ticket['id'], $ticket['subject'], $ticket['datetime'], $ticket['status_id']);
        }
        
        static function getAllTickets(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket');
        
            $stmt->execute();
        
            $tickets = array();

            while ($ticket = $stmt->fetch()) {
                $tickets[] = new Ticket(
                $ticket['id'],
                strval($ticket['subject']),
                strval($ticket['datetime']),
                $ticket['status_id']
                );
            }     
            return $tickets;
        }

    //maybe missing function save(PDO $db)
    }
?>