<?php ob_start(); ?>
    <h1>Article</h1>
<?php
    $title = ob_get_clean();
    require 'template.php';
?>
