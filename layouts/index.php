	<?php include('elements/header.php'); ?>
	<h2>Albums</h2>
<ul class="album_list">
	<?php
	foreach(get_folders($params['album_root']) as $album) {
		echo '<li>'.l($album, $album).'</li>';
	}
	?>
	<br class="clear"/>
</ul>
	<?php include('elements/footer.php'); ?>