<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) {
    die(header('Location: /'));
}

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/department.class.php');

require_once(__DIR__ . '/../database/user.class.php');

$db = getDatabaseConnection();

$user_id = $session->getId();


$user = User::getUser($db, $user_id);



function save_in_uploads_profile($temp_name, $name)
{
    $uploads_dir = __DIR__ . '/../uploads/profiles/';
    $extension = explode('.', $name);
    $image_name = uniqid() . '.' . $extension[count($extension) - 1];
    move_uploaded_file($temp_name, $uploads_dir . $image_name);

    return $image_name;
}



if ($user) {

    $user->fullname = $_POST['fullname'];
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if (isset($_FILES['image_path'])) {
        $file_name = $_FILES['image_path']['name'];
        $file_size = $_FILES['image_path']['size'];
        $temp_name = $_FILES['image_path']['tmp_name'];
        
        if (isset($file_name) && $file_size > 0 && $file_size < 1000000) {
            $user->image_path = save_in_uploads_profile($temp_name, $file_name);
        }
    }

    $user->updateUser($db);

    $session->setId($user->id);

    $session->addMessage('success', 'Profile updated successfully!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $session->addMessage('error', 'User not found!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}




?>