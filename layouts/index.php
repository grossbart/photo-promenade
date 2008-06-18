<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title><?php echo $params['title']?></title>
	
</head>

<body>

<h1><?php echo $params['title']?></h1>

<p><?php echo $params['subtitle']?></p>

<h2>Albums</h2>

<ul>
<?php
  foreach(get_folders($params['album_root']) as $album) {
    echo '<li>'.l($album, $album).'</li>';
  }
?>
</ul>


</body>
</html>
