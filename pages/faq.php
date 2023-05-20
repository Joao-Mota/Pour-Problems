<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../temp/common.tpl.php');
require_once(__DIR__ . '/../database/faq.class.php');


$db = getDatabaseConnection();

drawHeader($session);

$faqs = FAQ::getFAQs($db);
?>

<section class="home-faq">
    <h2 class="title">FAQ's</h2>

    <?php if($session->isAgent() || $session->isAdmin()) { ?>
        <section class="new-department">
            <form action="../actions/action_add_faq.php" method="post" class="delete">
                <input type="text" name="question" placeholder="insert new question">
                <input type="text" name="answer" placeholder="insert new answer">
                <input type="hidden" name="agent_id" value="<?=$session->getID()?>">
                <button type="submit" name="add" value="add"><i class="fas fa-arrow-right"></i></button>
            </form>
        </section>
    <?php } ?>

    <?php foreach($faqs as $faq) { ?>
        <div class="faq">
            <div class="question">
                <h3><?=$faq->question?></h3>

                <span class="icon"><i class="fas fa-sort-down"></i></span>

            </div>

            <div class="answer">
                <p><?=$faq->answer?></p>
            </div>

            <?php if($session->isAgent() || $session->isAdmin()) { ?>
                <form action="../actions/action_delete_faq.php" method="post" class="delete">
                    <input type="hidden" name="faq_id" value="<?=$faq->id?>">
                    <input type="submit" value="Delete">
                </form>

            <?php } ?>

        </div>

    <?php } ?>

</section>


<?php
drawFooter($session);
?>