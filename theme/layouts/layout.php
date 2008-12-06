<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <!-- ——————————————————————————————————————————————————————————————————— TITLE -->
  <title><?php echo $params['title']?></title>
  <!-- ——————————————————————————————————————————————————————————————————— META -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="Author" content="<?php echo $params['author']?>" />
  <meta name="Copyright"  content="<?php echo date('Y'); ?>" />
  <!-- ——————————————————————————————————————————————————————————————————— RSS -->
  <link rel="alternate" type="application/rss+xml" title="<?php echo $params['title']?>" href="<?php echo url_for_rss($params); ?>" />
  <!-- ——————————————————————————————————————————————————————————————————— FAVICON -->
  <link rel="shortcut icon" href="theme/img/favicon.ico" type="image/x-icon" />
  <link rel="icon" href="theme/img/favicon.ico" type="image/x-icon" />
  <!-- ——————————————————————————————————————————————————————————————————— CSS -->
  <?php echo stylesheet_link_tag(); ?>
  <!-- ——————————————————————————————————————————————————————————————————— JS -->
  <?php echo javascript_include_tag(
    'jquery-1.2.6.min.js',
    'jquery.hotkeys.js',
    'jquery.jcarousel.pack.js',
    'jquery.galleria.js',
    'application.js');
  ?>
</head>
<!-- ——————————————————————————————————————————————————————————————————— BODY -->
<body>
  <div id="container" class="<?php echo $params['layout'] ?>">
    <?php echo yield('content'); ?>
  </div>
</body>
</html>