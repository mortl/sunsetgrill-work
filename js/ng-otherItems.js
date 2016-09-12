'use strict';

angular.module('MainApp')
.controller('OtherItemsCtrl', function($scope, $sce) {
  var currentPageID = window.currentPageID;
  var menuData = window.menuData;
  var foodID = 84;

  $scope.otherItems = [];

  for (var i=0; i<menuData.length; i++) {
    var item = menuData[i];
    if (item.id == foodID) {
      var children = [];
      for (var j=0; j<item.children.length; j++) {
        var child = item.children[j];
        if (child.pageID !== currentPageID) {
          children.push(child);
        }
      }


      break;
    }
  }


  
  // children.sort(function(a,b) {
  // if (a.titsle < b.title)
  //    return -1;
  // if (a.title > b.title)
  //   return 1;
  // return 0;
  // });




  angular.copy(children, $scope.otherItems);

  $scope.getMarkup = function(slide) {
    return $sce.trustAsHtml(slide.content);
  };


  $scope.navOtherItem = function(url) {
    Tracker.track(Tracker.category.OUR_FOOD, 'Other Menu Items', 'Button', url);
  };


  
})

;


