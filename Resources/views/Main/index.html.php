<?php
/** @var $view View */
echo get_class($view);
?>

<?php $view->extend('::base.html.php') ?>

You shouldn't see this page. This is for route <?php //echo $view ?>
