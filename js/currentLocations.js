'use strict';

var app = angular
.module('MainApp')

.controller('searchController', function($scope) {
  $scope.searchResults = [];
  $scope.locations = [];
  if (window.location_data) {
    angular.copy(window.location_data, $scope.locations);
  }

  // get cities
  var cityHash = {};
  for (var i=0; i<$scope.locations.length; i++) {
    var location = $scope.locations[i];
    if (cityHash[location.city] == undefined) {
      cityHash[location.city] = 1;
    }
    cityHash[location.city]++;
  }

  $scope.cities = [];
  var cityList = [];
  for (var city in cityHash) {
   //  console.log(city);
    cityList.push({name:city, data:city});
  }


  cityList.sort(function(a,b) {
    if (a.name < b.name)
       return -1;
    if (a.name > b.name)
      return 1;
    return 0;
  });

  $scope.onCityChange = function() {
     //console.log($scope.city);
    // console.log(String(window.location.href));
    var page = String(window.location.href).indexOf('coming') > -1 ? Tracker.category.LOCATIONS_COMING_SOON : Tracker.category.LOCATIONS_CURRENT;
    Tracker.track(page, 'Select City', $scope.city.data);
  };


  // console.log(cityList);

  angular.copy(cityList, $scope.cities);

  $scope.trimMarkup = function(text) {
    text = text.replace('<p>', '');
    text = text.replace('</p>', '');
    return text;
  };

  $scope.getFeatureClass = function(feature) {
    var result = '';
    var classes = [];
    classes.push(feature.id);
    if (feature.value) {
      classes.push('hasFeature');
    }

    result = classes.join(' ');
    return result;
  };
  
  
  $scope.getFeatureClass2 = function(feature) {
    var result = '';
    var classes = [];
    classes.push(feature.id);

    result = classes.join(' ');
    return result;
  };  

  $scope.getFeatureIconStyle = function(feature) {
    var url = window.iconFolder + feature.id + '.png';
    // var result = {'background':'url(\'' + url + '\');'};
    var result = {'background-image':'url(' + url + ')'};
    // var result = {'background-color':'blue'};
    //var result = {border:'1px solid red'};
    return result;
  };
  //console.log(location_data);

  window.setCity = function(newCity) {
    // var element = document.getElementById('city_select');
    var element = $('#city_select');
    newCity = newCity.toLowerCase();
    var selectedCity;
    for (var i=0; i<$scope.cities.length; i++) {
      var city = $scope.cities[i];
      if (city.data.toLowerCase() == newCity) {
        selectedCity = city;
        break;
      }
    }

    $scope.city = selectedCity;

    // element.value = cityIndex;
    // $('#city_select').val(cityIndex);
    //$scope.city = city;

    $scope.$apply();
  };

  // Set up tracking
  $('.locations_comingSoon_1 .dividerBanner-button').click(function() {
    var url = $(this).attr('href');
    Tracker.track(Tracker.category.LOCATIONS_COMING_SOON, 'Franchise Guide', 'Button', url);
    return false;
  });

  $scope.onGeolocate = function() {
    Tracker.track(Tracker.category.LOCATIONS_CURRENT, 'Geolocate', 'Button');
    // TODO: add code here to geolocate.
  };

  $scope.onSearch = function() {
    Tracker.track(Tracker.category.LOCATIONS_CURRENT, 'Address Box', 'Find Button');
  };


})


// var a = {id:"555", 
// city:"Midland", 
// location:"Highway 93 - Mountainview Mall",
// address:"<p>Opening 2015</p><p>&nbsp;</p>", 
// phone:"", 
// hours:"<p>Franchise Opportunity &#8211; Please Contact:<br /><a href="mailto:info@sunsetgrill.ca">info@sunsetgrill.ca</a></p>", 
// cords:"Highway 93 - Mountainview Mall", 
// lon:"", lat:"Highway 93 - Mountainview Mall", 
// features:[{id:'accessible', value:false},{id:'patio', value:false},{id:'licensed', value:false}]};

