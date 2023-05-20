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

foreach($faqs as $faq) { ?>
    <h2><?=$faq->question?></h2>
    <p><?=$faq->answer?></p>
<?php } ?>


?>






<?php
drawFooter($session);
?>