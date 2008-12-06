<title><?php echo $params['title']; ?></title>
<link><?php echo url_for_rss($params); ?></link>
<description>
  <?php
    if (array_key_exists('album_description', $params) && !empty($params['album_description'])) {
      echo $params['album_description'];
    } else {
      echo $params['subtitle'];
    }
  ?>
</description>
<pubDate><?php echo date("D, d M Y H:i:s T", filemtime(ALBUMS_ROOT)) ?></pubDate>
<lastBuildDate><?php echo date("D, d M Y H:i:s T") ?></lastBuildDate>
<generator>iPhoto [iLife Publication Framework] (6.0)</generator>
<apple-wallpapers:feedVersion>0.9</apple-wallpapers:feedVersion>
<image>
  <url><?php echo url('theme/img/photocast_icon.jpg', FALSE); ?></url>
  <title><?php echo $params['title'] ?></title>
  <link><?php echo url_for_rss($params) ?></link>
</image>

<?php
  if (array_key_exists('album', $params)) {
    $albums = array($params['album']);
  } else {
    $albums = get_folders(ALBUMS_ROOT);
    print_r($albums);
  }
?>

<?php foreach($albums as $album): ?>
  <?php foreach (get_images(ALBUMS_ROOT.$album) as $photo): ?>
  <item>
    <?php
      $exif = exif_read_data(ALBUMS_ROOT."$album/$photo");
      $last_modified = $exif['FileDateTime'];
    ?>
    <title><?php echo $photo ?></title>
    <description>
      <a href="<?php echo url("albums/$album/$photo", FALSE) ?>">
        <img src="<?php echo url("albums/$album/thumb/$photo", FALSE) ?>" alt="" />
      </a>
    </description>
    <link><?php echo url("albums/$album/$photo", FALSE) ?></link>
    <pubDate><?php echo date("D, d M Y H:i:s T", $last_modified) ?></pubDate>
    <category><?php echo $album ?></category>
    <apple-wallpapers:photoDate>
      <?php echo date("D, d M Y H:i:s T", $last_modified) ?>
    </apple-wallpapers:photoDate>
    <apple-wallpapers:cropDate>
      <?php echo date("D, d M Y H:i:s T", $last_modified) ?>
    </apple-wallpapers:cropDate>
    <apple-wallpapers:thumbnail>
      <?php echo url("albums/$album/thumb/$photo", FALSE) ?>
    </apple-wallpapers:thumbnail>
    <apple-wallpapers:image>
      <?php echo url("albums/$album/$photo", FALSE) ?>
    </apple-wallpapers:image>
  </item>
  <?php endforeach; ?>
<?php endforeach; ?>
