<?php

/* Includes
------------------------------------------------ */
require_once('inc/system.inc');
require_once('inc/image.inc');


/**
 *  Size Configuration
 *  Resize to width:  'big' => '600'
 *  Resize to height: 'big' => 'x480'
 *  Resize to fit:    'big' => '600x480'
 */

$params = array('sizes'      => array('big' => 'x480', 'thumb' => 'x80'),
                'title'      => 'Microgallery',
                'subtitle'   => 'A tiny PHP photo gallery.',
                'album_root' => filesystem_base_path() . 'albums/');


/* Handle request
------------------------------------------------ */
$params = array_merge($params, url_params());

if (empty($params['controller'])) {
  render('index', $params);
} else if (!empty($params['controller']) && empty($params['action'])) {
  $params['album_name'] = $params['controller'];
  $params['album_path'] = 'albums/' . $params['album_name'];
  foreach($params['sizes'] as $name => $size) {
    $params[$name.'_path'] = $params['album_path'] . '/' . $name . '/';
    if (!is_dir($params[$name.'_path'])) {
      resize_folder($params['album_path'], $params['sizes']);
    }
  }
  
  render('album', $params);
} else if (!empty($params['controller']) && $params['action'] == 'resize') {
  $album_path = $params['album_root'] . $params['controller'];
  resize_folder($album_path, $params['sizes']);
}




/* Resizing
------------------------------------------------ */
function resize_folder($album_path, $sizes) {
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
    render('error');
    exit();
  }
}