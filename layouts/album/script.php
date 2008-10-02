<!-- ——————————————————————————————————————————————————————————————————— JS -->
<script src="js/jquery-1.2.6.min.js"	type="text/javascript"></script>
<script src="js/jquery.hotkeys.js"	type="text/javascript"></script>
<script src="js/jquery.jcarousel.pack.js"	type="text/javascript"></script>
<script src="js/jquery.galleria.js"	type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function(){
		// Galleria Set-Up
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
		// Carousel Set-Up
		jQuery('#carousel_list').jcarousel({
			scroll: 9,
			initCallback: mycarousel_initCallback
		});
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
		// HotKeys Set-Up
		$.hotkeys.add('left', function(){$.galleria.prev();});
		$.hotkeys.add('right', function(){$.galleria.next();});
	//]]>
</script>