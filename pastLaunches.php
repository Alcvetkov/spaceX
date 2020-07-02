<?php
require_once 'layout/header.php';
require_once 'vendor/autoload.php';

use Launch\HTMLGenerator;
?>
    <div class="container" style="margin-top:30px">
        <?php
        $launchPage = new HTMLGenerator('past');
        echo $launchPage->getContent();
        ?>
    </div>
<?php
require_once 'layout/footer.php';