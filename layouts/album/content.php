<div id="header">
  <!-- <h2><?php echo $params['album']; ?></h2> -->
  <div id="controls">
    <span class="btn" title="previous image" id="prev"><a onclick="$.galleria.prev(); return false;" href="#">previous</a></span>
    <span class="btn" title="to the albums" id="home"><?php echo l("Home", ""); ?></span>
    <!-- <span class="btn" title="to the overview" id="overview"><a onclick="return false;" href="#">overview</a></span> -->
    <span class="btn" title="nex image" id="next"><a onclick="$.galleria.next(); return false;" href="#">next</a></span>
  </div><!-- #controls -->
</div><!-- #header_nav -->

<div id="main_image_wrapper"><div id="main_image"></div></div>

<div id="scroller">
  <div id="albums"></div>
  <div id="images">
    <ul class="image_list" id="carousel_list">
      <?php
      $photos = get_files(ALBUMS_ROOT . '/' . $params['album']);
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

