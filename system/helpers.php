<?php
/**
 * Photo Promenade -- a tiny PHP photo gallery
 * 
 * @author Peter Gassner <peter@naehrstoff.ch>
 * @copyright Copyright 2008 Peter Gassner
 * @license http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 */


function url($path, $is_query = TRUE, $scheme = 'http') {
  $sep = (USE_MOD_REWRITE || !$is_query) ? "/" : "/?q=";
  return $scheme . '://' . $_SERVER['HTTP_HOST'] . WEB_ROOT . $sep . rawurlencode_sub($path);
}

function l($title, $target, $options = array()) {
  global $params;
  $options['href'] = url($target);
  return '<a '.join_pairs($options).'>'.$title.'</a>';
}

function link_for_album($album) {
  return l($album, "album/$album");
}

function link_for_iphoto($title, $album = NULL) {
  $url = (isset($album)) ? "rss/$album" : 'rss';
  return '<a href="'.url($url, TRUE, 'photo').'">'.$title.'</a>';
}

function link_for_rss($title, $album = NULL) {
  $url = (isset($album)) ? "rss/$album" : 'rss';
  return '<a href="'.url($url).'">'.$title.'</a>';
}

function url_for_rss($params) {
  return (array_key_exists('album', $params)) ? url('rss/'.$params['album']) : url('rss');
}

function url_for_image($image, $size = NULL) {
  global $params;
  $path = (isset($size)) ? $size.'_path' : 'path';
  return $params[$path] . '/' . $image;
}

function stylesheet_link_tag() {
  $args = func_get_args();
  if (count($args) > 0) {
    $files = (is_array($args[0])) ? $args[0] : $args;
  } else {
    $files = array('application.css');
  }
  
  $attributes = array(
    'rel'   => 'stylesheet',
    'type'  => 'text/css',
    'media' => 'screen'
  );

  $output = "";
  foreach ($files as $file) {
    // array_merge
    $output .= "<link href=\"theme/css/$file\" ".join_pairs($attributes)."/>\n";
  }
  return $output;
}

function javascript_include_tag() {
  $args = func_get_args();
  $files = (is_array($args[0])) ? $args[0] : $args;
  $output = "";
  foreach ($files as $file) {
    $output .= "<script src=\"theme/js/$file\" type=\"text/javascript\"></script>\n";
  }
  return $output;
}
