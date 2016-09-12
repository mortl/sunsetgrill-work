'use strict';
window.Timeline = (function($) {
  var me = {};
  var mySwiper;
  
  var onSlideChangeHeightReset = function () {
	  var timelineSlider = $('.timeline-slides.swiper-container'), $timelineSlider = $(timelineSlider);  
	  //$timelineSlider.animate({height: 0}, 100);
  }
  var onSlideChangeHeightSet = function () {
	  
	  var timelineSlider = $('.timeline-slides.swiper-container'), $timelineSlider = $(timelineSlider);

	  var currentSlideHeight = $timelineSlider.find('.timeline-slide.swiper-slide-active .row').outerHeight(true);
	  $timelineSlider.animate({height: currentSlideHeight}, 500);
  };
  me.init = function() {



    mySwiper = new Swiper ('.swiper-container', {
      // Optional parameters
      direction: 'horizontal',
	  //effect: 'coverflow',
	  //effect: 'cube',
	  slidesPerView: 'auto',
      loop: false,
      // Navigation arrows
      nextButton: '.timeline-timeline .arrow.next',
      prevButton: '.timeline-timeline .arrow.prev',
      onTransitionStart: onSlideChange,
      onInit:function() {
        $('.arrow.next').click(function() {
          Tracker.track(Tracker.category.ABOUT_US, 'History Timeline', 'Right Arrow Button');
        });
        $('.arrow.prev').click(function() {
          Tracker.track(Tracker.category.ABOUT_US, 'History Timeline', 'Left Arrow Button');
        });

        
      },
       //onSlideChangeEnd: onSlideChange
	   
	   onSlideChangeStart:onSlideChangeHeightReset,
	   onSlideChangeEnd:onSlideChangeHeightSet

    });

    window.swiper = mySwiper;

    initialize_milestones();

  }


  var $milestones;
  function initialize_milestones() {
    $milestones = $('.timeline-milestone');
    $milestones.click(function(a, b) {
      var index = $(this).index() - 1;
      mySwiper.slideTo(index);
    });
    selectMilestone(0);
  }

  function onSlideChange(e) {
    selectMilestone(e.activeIndex);
  }

  function selectMilestone(index) {
    $milestones.removeClass('current');
    $($milestones[index]).addClass('current');

  }


  $(window).on('resize orientationchange load', function(e) {
    // mySwiper.
    //console.log(e);
	onSlideChangeHeightSet();
  });



  return me;
}(jQuery));

