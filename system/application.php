<?php
/**
 * Photo Promenade -- a tiny PHP photo gallery
 * 
 * @author Peter Gassner <peter@naehrstoff.ch>
 * @copyright Copyright 2008 Peter Gassner
 * @license http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 */


function index() {
  render('index');
}

function album($id) {
  global $params;
  if (is_album(album_dir($id))) {
    $params['path'] = "albums/$id/";
    foreach($params['sizes'] as $size_name => $size_pixels) {
      // FIXME: refresh when new images are added or removed
      if (!is_dir(album_dir($id, $size_name))) {
        create_album($id, $params['sizes']);
      }
      $params[$size_name.'_path'] = $params['path'].$size_name;
    }
    $params['album'] = $id;
    $params = array_merge($params, Spyc::YAMLLoad(album_dir($id)."info.yml"));
    $params['title'] .= ": ".$params['album_title'];
    render('album');
  } else {
    $params['flash'] = "Album not found.";
    render('error');
  }
}

function rss($id = NULL) {
  global $params;
  if (isset($id) && is_album(album_dir($id))) {
    $params['album'] = $id;
    $params['path'] = "albums/$id/";
    $params = array_merge($params, Spyc::YAMLLoad(album_dir($id)."info.yml"));
    $params['title'] .= ": ".$params['album_title'];
  }
  render('rss');
}




/* ALBUM
-------------------------------------------------*/
function is_album($path) {
  return (is_dir($path) && count(get_images($path)) > 0);
}

function album_dir($id, $size = NULL) {
  $path = ($size) ? "$id/$size/" : "$id/";
  return ALBUMS_ROOT.$path;
}



/* Resizing
------------------------------------------------ */
function create_album($id, $sizes) {
  global $params;
  $album_path = album_dir($id);


  if (is_dir(album_dir($id))) {
    //--Create configuration file
    if (!file_exists(album_dir($id)."info.yml")) {
      // There could be more parameters if necessary
      $info_yaml = Spyc::YAMLDump(array(
        'album_title' => $params['album'],
        'album_description' => '')
      );
      if (!$fp = fopen(album_dir($id).'info.yml', 'a')) {
        $params['flash'] = 'Album info file could not be created in <code>'.album_dir($id).'info.yml</code>.';
        render('error');
      }
      if (!fwrite($fp, $info_yaml)) {
        $params['flash'] = 'Could not write to file <code>'.album_dir($id).'info.yml</code>.';
        render('error');
      }
      fclose($fp);
    }


    $originals = get_images(album_dir($id));
    
    //--Create ZIP-Archive to download
    //$zip = new PclZip('archive.zip');
    foreach($originals as $image) {
      $images[] = album_dir($id).$image;
    }
    
    $zip = new PclZip(album_dir($id).'archive.zip');

    $test = $zip->create($images, PCLZIP_OPT_REMOVE_ALL_PATH);
    if ($test == 0) {
      die ("Error: " . $zip->errorInfo(true));
    }

    //--Resize images
    foreach($sizes as $size_name => $size_pixels) {
      $resized_album_path = album_dir($id, $size_name);
      if (!is_dir($resized_album_path)) mkdir($resized_album_path, 0755);
      foreach($originals as $photo) {
        scale(album_dir($id).$photo, "$resized_album_path/$photo", $size_pixels);
      }
    }
  } else {
    $params['flash'] = "Resizing the images in <code>$album_path</code> failed. Could there be a permission problem?";
    render('error');
    exit();
  }
}