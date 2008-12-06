<h1><?php echo $params['title']?></h1>
<p><?php echo $params['subtitle']?></p>

<h2>Albums</h2>
<ul class="album_list clearfix">
  <?php foreach(get_folders(ALBUMS_ROOT) as $album) {
    echo '<li>'.link_for_album($album).'</li>';
  }?>
</ul>

<p>Subscribe to all albums via <?php echo link_for_iphoto("Photo photocast") ?> or <?php echo link_for_rss("RSS") ?>.</p>

<p>&copy; <a href="http://www.naehrstoff.ch" title="Portfolio of Peter Gassner">Peter Gassner</a> &amp; <a href="http://www.artillery.ch" title="Portfolio of Benjamin Wiederkehr">Benjamin Wiederkehr</a> &amp; <a href="http://www.minze.org" title="Portfolio of Carlo Joerges">Carlo Joerges</a> 2008</p>