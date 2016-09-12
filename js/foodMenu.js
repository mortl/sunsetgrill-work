'use strict';

var app = angular
.module('MainApp')

.controller('foodMenuCtrl', function($scope) {
  var $ = $ || jQuery;
  // alert('foodMenuCtrl');

  $scope.results = [];
  $scope.categories = window.categoryDataProvider;
  $scope.filterDataProvider = window.filterDataProvider;
  var allFoodItems = window.foodDataProvider;

  // identify filters
  var filterCounts = {'favourites':0, 'healthy':0, 'new':0};
  var totalFilters = 0;
  for (var i=0; i<allFoodItems.length; i++) {
    for (var j=0; j<allFoodItems[i].filters.length; j++) {
      filterCounts[allFoodItems[i].filters[j]] ++;
      totalFilters++;
    }
  }

  $scope.filterAvailable = function(filterID) {
    return filterCounts[filterID] > 0;
  };

  $scope.filtersAvailable = function() {
    return totalFilters > 0;
  }

  $scope.itemFiltered = function(item) {
    item.filteredOut = false;
    if (noFiltersSet()) {
      return true;
    } else {
      for (var filter in $scope.filters) {
        var filterValue = $scope.filters[filter];
        if (filterValue) {
          if (item.filters.indexOf(filter) > -1) {
            return true;
          }
        }
        
      }

      item.filteredOut = true;
      return false;
    }
  };

  $scope.categoryItemsVisible = function(category) {
    var allItemsFilteredOut = true;

    for (var i=0; i<category.items.length; i++) {
      if (!category.items[i].filteredOut) {
        allItemsFilteredOut = false;
        break;
      }
    }

    return !allItemsFilteredOut;
  };


  $scope.filters = {
    'favourites':false,
    'healthy':false,
    'new':false
  };

  function noFiltersSet() {
    var filterSet = false;
    for (var a in $scope.filters) {
      if ($scope.filters[a]) {
        filterSet = true;
        break;
      }
    }

    return !filterSet;
  }

  $scope.toggleFilter = function(filter) {
    console.log(filter);
    var filterID;
    if (filter === "favourites") {
      filterID = 'Favourites';
    } else if (filter === 'healthy') {
      filterID = 'Healthy Choice';
    } else if (filter === 'new') {
      filterID = 'New Items';

    }
    Tracker.track(Tracker.category.OUR_FOOD, 'Filter Button', filterID);
    $scope.filters[filter] = !$scope.filters[filter];
  };

  $scope.hasFilter = function(item, filter) {
    return item.filters.indexOf(filter) > -1;
  };

  function closeAllNutritions() {
    $('.food-nutrition-mask').removeClass('show');
  }

  var transitionTime = 0.5; // seconds -- match value in css
  var transitionSafetyTime = 0.15; // seconds
  $scope.showNutrition = function(e) {
    var $button = $(e.target);

    var $tile = $button.parent().parent().parent();
    var product = $tile.find('.food-title').text().toLowerCase();
    product = product.split('\'').join('');
    product = product.split(' ').join('_');
    product = product.split('‘').join('');
    product = product.split('’').join('');
    product = product.split('"').join('');

    Tracker.track(Tracker.category.OUR_FOOD, 'Nutrition List', product);
    

    var $nutritionBlock = $button.parent().parent().find('.food-nutrition-mask');
    if (!$nutritionBlock.hasClass('show')) {
      if ($('.food-nutrition-mask').hasClass('show')) {
        closeAllNutritions();
        setTimeout(function() {
          $nutritionBlock.addClass('show');  
        }, (transitionTime + transitionSafetyTime) * 1000);
      } else {
        $nutritionBlock.addClass('show');
      }
    } else {
      $nutritionBlock.removeClass('show');
    }

  };

  $scope.hideNutrition = function(e) {
    var $button = $(e.target);
    var $nutritionBlock = $button.parent().parent();
    $nutritionBlock.removeClass('show');
  };

  $scope.getServingValue = function(item) {
    var serving = item.nutrition.serving_size;
    return serving.length > 0 ? '(' + serving + ')' : '';
  };

  $scope.getPrice = function(item) {
	if 	(item.sizequantity.length > 0 ) {
		var price = '<span class="sm-text">(' + item.sizequantity + ')</span> &nbsp;$&nbsp;' + item.price;
		return price;
	} else {
		var price = '$&nbsp;' + item.price;
		return price;
	}	  

  };
  
	$scope.getPrice_sm = function(item) {
	if 	(item.sizequantity_sm.length > 0 ) {
		var price = '<span class="sm-text">(' + item.sizequantity_sm + ')</span> &nbsp;$&nbsp;' + item.price_sm;
		return price;
	} else {
		var price = '$&nbsp;' + item.price_sm;
		return price;
	}	

  };

  $scope.getPrice_lg = function(item) {
	if 	(item.sizequantity_lg.length > 0 ) {
		var price = '<span class="sm-text">(' + item.sizequantity_lg + ')</span> &nbsp;$&nbsp;' + item.price_lg;
		return price;
	} else {
		var price = '$&nbsp;' + item.price_lg;
		return price;
	}

  };

  $scope.getValue = function(item, field, index) {
    var value = item.nutrition[field];

    if (index != undefined) {
      var values;
      try {
        values = value.split('|');
      } catch (e) {
        console.log('error getting field ', field);
      }
      value = values[index];
      if (value == undefined) value = '';
    }

    return value.length > 0 ? value : '0';
  };

  // console.log(allFoodItems[0]);


})

