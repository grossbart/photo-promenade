<?php
/**
 * Photo Promenade -- a tiny PHP photo gallery
 *
 * @version 1.3
 * @link http://www.naehrstoff.ch/code/photo-promenade
 *
 * @author Peter Gassner <peter@naehrstoff.ch>
 * @author Benjamin Wiederkehr <benjamin.wiederkehr@artillery.ch>
 * @author Carlo Joerges <carlo.joerges@gmail.com>
 *
 * @copyright Copyright 2008 Peter Gassner
 * @license http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 */

require_once('./system/spyc.php');
require_once('./system/pclzip.php');
require_once('./system/image.php');
require_once('./system/system.php');
require_once('./system/application.php');
require_once('./system/helpers.php');


/* Define Filesystem Anchors
------------------------------------------------ */
define('WEB_ROOT',    dirname($_SERVER['PHP_SELF'])).'/';
define('ALBUMS_ROOT', dirname(__FILE__).'/albums/');


/* Load Configuration
------------------------------------------------ */
$params = Spyc::YAMLLoad('albums/config.yml');
define('USE_MOD_REWRITE', $params['nice_urls']);


/* Start Application
------------------------------------------------ */
if (array_key_exists('q', $_GET)) {
  $args = split('/', $_GET['q']);
  switch ($args[0]) {
    case 'album':
      return (isset($args[1])) ? album($args[1]) : index();
    case 'rss':
      return (isset($args[1])) ? rss($args[1]) : rss();
  }
}
return index();
