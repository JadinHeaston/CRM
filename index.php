<?php
require_once(__DIR__ . '/includes/loader.php');



require_once(__DIR__ . '/templates/header.php');
?>

<main>

	<?php echo '<span id="processing-time-full">' . $GLOBALS['timer']['full']->stop() . '</span>'; ?>
</main>

<?php require_once(__DIR__ . '/templates/footer.php'); ?>