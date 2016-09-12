'use strict';

var app = angular
.module('MainApp')
    .controller('locationToggler', function($scope, $sce) {
    var currentPageID = window.currentPageID;
    var menuData = window.menuData;
    var locationsID = 81;
	
    $scope.otherItems = [];
	
    for (var i=0; i<menuData.length; i++) {
        var item = menuData[i];
		
		//console.log(item);
        if (item.id == locationsID) {
          var children = [];
          for (var j=0; j<item.children.length; j++) {
            var child = item.children[j];
            	
              
           	if (child.pageID === currentPageID) {
			  	child.activeState = "active";
			}
			children.push(child);
          }
			
		$scope.otherItems = children;
          break;
        }
		
    }    
	//console.log($scope.otherItems);
        //console.log(currentPageID);
        //console.log(menuData);
});