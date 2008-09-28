<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<rss version="2.0" xmlns:apple-wallpapers="http://www.apple.com/ilife/wallpapers">
	<channel>
		<title><?php if ($params['rss']) echo str_replace("%20"," ",$params['rss']); else echo $_SERVER['HTTP_HOST']; ?></title>
		<link><?php echo 'http://'. $_SERVER['HTTP_HOST'].BASE_URL.'index.php?q='.str_replace(" ","%20",$params['rss'])?></link>
		<description><?php echo 'http://'. $_SERVER['HTTP_HOST'].BASE_URL?></description>
		<?php
			$last_modified = filemtime(ALBUMS_ROOT . '/'); 
			$pubdate = '<pubDate>'. date("D, d M Y H:i:s T", $last_modified) . '</pubDate>';
			$lbuilddate = '<lastBuildDate>'. date("D, d M Y H:i:s T") . '</lastBuildDate>';
			echo $pubdate;
			echo $lbuilddate;
		?>

		<generator>iPhoto [iLife Publication Framework] (6.0)</generator>
		<apple-wallpapers:feedVersion>0.9</apple-wallpapers:feedVersion>
		<image>
			<url><?php echo 'http://'. $_SERVER['HTTP_HOST'].BASE_URL.'photocast_icon.jpg'?></url>
			<title><?php if ($params['rss']) echo str_replace("%20"," ",$params['rss']); else echo $_SERVER['HTTP_HOST']; ?></title>
			<link><?php echo 'http://'. $_SERVER['HTTP_HOST'].BASE_URL.'index.php?q='.str_replace(" ","%20",$params['rss'])?></link>
		</image>

	      <?php
	      if ($params['rss']) $albums[] = str_replace("%20"," ",$params['rss']); else $albums = get_folders(ALBUMS_ROOT);
	
			foreach($albums as $album) {
	
			if (is_dir(ALBUMS_ROOT . '/' . $album)) $photos = get_images(ALBUMS_ROOT . '/' . $album); else $photos = array();
	      $first = true;
	      foreach ($photos as $photo) {
	        $title = '<title>'.$photo.'</title>';
			$desc = '<description>&lt;p>&lt;a href="'.'http://'. $_SERVER['HTTP_HOST'].str_replace(" ","%20",BASE_URL.'albums/' . $album . '/') . $photo.'">&lt;img src="'.'http://'. $_SERVER['HTTP_HOST'].str_replace(" ","%20",BASE_URL.'albums/' . $album . '/thumb/') . $photo.'" alt="photo" title="" style="float:left; padding-right:10px; padding-bottom:10px;"/>&lt;/a>&lt;/p>&lt;br clear=all></description>';
			$link = '<link>'.'http://'. $_SERVER['HTTP_HOST'].str_replace(" ","%20",BASE_URL.'albums/' . '/' . $album) . $photo.'</link>';
			$last_modified = exif_read_data(ALBUMS_ROOT . '/' . $album.'/'.$photo); 
			$last_modified = mktime(substr($last_modified['DateTimeOriginal'], 11, 2), substr($last_modified['DateTimeOriginal'], 14, 2), substr($last_modified['DateTimeOriginal'], 17, 2), substr($last_modified['DateTimeOriginal'], 5, 2), substr($last_modified['DateTimeOriginal'], 8, 2),   substr($last_modified['DateTimeOriginal'], 0, 4) );
			
			if ($last_modified < 950000000) $last_modified = filemtime(ALBUMS_ROOT . '/' . $album.'/'.$photo); 
			
			$pubdate = '<pubDate>'. date("D, d M Y H:i:s T", $last_modified) . '</pubDate>';
			$cat = '<category>'. $album . '</category>';
			$pdate = '<apple-wallpapers:photoDate>'. date("D, d M Y H:i:s T", $last_modified) . '</apple-wallpapers:photoDate>';
			$pcdate = '<apple-wallpapers:cropDate>'. date("D, d M Y H:i:s T", $last_modified) . '</apple-wallpapers:cropDate>';
			$thumb = '<apple-wallpapers:thumbnail>'.'http://'. $_SERVER['HTTP_HOST'].str_replace(" ","%20",BASE_URL.'albums/' . $album . '/thumb/') . $photo.'</apple-wallpapers:thumbnail>';
	        $enc = '<apple-wallpapers:image>'.'http://'. $_SERVER['HTTP_HOST'].str_replace(" ","%20",BASE_URL.'albums/' . $album . '/') . $photo.'</apple-wallpapers:image>';
			echo "\r\n".'<item>';
			echo "\r\n   ".$title;
			echo "\r\n   ".$desc;
			echo "\r\n   ".$link;
			echo "\r\n   ".$pubdate;
			echo "\r\n   ".$cat;
			echo "\r\n   ".$pdate;
			echo "\r\n   ".$pcdate;
			echo "\r\n   ".$thumb;
			echo "\r\n   ".$enc;
			echo "\r\n".'</item>';
	      }
	};
	      ?>

</channel>
