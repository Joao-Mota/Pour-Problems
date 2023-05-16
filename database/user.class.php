<?php 
    declare(strict_types = 1);

    class User {
        public int $id;
        public string $fullname;
        public string $username;
        public string $email;
        public string $password;
        public int $role_id;

        public function __construct(int $id, string $fullname, string $username, string $email, string $password, int $role_id)
    {
        $this->id = $id;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('SELECT * FROM User WHERE id = ?');

      $stmt->execute(array($id));
      $user = $stmt->fetch();

      return new User(
        $user['id'],
        $user['fullname'],
        $user['username'],
        $user['email'],
        $user['password'],
        $user['role_id']
      );
    }

    static function getUsers(PDO $db) : array {
      $stmt = $db->prepare('SELECT * FROM User');
      $stmt->execute();

      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          $user['id'],
          $user['fullname'],
          $user['username'],
          $user['email'],
          $user['password'],
          $user['role_id']
        );
      }
  
      return $users;
    }

    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
      $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');

      $stmt->execute(array($email));

      $user = $stmt->fetch();
  
      if ($user !== false && password_verify($password, $user['password'])) {
        return new User(
          intval($user['id']),
          $user['fullname'],
          $user['username'],
          $user['email'],
          $user['password'],
          intval($user['role_id']),
        );
      } else return null;
    }
    function save($db) {
      $stmt = $db->prepare('UPDATE User SET role_id = ? WHERE id = ?');

      $stmt->execute(array($this->role_id, $this->id));
    }
  }
?>