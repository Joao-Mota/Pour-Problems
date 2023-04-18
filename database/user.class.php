<?php 
    declare(strict_types = 1);

    class User {
        public int $id;
        public string $name;
        public string $username;
        public string $email;
        public string $password;
        public int $role_id;
        public int $department_id;
    }

    public function __construct(int $id, string $name, string $username, string $email, string $password, int $role_id, int $department_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->department_id = $department_id;
    }

    static function getUser(PDO $db, int $id) : User {
        $stmt = $db->prepare('
            SELECT id, name, username, email, password, role_id, department_id
            FROM User 
            WHERE id = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();

      return new User(
        $user['id'],
        $user['name'],
        $user['username'],
        $user['email'],
        $user['password'],
        $user['role_id'],
        $user['department_id']
      );
    }

    static function getUsers(PDO$db, int $count) : array {
        $stmt = $db->prepare('SELECT id, name, username, email, password, role_id, department_id FROM User LIMIT ?');
        $stmt->execute(array($count));

        $users = array();
        while ($user = $stmt->fetch()) {
          $users[] = new User(
            $user['id'],
            $user['name'],
            $user['username'],
            $user['email'],
            $user['password'],
            $user['role_id'],
            $user['department_id']
          );
        }
    
        return $artists;
    }
?>