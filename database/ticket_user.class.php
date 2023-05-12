<?php
    declare(strict_types = 1);

    class Ticket_User{
        public int $client_id;
        public int $agent_id;
        public int $ticket_id;

        public function __construct(int $client_id, int $agent_id, int $ticket_id){
            $this->client_id = $client_id;
            $this->agent_id = $agent_id;
            $this->ticket_id = $ticket_id;
        }

        // maybe missing static function getArtistAlbums(PDO $db, int $id) : array

        static function getTickets_from_User(PDO $db, int $client_id) : array {
            $stmt = $db->prepare('SELECT * FROM Ticket_User WHERE client_id = ?');
        
            $stmt->execute(array($client_id));
        
            $tickets = [];

            while ($ticket = $stmt->fetch()) {
                $tickets[] = new Ticket_User(
                intval($ticket['client_id']),
                intval($ticket['agent_id']),
                intval($ticket['ticket_id'])
                );
            }     
            return $tickets;
        }
        

    //maybe missing function save(PDO $db)
    }
?>