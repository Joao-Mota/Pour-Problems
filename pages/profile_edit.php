<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: ../pages/login.php');
}

require_once(__DIR__ . '/../database/connection.db.php');

require_once(__DIR__ . '/../temp/common.tpl.php');

require_once(__DIR__ . '/../database/user.class.php');

$db = getDatabaseConnection();

$user = User::getUser($db, $session->getId());

drawHeader($session);
?>

<div class="heading" style="background:url(/sources/heading_bg/signup-slide-bg.jpg) no-repeat;">
    <h1>Profile Edit</h1>
</div>

<section class="profile-edit">

    <h1 class="profile-edit-title">Edit your profile</h1>

    <form action="/actions/action_profile_edit.php" method="post" enctype="multipart/form-data">
        <div class="input-box">
            <label for="fullname">Name</label>
            <input type="text" name="fullname" id="fullname" placeholder="Full Name" value="<?= $user->fullname ?>">
        </div>
        <div class="input-box">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" value="<?= $user->username ?>">
        </div>
        <div class="input-box">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" value="<?= $user->email ?>">
        </div>
        <div class="input-box">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="input-box">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
        </div>
        <div class="input-box">
            <label for="file">Profile Image</label>
            <input type="file" name="file" id="file" class="inputfile" multiple pattern=".*\.(jpe?g|png)$"
                accept=".jpg,.jpeg,.png">
        </div>

        <input type="submit" value="Save Changes" class="btn" name="Save">

    </form>
</section>

<?= drawFooter($session); ?>