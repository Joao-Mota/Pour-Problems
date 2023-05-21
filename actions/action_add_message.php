<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/message.class.php');

$db = getDatabaseConnection();

$add_message = true;

if (empty($_POST['message'])) {
  $session->addFieldError('message', 'Message is required!');
  $add_message = false;
}

function save_in_uploadss($temp_name, $name)
{
  $UPLOADS_DIR = __DIR__ . '/../uploads/tickets/';

  // get file extension
  $ext = explode('.', $name);

  // save in uploads folder
  $filename = uniqid() . '.' . $ext[count($ext) - 1];

  // move file to uploads folder
  move_uploaded_file($temp_name, $UPLOADS_DIR . $filename);

  return $filename;
}

$filenames = array();

$files = array_filter($_FILES['file']['name']);

// check if form has a files attached and save all files in uploads folder
if (!empty($files)) {
  // iterate over all files
  for ($i = 0; $i < count($files); $i++) {
    $file_name = $_FILES['file']['name'][$i];
    $file_size = $_FILES['file']['size'][$i];
    $temp_name = $_FILES['file']['tmp_name'][$i];

    // check if file was uploaded and if it's size is less than 1MB
    if (isset($file_name) && $file_size > 0 && $file_size < 1000000) {
      // save the file in uploads folder and push the filename to the array of filenames
      $new_filename = save_in_uploadss($temp_name, $file_name);
      array_push($filenames, $new_filename);
    }
  }
}

if ($add_message) {

  $text = strval($_POST['message']);
  $ticket_id = strval($_POST['ticket_id']);
  $user_id = strval($_POST['user_id']);
  $datetime = $_POST['datetime'];
  $url_id = strval($_POST['id']);

  /*
    if (isset($_POST['faq_answer'])) {
      $faqAnswer = strval($_POST['faq_answer']);
      if (!empty($faqAnswer)) {
        $text = $faqAnswer;
      }
    }
  */


  $update = strval($datetime) . ' - Message was added to ticket';
  $new_message_id = null;

  try {
    $stmt = $db->prepare('INSERT INTO Message (text, datetime, user_id, ticket_id) VALUES (?, ?, ?, ?)');
    $stmt->execute(array($text, $datetime, $user_id, $ticket_id));
    $new_message_id = $db->lastInsertId();
    $session->addMessage('success', 'Message created successfully!');
  } catch (PDOException $e) {
    $session->addMessage('error', 'Error creating message!');
  }

  try {
    $stmt = $db->prepare('INSERT INTO Ticket_History (updates, ticket_id) VALUES (?, ?)');
    $stmt->execute(array($update, $ticket_id));
    $session->addMessage('success', 'Ticket_history updated successfully!');
  } catch (PDOException $e) {
    $session->addMessage('error', 'Error updating ticket!');
  }

  try {
    foreach ($filenames as $filename) {
      $stmt = $db->prepare('INSERT INTO Message_Files (file_path, user_id, message_id) VALUES (?, ?, ?)');
      $stmt->execute(array($filename, $user_id, $new_message_id));
    }
    $session->addMessage('success', 'File added successfully!');
  } catch (PDOException $e) {
    $session->addMessage('error', 'Error adding file!');
  }


  header('Location: ../pages/ticket.php?id=' . $url_id);
} else {
  header('Location: ../pages/ticket.php?id=' . $url_id);
}
?>