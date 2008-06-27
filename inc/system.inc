<?php
/**
 *  Helferfunktionen für Microgallery
 *  Peter Gassner 2008
 *  peter@naehrstoff.ch
 */
 
function render($layout, $params = array()) {
  include_once("layouts/$layout.php");
}

function url_params() {
  $params = array('controller' => '', 'action' => '');
  if ($_GET['q']) {
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