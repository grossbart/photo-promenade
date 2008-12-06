$(document).ready(function(){

  /**
   *
   * Galleria Setup
   *
   */

  $('.image_list li:first').addClass('active'); // select the first photo
  $('.image_list').addClass('gallery_show'); // adds new class name to maintain degradability
  $('ul.gallery_show').galleria({
    history   : true, // activates the history object for bookmarking, back-button etc.
    clickNext : true, // helper for making the image clickable
    insert    : '#main_image', // the containing selector for our main image
    onImage   : function(image,caption,thumb) { // let's add some image effects for demonstration purposes
      // fade in the image & caption
      image.css('display','none').fadeIn(500);
      caption.css('display','none');
      // fetch the thumbnail container
      var _li = thumb.parents('li');
      // fade out inactive thumbnail
      _li.siblings().children('img.selected').fadeTo('fast',0.6);
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
  
  
  
  /**
   *
   * Carousel Set-Up
   *
   */

  $('#carousel_list').jcarousel({
    scroll: 9,
    initCallback: function (carousel) {
      $('#main_image').bind('img_change',function() {
        var num = parseInt(($('.caption').text()).split(":",1)[0])-1;
        carousel.scroll(num);
        return false;
      });
    }
  });



  /**
   *
   * Navigation Set-Up
   *
   */

  $("#prev a").click(function() {
    $.galleria.prev();
    return false;
  });
  
  $("#next a").click(function() {
    $.galleria.next();
    return false;
  });

  $.hotkeys.add('left', function(){
    $.galleria.prev();
  });

  $.hotkeys.add('right', function(){
    $.galleria.next();
  });
});