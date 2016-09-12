'use strict';

angular.module('MainApp')
.controller('CharityCtrl', function($scope, $sce) {
  $scope.dataProvider = window.charityDataProvider;

  var pageSize = 4;
  $scope.itemsToShow = pageSize;



  // console.log('app', dataProvider);

  
  // children.sort(function(a,b) {
  // if (a.titsle < b.title)
  //    return -1;
  // if (a.title > b.title)
  //   return 1;
  // return 0;
  // });



  $scope.getMarkup = function(slide) {
    return $sce.trustAsHtml(slide.content);
  };


  $scope.loadNextPage = function() {
    Tracker.track(Tracker.category.ABOUT_CHARITY, 'Load More', 'Button');
    $scope.itemsToShow += pageSize;
  };


  
})

;


