<div id="header">
  <div id="controls">
    <span class="btn" title="Show previous image" id="prev"><a href="#">previous</a></span>
    <span class="btn" title="Show all albums" id="home"><?php echo l("Home", ""); ?></span>
    <span class="btn" title="Show next image" id="next"><a href="#">next</a></span>
  </div>
</div>

<div id="main_image_wrapper">
  <div id="main_image">
    <!-- placeholder for image -->
  </div>
</div>

<div id="scroller">
  <div id="albums"></div>
  <div id="images">
    <ul id="carousel_list" class="image_list">
      <?php foreach (get_images(ALBUMS_ROOT . $params['album']) as $image): ?>
        <li>
          <a href="<?php echo url_for_image($image, 'big') ?>">
            <img src="<?php echo url_for_image($image, 'thumb') ?>" alt="" />
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php if ($params['album_description']) :?>
<div id="description">
  <p><?php echo $params['album_description']?></p>
</div>
<?php endif;?>

<p><?php echo link_for_zip("Download ZIP-Archive", $params['album']); ?></p>

<p>Subscribe to this album via <?php echo link_for_iphoto('iPhoto photocast', $params['album']); ?> or <?php echo link_for_rss('RSS', $params['album']); ?>.</p>


