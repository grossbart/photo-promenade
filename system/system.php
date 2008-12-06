<?php
/**
 * Photo Promenade -- a tiny PHP photo gallery
 * 
 * @author Peter Gassner <peter@naehrstoff.ch>
 * @copyright Copyright 2008 Peter Gassner
 * @license http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 */


function render($layout) {
  global $params;
  $params['layout'] = $layout;
  if (is_file("theme/layouts/$layout/layout.php")) {
    include_once("theme/layouts/$layout/layout.php");
  } else {
    include_once("theme/layouts/layout.php");
  }
}

function yield($name) {
  global $params;
  $layout = $params['layout'];
  $content = parse_file("theme/layouts/$layout/$name.php", $params);
  if ($content) return $content;
}

function get_folders($path) {
  $folders = array();
  $d = dir($path);
  while (false !== ($entry = $d->read())) {
    if (!ereg("^\.", $entry) && is_dir($path . $entry)) {
      $folders[] = $entry;
    }
  }
  $d->close();
  return $folders;
}

function get_images($path) {
  $all_files = get_files($path);
  $photos = array();
  foreach ($all_files as $file) {
    if (preg_match("/(.*)\.(jpg|jpeg|gif|png)$/", strtolower($file))) {
      $photos[] = $file;
    }
  }
  return $photos;
}

function get_files($path) {
  $files = array();
  $dircontents = scandir($path);

  foreach ($dircontents as $entry) {
    if (!ereg("^\.", $entry) && is_file($path . '/' . $entry)) {
      $files[] = $entry;
    }
  }
  return $files;
}

function join_pairs($pairs) {
  $output = '';
  foreach ($pairs as $key => $value) {
    $output .= $key .'="'.$value.'" ';
  }
  return $output;
}


function parse_file($filepath, $params = array()) {
  if (is_file($filepath)) {
    ob_start();
    include $filepath;
    $file_content = ob_get_contents();
    ob_end_clean();
    return $file_content;
  } else {
    return FALSE;
  }
}

function rawurlencode_sub($url) {
  return str_replace("%2F", "/", rawurlencode($url));
}

