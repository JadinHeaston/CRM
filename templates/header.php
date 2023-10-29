<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>CRM</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="/assets/favicon.svg" type="image/svg+xml">
	<link rel="stylesheet" href="/css/styles.css">
	<script src="/js/scripts.js"></script>
	<script src="/vendors/htmx.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="module" src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.esm.js"></script>
	<script nomodule src="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/duet.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@duetds/date-picker@1.4.0/dist/duet/themes/default.css" />
</head>

<body>
	<header>
		<h1>Change Request Manager</h1>
		<?php echo file_get_contents(__DIR__ . '/nav.html'); ?>
	</header>