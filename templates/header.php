<?php
if (isHTMX())
	return;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>CRM</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="<?php echo APP_ROOT; ?>assets/favicon.svg" type="image/svg+xml">
	<link rel="stylesheet" href="<?php echo APP_ROOT; ?>css/styles.css">
	<script src="<?php echo APP_ROOT; ?>js/scripts.js"></script>
	<script src="<?php echo APP_ROOT; ?>vendors/htmx.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="module" src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.esm.js"></script>
	<script nomodule src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/themes/default.css" />
</head>

<body>
	<header>
		<h1>Change Request Manager</h1>
		<?php require_once(__DIR__ . '/nav.php'); ?>
	</header>