<h1><?php echo $params['title']?></h1>
<p><?php echo $params['subtitle']?></p>

<h2>Albums</h2>
<ul class="album_list">
	<?php
	foreach(get_folders(ALBUMS_ROOT) as $album) {
		echo '<li>'.l($album, $album).'</li>';
	}
	?>
  <br class="clear"/>
</ul>

<p>&copy; <a href="http://www.naehrstoff.ch" title="Portfolio of Peter Gassner">Peter Gassner</a> &amp; <a href="http://www.artillery.ch" title="Portfolio of Benjamin Wiederkehr">Benjamin Wiederkehr</a> 2008</p>