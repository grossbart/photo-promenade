<?php
/**
 *  Helferfunktionen für Microgallery
 *  Peter Gassner 2008
 *  peter@naehrstoff.ch
 */
 
function render($layout) {
  global $params;
  $params['layout'] = $layout;
  include_once("layouts/layout.php");
}

function yield($name) {
  global $params;

  $content = read_file('layouts/'.$params['layout'].'/'.$name.'.php');

  if ($content) {
    echo $content;
  }
}


function url_params() {
  $params = array('controller' => '', 'action' => '');
  if (array_key_exists('q', $_GET)) {
    $args = split('/', $_GET['q']);
    if (count($args) > 0 && $args[0]) $params['controller'] = $args[0];
    if (count($args) > 1 && $args[1]) $params['action'] = $args[1];
  }
  return $params;
}

function base_path() {
  $script_root = $_SERVER['PHP_SELF'];
  return ereg_replace("index.php", "", $script_root);
}

function filesystem_base_path() {
  return $_SERVER['DOCUMENT_ROOT'] . base_path();
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
  // URL Optionen prüfen
  //if ($request == $target) $options['class'] = 'active';
  if (MOD_REWRITE) {
    $options['href'] = base_path() . $target;
  } else {
    $options['href'] = base_path() . '?q=' . $target;
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


function read_file($filepath) {
  global $params;
  $filepath = APP_ROOT . '/' .$filepath;

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