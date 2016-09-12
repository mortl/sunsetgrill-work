'use strict';

angular.module('MainApp')
.controller('ContactFormCtrl', function($scope, $sce, TopicFactory) {
  $scope.topics = TopicFactory.topics;

   // alert('contact form');


  
})
.factory('TopicFactory', function() {
  var me = {};

  me.topics = [
	  {id:'customer_feedback', label:'Customer Feedback'},
	  {id:'general_inquiry', label:'General Inquiry'},
	  {id:'real_estate', label:'Real Estate'},  
	  {id:'franchise_inquiry', label:'Franchise Inquiry'},
  ];

  return me;
})

;


