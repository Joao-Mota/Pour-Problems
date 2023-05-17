<?php
declare(strict_types=1);

class User
{
  public int $id;
  public string $fullname;
  public string $username;
  public string $email;
  public string $password;
  public int $role_id;
  public string $image_path;

  //image_path for default image
  public const DEFAULT_IMAGE_PATH = 'profile_placeholder.png';

  public function __construct(int $id, string $fullname, string $username, string $email, string $password, int $role_id, string $image_path = self::DEFAULT_IMAGE_PATH)
  {
    $this->id = $id;
    $this->fullname = $fullname;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->role_id = $role_id;
    $this->image_path = $image_path;
  }

  static function getUser(PDO $db, int $id): User
  {
    $stmt = $db->prepare('SELECT * FROM User WHERE id = ?');

    $stmt->execute(array($id));
    $user = $stmt->fetch();

    return new User(
      $user['id'],
      $user['fullname'],
      $user['username'],
      $user['email'],
      $user['password'],
      $user['role_id'],
      $user['image_path']
    );
  }

  static function getUsers(PDO $db): array
  {
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
        $user['role_id'],
        $user['image_path']
      );
    }

    return $users;
  }

  static function getAgents(PDO $db, $role_id): array
  {
    $stmt = $db->prepare('SELECT * FROM User WHERE role_id = ?');
    $stmt->execute(array($role_id));

    $users = array();
    while ($user = $stmt->fetch()) {
      $users[] = new User(
        $user['id'],
        $user['fullname'],
        $user['username'],
        $user['email'],
        $user['password'],
        $user['role_id'],
        $user['image_path']
      );
    }

    return $users;
  }

  static function getUser_from_username(PDO $db, string $username): ?User
  {
    $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');

    $stmt->execute(array($username));

    $user = $stmt->fetch();

    return new User(
      intval($user['id']),
      $user['fullname'],
      $user['username'],
      $user['email'],
      $user['password'],
      intval($user['role_id']),
      $user['image_path']
    );
  }

  static function getUserWithPassword(PDO $db, string $email, string $password): ?User
  {
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
        $user['image_path']
      );
    } else
      return null;
  }

  function save($db) {
    $stmt = $db->prepare('UPDATE User SET role_id = ? WHERE id = ?');

    $stmt->execute(array($this->role_id, $this->id));
  }

  /* Update User with out changing is role */
  public function updateUserProfile(PDO $db, string $fullname, string $username, string $email, string $password,string  $image_path)
  {
    $stmt = $db->prepare('UPDATE User SET fullname = ?, username = ?, email = ?, password = ?, image_path = ? WHERE id = ?');

    $stmt->execute(array($fullname, $username, $email, $password, $image_path, $this->id));
  }
}
?>