<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<!-- ——————————————————————————————————————————————————————————————————— TITLE -->
	<title><?php echo $params['title']?> <?php echo $params['controller']?></title>
	<!-- ——————————————————————————————————————————————————————————————————— META -->
	<meta http-equiv="Content-Type"	content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language"	content="de-de" />
	<meta name="Robots"	content="ALL" />
	<meta name="Keywords"	content="_KEYWORDS_" />
	<meta name="Description"	content="_DESCRIPTION_" />
	<meta name="Author"	content="<?php echo $params['author']?>" />
	<meta name="Copyright"	content="<?php //echo date(); ?> " />
	<!-- ——————————————————————————————————————————————————————————————————— FAVICON -->
	<link rel="shortcut icon"	href="img/favicon.ico"	type="image/x-icon" />
	<link rel="icon"	href="img/favicon.ico"	type="image/x-icon" />
	<!-- ——————————————————————————————————————————————————————————————————— CSS -->
	<link rel="stylesheet"	href="css/base.css"	type="text/css"	media="screen" />
	<!-- ——————————————————————————————————————————————————————————————————— JS -->
  <?php yield('script'); ?>
</head>
<!-- ——————————————————————————————————————————————————————————————————— BODY -->
<body>
  <div id="container" class="<?php echo $params['layout'] ?>">
    <?php yield('content'); ?>
  </div>
</body>
</html>