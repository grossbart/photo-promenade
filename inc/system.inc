<?php
/**
 * Photo Promenade -- a tiny PHP photo gallery
 * Helpers
 * @author Peter Gassner <peter@naehrstoff.ch>
 * @link http://www.naehrstoff.ch/code/photo-promenade
 * @copyright Copyright 2008 Peter Gassner
 * @license http://www.opensource.org/licenses/gpl-3.0.html GPLv3
 * @package PhotoPromenade
 */
 

function render($layout) {
  global $params;
  $params['layout'] = $layout;
  if (is_file("layouts/$layout/layout.php")) {
    include_once("layouts/$layout/layout.php");
  } else {
    include_once("layouts/layout.php");
  }
}

function yield($name) {
  global $params;
  $content = parse_file(APP_ROOT.'layouts/'.$params['layout'].'/'.$name.'.php', $params);
  if ($content) echo $content;
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

function l($title, $target, $options = array()) {
  global $params;
  // URL Optionen prüfen
  //if ($request == $target) $options['class'] = 'active';
  if ($params['nice_urls']) {
    $options['href'] = BASE_URL . $target;
  } else {
    if ($target == '') {
      $options['href'] = BASE_URL;
    } else {
      $options['href'] = BASE_URL . '?q=' . $target;
    }
  }

  // Link ausgeben
  return '<a '.join_pairs($options).'>'.$title.'</a>';
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