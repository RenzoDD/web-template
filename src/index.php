<?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Home page
 */

require __DIR__ . "/php/utilities.php";
$codigo_pagina = "/home";
?>

<!doctype html>
<html lang="en" class="h-100" prefix="og: http://ogp.me/ns#">

<head>
	<?php
	echo MetaHeaders("Title", "Slogan");
	echo GoogleAnalytics($codigo_pagina);
	?>

	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/bootstrap-icons.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">

	<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />
	<title>Web Template</title>
</head>

<body class="d-flex flex-column h-100">
	<?php require __DIR__ . "/php/parts/page/header.php"; ?>

	<main class="container my-3">
		<h1><?php echo Icon("globe"); ?> Hello, world!</h1>
		<p> I'm using <?php echo Icon("bootstrap"); ?> <b>bootstrap</b></p>
		<?php require __DIR__ . "/php/parts/graphs/bars.php"; ?>
	</main>

	<?php require __DIR__ . "/php/parts/page/footer.php"; ?>

	<?php require __DIR__ . "/php/parts/modal/regular.php"; ?>
	<?php require __DIR__ . "/php/parts/modal/static.php"; ?>

	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/main.js"></script>
</body>

</html>