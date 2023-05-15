<?php
    declare(strict_types = 1);

    class Ticket{
        public int $id;
        public string $subject;
        public string $description;
        public string $datetime;
        public string $department;
        public int $status_id;
        public array $files;


        public function __construct(int $id, string $subject, string $description, string $datetime, string $department, int $status_id, array $files = array()){
            $this->id = $id;
            $this->subject = $subject;
            $this->description = $description;
            $this->datetime = $datetime;
            $this->department = $department;
            $this->status_id = $status_id;
            $this->files = $files;
        }

        // maybe missing static function getArtistAlbums(PDO $db, int $id) : array
        static function getTicket(PDO $db, int $id): Ticket{
            $stmt = $db->prepare('SELECT * FROM Ticket WHERE id = ?');
            
            $stmt->execute(array($id));
            $ticket = $stmt->fetch();

            // get all files from Ticket_Files table for this ticket
            $stmt = $db->prepare('SELECT * FROM Ticket_Files WHERE ticket_id = ?');
            $stmt->execute(array($id));
            $files = $stmt->fetchAll();

            return new Ticket($ticket['id'], $ticket['subject'], $ticket['description'], $ticket['datetime'], $ticket['department'], $ticket['status_id'], $files);
        }
        
        static function getAllTickets(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket');
        
            $stmt->execute();
        
            $tickets = array();

            while ($ticket = $stmt->fetch()) {
                // get all files from Ticket_Files table for this ticket
                $stmt = $db->prepare('SELECT * FROM Ticket_Files WHERE ticket_id = ?');
                $stmt->execute(array($ticket['id']));
                $files = $stmt->fetchAll();

                $tickets[] = new Ticket(
                $ticket['id'],
                strval($ticket['subject']),
                strval($ticket['description']),
                strval($ticket['datetime']),
                strval($ticket['department']),
                $ticket['status_id'],
                $files
                );
            }     
            return $tickets;
        }

    //maybe missing function save(PDO $db)
    }
?>