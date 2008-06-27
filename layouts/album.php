<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<!-- ——————————————————————————————————————————————————————————————————— TITLE -->
	<title><?php echo $params['title']?> <?php echo $params['controller']?></title>
	<!-- ——————————————————————————————————————————————————————————————————— META -->
	<meta http-equiv="Content-Type"	content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language"	content="de-de" />
	<meta name="Robots"	content="ALL" />
	<meta name="Keywords"	content="_KEYWORDS_" />
	<meta name="Description"	content="_DESCRIPTION_" />
	<meta name="Author"	content="<?php echo $params['author']?>" />
	<meta name="Copyright"	content="<?php echo date(); ?> " />
	<!-- ——————————————————————————————————————————————————————————————————— FAVICON -->
	<link rel="shortcut icon"	href="img/favicon.ico"	type="image/x-icon" />
	<link rel="icon"	href="img/favicon.ico"	type="image/x-icon" />
	<!-- ——————————————————————————————————————————————————————————————————— CSS -->
	<link rel="stylesheet"	href="css/base.css"	type="text/css"	media="screen" />
	<!-- ——————————————————————————————————————————————————————————————————— JS -->
	<script src="js/jquery.galleria.js"	type="text/javascript"></script>
	<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function(){
			$('.image_list').addClass('gallery_show'); // adds new class name to maintain degradability
			$('ul.gallery_show').galleria({
				history   : true, // activates the history object for bookmarking, back-button etc.
				clickNext : true, // helper for making the image clickable
				insert    : '#main_image', // the containing selector for our main image
				onImage   : function(image,caption,thumb) { // let's add some image effects for demonstration purposes
					// fade in the image & caption
					image.css('display','none').fadeIn(500);
					caption.css('display','none')//.fadeIn(500);;
					// fetch the thumbnail container
					var _li = thumb.parents('li');
					// fade out inactive thumbnail
					_li.siblings().children('img.selected').fadeTo(100,0.6);
					// fade in active thumbnail
					thumb.fadeTo('fast',1).addClass('selected');
					// add a title for the clickable image
					image.attr('title','Next image >>');
					$('#main_image').trigger('img_change');
				},
				onThumb : function(thumb) { // thumbnail effects goes here
					// fetch the thumbnail container
					var _li = thumb.parents('li');
					// if thumbnail is active, fade all the way.
					var _fadeTo = _li.is('.active') ? '1' : '0.6';
					// fade in the thumbnail when finished loading
					thumb.css({display:'none',opacity:_fadeTo}).fadeIn(500);
					// hover effects
					thumb.hover(
						function() { thumb.fadeTo('fast',1); },
						function() { _li.not('.active').children('img').fadeTo('fast',0.6); } // don't fade out if the parent is active
					)
				}
			});
			jQuery('#carousel_list').jcarousel({
				scroll: 9,
				initCallback: mycarousel_initCallback
			});
			$.hotkeys.add('left', function(){$.galleria.prev();});
			$.hotkeys.add('right', function(){$.galleria.next();});
			$(function() { 
				//var slideshow = $("gallerytitle");
				var active = false;
				var gal = jQuery('#gallerytitle');
				gal.find('.start').css("cursor", "pointer").click(function() {
					if (!active) {
						active = !active;
						$.galleria.next();
						gal.everyTime('5s', 'slideshow', function() {
							$.galleria.next();
						});
					}
				});
				//}).end().find('.stop').css("cursor", "pointer").click(function() {
				gal.find('.stop').css("cursor", "pointer").click(function() {
					if (active) {
						active = !active;
						gal.stopTime('slideshow');
					}
				});
			});
	    });
			function mycarousel_initCallback(carousel) {
				jQuery('#main_image').bind('img_change',function() {
					var num = parseInt((jQuery('.caption').text()).split(":",1)[0])-1;
					carousel.scroll(num);
					return false;
				});
			};
		//]]>
	</script>
</head>
<!-- ——————————————————————————————————————————————————————————————————— BODY -->
<body>
	<div id="container" class="album">
		<div id="header">
			<!-- <h2><?php echo $params['controller']; ?></h2> -->
			<div id="controls">
				<span class="btn" title="previous image" id="prev"><a onclick="$.galleria.prev(); return false;" href="#">previous</a></span>
				<span class="btn" title="to the albums" id="home"><?php echo l("Home", ""); ?></span>
				<!-- <span class="btn" title="to the overview" id="overview"><a onclick="return false;" href="#">overview</a></span> -->
				<span class="btn" title="nex image" id="next"><a onclick="$.galleria.next(); return false;" href="#">next</a></span>
			</div><!-- #controls -->
		</div><!-- #header_nav -->
		<div id="main_image_wrapper"><div id="main_image"></div></div>
		<div id="scroller">
			<div id="albums"></div>
			<div id="images">
				<ul class="image_list" id="carousel_list">
					<?php
					$photos = get_files($params['album_path']);
					$first = true;
					foreach ($photos as $photo) {
						$thumb = '<img src="'.$params['thumb_path'].$photo.'" alt="'.$photo.'" />';
						if($first){
							echo '<li class="active"><a href="'.$params['big_path'] . $photo.'" title="'.$photo.'">'.$thumb.'</a></li>';
							$first = false;
						}else{
							echo '<li><a href="'.$params['big_path'] . $photo.'" title="'.$photo.'">'.$thumb.'</a></li>';
						};
					};
					?>
				</ul>
			</div>
		</div>
	</div><!-- #container -->
</body>
</html>