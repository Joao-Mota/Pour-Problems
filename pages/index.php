<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');


require_once(__DIR__ . '/../temp/common.tpl.php');

require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();

drawHeader($session);

try {
    $password = password_hash('admin', PASSWORD_DEFAULT);
    $stmt = $db->prepare('INSERT INTO User (fullname, username, email, password, role_id, image_path) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array('admin', 'admin', 'admin@gmail.com', $password, 1, User::DEFAULT_IMAGE_PATH));

    $password = password_hash('agent1', PASSWORD_DEFAULT);
    $stmt = $db->prepare('INSERT INTO User (fullname, username, email, password, role_id, image_path) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array('agent', 'agent1', 'agent1@gmail.com', $password, 2, User::DEFAULT_IMAGE_PATH));

    $stmt = $db->prepare('INSERT INTO FAQ (question, answer, user_id) VALUES (?, ?, ?)');
    $stmt->execute(array('Pergunta OP', 'Resposta para tudo!', 2));
    $stmt->execute(array('Pergunta OP 2', 'Nao sabes mais!', 2));
    $stmt->execute(array('Pergunta OP 3', 'Estudasses!', 2));
} catch (PDOException $e) {
}
?>

<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background: url(/sources/heading_bg/about-slide-bg.jpg) no-repeat;">
                <div class="content">
                    <span>Wine Cellar</span>
                    <h3>Porto</h3>
                    <p>One of the best wine producers globally!</p>
                    <a href="/pages/about.php" class="btn">More Info</a>
                </div>
            </div>

            <div class="swiper-slide slide"
                style="background: url(/sources/heading_bg/tickets-slide-bg.jpg) no-repeat;">
                <div class="content">
                    <span>Support</span>
                    <h3>Pour</h3>
                    <h3>Problems</h3>
                    <p>We answer every question you may have!</p>
                    <a href="/pages/mytickets.php" class="btn">Tickets!</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background: url(/sources/heading_bg/signup-slide-bg.jpg) no-repeat;">
                <div class="content">
                    <h3>Join us!</h3>
                    <a href="/pages/signup.php" class="btn">Sign Up!</a>
                </div>
            </div>


        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>
</section>

<section class="home-about">
    <div class="image">
        <img src="../sources/heading_bg/home-about-us.jpg" alt="">
    </div>

    <div class="content">
        <h3>About Us</h3>
        <p>
            PourProblems is your solution to all wine-related issues.
            With our own wine cellar in Porto and years of experience in the industry, our team of experts is dedicated
            to resolving any wine problem you may encounter.
            Whether it's a stubborn cork or a wine pairing conundrum, we provide personalized solutions to ensure that
            you can enjoy your wine without any hassle.
            At PourProblems, we pride ourselves on our attention to detail and commitment to customer satisfaction, so
            you can trust us to deliver exceptional service every time.
        </p>
        <a href="/pages/about.php" class="btn">read more!</a>
    </div>
</section>

<?php
drawFooter($session);
?>