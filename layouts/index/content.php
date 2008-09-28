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
<?php 
echo '<p>Subscribe feed of all albums as <a href="photo://'. $_SERVER['HTTP_HOST'].BASE_URL.'?rss">iPhoto photocast</a> or <a href="http://'. $_SERVER['HTTP_HOST'].BASE_URL.'?rss">RSS</a>.</p>';
?>

<p>&copy; <a href="http://www.naehrstoff.ch" title="Portfolio of Peter Gassner">Peter Gassner</a> &amp; <a href="http://www.artillery.ch" title="Portfolio of Benjamin Wiederkehr">Benjamin Wiederkehr</a> &amp; <a href="http://www.minze.org" title="Portfolio of Carlo Joerges">Carlo Joerges</a> 2008</p>