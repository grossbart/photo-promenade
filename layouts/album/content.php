<div id="header">
	<div id="controls">
		<span class="btn" title="previous image" id="prev"><a onclick="$.galleria.prev(); return false;" href="#">previous</a></span>
		<span class="btn" title="to the albums" id="home"><?php echo l("Home", ""); ?></span>
		<span class="btn" title="nex image" id="next"><a onclick="$.galleria.next(); return false;" href="#">next</a></span>
	</div><!-- #controls -->
</div><!-- #header -->

<div id="main_image_wrapper"><div id="main_image"></div></div>

<div id="scroller">
	<div id="albums"></div>
	<div id="images">
		<ul id="carousel_list" class="image_list">
			<?php
      $photos = get_images(ALBUMS_ROOT . '/' . $params['album']);
			$first = true;
			foreach ($photos as $photo) {
				$thumb = '<img src="'.$params['thumb_path'].$photo.'" alt="'.$photo.'" />';
				if($first){
					echo '<li class="active"><a href="'.$params['big_path'] . $photo.'" title="'.$photo.'">'.$thumb.'</a></li>';
					$first = false;
				}else{
					echo '<li><a href="'.$params['big_path'] . $photo.'" title="'.$photo.'">'.$thumb.'</a></li>';
				};
			};
			?>
		</ul>
	</div>
</div>

<?php if ($params['album_description']) :?>
<div id="description">
  <p><?php echo $params['album_description']?></p>
</div>

<?php endif;?>
<?php 
echo '<p>Subscribe to this album via <a href="photo://'. $_SERVER['HTTP_HOST'].BASE_URL.'?rss='.$params['album'].'">iPhoto photocast</a> or <a href="http://'. $_SERVER['HTTP_HOST'].BASE_URL.'?rss='.$params['album'].'">RSS</a>.</p>';
?>