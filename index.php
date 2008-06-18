<?php

/**
 *
 *  PHOTO PROMENADE
 *  
 *  Copyright 2008 Peter Gassner
 *  http://www.naehrstoff.ch/
 *
 *  Version 1.0, 2008/06/18
 *  
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


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
                'title'      => 'Photo Promenade',
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