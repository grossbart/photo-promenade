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
define('APP_ROOT', dirname(__FILE__).'/');
define('ALBUMS_ROOT', dirname(__FILE__).'/albums/');
define('BASE_URL', dirname($_SERVER['PHP_SELF']).'/');
define('ALBUMS_URL', 'albums/');


/* Load Configuration
------------------------------------------------ */
$params = Spyc::YAMLLoad('config.yml');


/* Handle URL Request
------------------------------------------------ */
if (array_key_exists('q', $_GET)) {
  $args = split('/', $_GET['q']);
  if (isset($args[0])) $params['album'] = $args[0];
}


/* Render Content
------------------------------------------------ */
if (array_key_exists('album', $params)) {
  $album_path = ALBUMS_ROOT . $params['album'] . '/';
  $album_url  = ALBUMS_URL  . $params['album'] . '/';
  if (is_dir($album_path)) {
    foreach($params['sizes'] as $name => $size) {
      if (!is_dir($album_path . $name . '/')) {
        resize_folder($album_path, $params['sizes']);
      }
      $params[$name.'_path'] = $album_url . $name . '/';
    }
    $params['title'] .= ": ".$params['album'];
    render('album');
  } else {
    $params['flash'] = "Album not found.";
    render('error');
  }
} else {
  render('index');
}





/* Resizing
------------------------------------------------ */
function resize_folder($album_path, $sizes) {
  global $params;
  if (is_dir($album_path)) {
    $originals = get_files($album_path);
    foreach($sizes as $name => $size) {
      $resized_album_path = $album_path.$name.'/';
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