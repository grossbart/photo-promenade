<?php
/**
 * Photo Promenade -- a tiny PHP photo gallery
 * @version 1.1
 * @author Peter Gassner <peter@naehrstoff.ch>
 * @author Benjamin Wiederkehr <benjamin.wiederkehr@artillery.ch>
 * @link http://www.naehrstoff.ch/code/photo-promenade
 * @copyright Copyright 2008 Peter Gassner
 * @license http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 * @package PhotoPromenade
 */


/* Includes
------------------------------------------------ */
require_once('inc/system.inc');
require_once('inc/image.inc');
require_once('inc/spyc.php');


/* Define Filesystem Anchors
------------------------------------------------ */
define('APP_ROOT', dirname(__FILE__));
define('ALBUMS_ROOT', dirname(__FILE__) . '/albums/');


/* Load Configuration
------------------------------------------------ */
$params = Spyc::YAMLLoad('config.yml');


/* Rewrite URLs
------------------------------------------------ */
if ($params['nice_urls']) {
  define('MOD_REWRITE', TRUE);
} else {
  define('MOD_REWRITE', FALSE);
}


/* Handle request
------------------------------------------------ */
$params = array_merge($params, url_params());


if (empty($params['controller'])) {
  render('index');
} else if (!empty($params['controller']) && empty($params['action'])) {
  $params['album_name'] = $params['controller'];
  $params['album_path'] = 'albums/' . $params['album_name'];
  foreach($params['sizes'] as $name => $size) {
    $params[$name.'_path'] = $params['album_path'] . '/' . $name . '/';
    if (!is_dir($params[$name.'_path'])) {
      resize_folder($params['album_path'], $params['sizes']);
    }
  }
  
  render('album');
} else if (!empty($params['controller']) && $params['action'] == 'resize') {
  $album_path = ALBUMS_ROOT . $params['controller'];
  resize_folder($album_path, $params['sizes']);
}




/* Resizing
------------------------------------------------ */
function resize_folder($album_path, $sizes) {
  global $params;
  if (is_dir($album_path)) {
    $originals = get_files($album_path);
    foreach($sizes as $name => $size) {
      $resized_album_path = "$album_path/$name";
      if (!is_dir($resized_album_path)) mkdir($resized_album_path, 0755);
      foreach($originals as $photo) {
        scale("$album_path/$photo", "$resized_album_path/$photo", $size);
      }
    }
  } else {
    $params['flash'] = "Resizing the images in <code>$album_path</code> failed. Could there be a permission problem?";
    render('error');
    exit();
  }
}