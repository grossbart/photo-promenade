<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title><?php echo $params['controller']?> – <?php echo $params['title']?></title>
	
</head>

<body>

  <?php echo l("Home", ""); ?>

  <h1><?php echo $params['controller']; ?></h1>

  <ul>
  <?php
    $photos = get_files($params['album_path']);
    foreach ($photos as $photo) {
      $thumb = '<img src="'.$params['thumb_path'].$photo.'" alt="" />';
      echo '<li><a href="'.$params['big_path'] . $photo.'">'.$thumb.'</a></li>';
    }
  ?>
  </ul>
</body>
</html>

