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


/* Load Configuration File
------------------------------------------------ */
$params = Spyc::YAMLLoad('config.yml');


/* Handle URL Request
------------------------------------------------ */
if (array_key_exists('q', $_GET)) {
  $args = split('/', $_GET['q']);
  if (isset($args[0])) $params['album'] = $args[0];
}
if (array_key_exists('rss', $_GET)) {
  $args = split('/', $_GET['rss']);
  if (isset($args[0])) $params['rss'] = $args[0];
}

/* Render Content
------------------------------------------------ */
if (array_key_exists('album', $params)) {
  $album_path = ALBUMS_ROOT . $params['album'] . '/';
  $album_url  = ALBUMS_URL  . $params['album'] . '/';
  if (is_dir($album_path)) {
    foreach($params['sizes'] as $size_name => $size_pixels) {
      if (!is_dir($album_path . $size_name . '/')) {
        setup_album($album_path, $params['sizes']);
      }
      $params[$size_name.'_path'] = $album_url . $size_name . '/';
    }
    $params = array_merge($params, Spyc::YAMLLoad($album_path.'info.yml'));
    $params['title'] .= ": ".$params['album_title'];
    render('album');
  } else {
    $params['flash'] = "Album not found.";
    render('error');
  }
} elseif (array_key_exists('rss', $params)) {
  rss();
} else {
  render('index');
}
