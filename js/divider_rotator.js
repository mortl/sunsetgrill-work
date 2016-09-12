'use strict';

angular.module('MainApp')

.controller('DividerRotatorCtrl', function($scope, $sce) {
  var data = window.dividerRotatorData;
  var bkImage = data.backgroundImage;
  $scope.slides = data.slides;
  $scope.state = {currentIndex:0};

  $scope.getImageBK = function(slide) {
    // console.log(slide);
    var style = {'background-image':'url(' + bkImage + ')'};
    return style;
  };

  $scope.getMarkup = function(slide) {
    return $sce.trustAsHtml(slide.content);
  };

  var mySwiper;

  function initialize_swiper() {
    // if (mySwiper) return;

    mySwiper = new Swiper ('.swiper-container', {
      // Optional parameters
      direction: 'horizontal',
      loop: false,
      pagination: '#dividerRotator .pagination',
      paginationClickable: true,
      // Navigation arrows
      // nextButton: '.timeline-timeline .arrow.next',
      // prevButton: '.timeline-timeline .arrow.prev',
      autoplay: 7 * 1000,

      onTransitionStart: onSlideChange,
      onSlideChangeEnd: onSlideChange_end

    });  

    window.swiper = mySwiper;
    // mySwiper.slideTo(0);

  };

  initialize_swiper();

  $scope.initialize_swiper = initialize_swiper;

  $scope.reinitSwiper = function() {

    setTimeout(function() {
      mySwiper.update(true);
      mySwiper.updateContainerSize();
      mySwiper.updateSlidesSize();
      mySwiper.slideTo(0);
      mySwiper.startAutoplay();
    }, 500);
    
  }

  $scope.onPageButton = function(index) {
    swiper.slideTo(index);
    Tracker.track(Tracker.category.OUR_FOOD, 'Banner', 'Trainstop ' + (index + 1));
  };

  function onSlideChange(e) {
    $scope.state.currentIndex = e.activeIndex;
    

    // console.log($scope.state.currentIndex);
    // $scope.$apply();

    //selectMarker(e.activeIndex);
  }

  function onSlideChange_end(e) {
    $scope.state.currentIndex = e.activeIndex;    
  }  


})

.directive('initRotator', function($timeout) {
  return {
    link: function (scope, elem, attrs, ctrl) {
      if(scope.$last) {
        $timeout(function() {
           scope.reinitSwiper();
        }, 0);
        
      }

      // hello();
    }
  }
})

;


