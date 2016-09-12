'use strict';

angular.module('MainApp')
.controller('HomeRotatorCtrl', function($scope, $sce) {

  $scope.slides = window.rotatorData;
  $scope.state = {currentIndex:0};

  $scope.getImageBK = function(slide) {
    var style = {'background-image':'url(' + slide.image.url + ')'};
    return style;
  };

  $scope.getPlateBK = function(slide) {
    var style = {'background-image':'url(' + slide.plateImage.url + ')'};
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
      //loop: true,
      pagination: '#HomeRotator .pagination',
      paginationClickable: true,
      autoplay: 5000,
      // Navigation arrows
      // nextButton: '.timeline-timeline .arrow.next',
      // prevButton: '.timeline-timeline .arrow.prev',
      // paginationBulletRender:function(index, className) {
        // TODO: implement this for tracking

      // },
      onTransitionStart: onSlideChange,
      onSlideChangeEnd: onSlideChange_end

    });  




    window.swiper = mySwiper;
    //mySwiper.slideTo(0);

  };

  initialize_swiper();

  $scope.initialize_swiper = initialize_swiper;

  $scope.reinitSwiper = function() {

    setTimeout(function() {
      mySwiper.update(true);
      mySwiper.updateContainerSize();
      mySwiper.updateSlidesSize();
      // mySwiper.slideTo(0);
      // mySwiper.paginationClickable = true;

      // Tracker.initMastheadRotator();      
    }, 500);
    
  }

/*  var $buttons = $('.pagination button');
  // console.log($buttons);

  $buttons.each(function(index, element) {
    $(this).click(function() {
      swiper.slideTo(index);
    });
  });
*/
  $scope.onPageButton = function(index) {
    swiper.slideTo(index);
  };

  function onSlideChange(e) {
    // $scope.state.currentIndex = e.activeIndex;
    // console.log($scope.state.currentIndex);
    // $scope.$apply();

    //selectMarker(e.activeIndex);
  }

  function onSlideChange_end(e) {
    $scope.state.currentIndex = e.activeIndex;
    Tracker.track(Tracker.category.HOME, 'Banner', 'Trainstop ' + (e.activeIndex + 1));
    // console.log($scope.state.currentIndex);
    $scope.$apply();

    //selectMarker(e.activeIndex);
  }  

  function selectMarker(index) {
    /*
    $markers.removeClass('current');
    $($markers[index]).addClass('current');
    */

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

