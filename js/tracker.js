'use strict';

var Tracker = (function() {
  var me = {};

  me.category = {
    HOME: 'Homepage',
    ABOUT_US: 'About Us',
    ABOUT_CHARITY: 'About Charity',
    OUR_FOOD: 'Our Food',
    LOCATIONS_CURRENT: 'Locations',
    LOCATIONS_COMING_SOON: 'Locations Coming Soon',
    FRANCHISE_ABOUT: 'Franchise - About',
    FRANCHISE_STRUCTURE: 'Franchise - Structure',
    FRANCHISE_APPLICATION: 'Franchise - Application',
    CAREERS: 'Careers',
    CONTACT: 'Contact'
  };


 // Tracker.track(Tracker.category.OUR_FOOD, 'action', 'label');
  me.track = function(category, action, label, url, targetWindow) {
    // console.log('tracking', 'category:\"' + category + '\"', 'action:\"' + action + '\"', 'label:\"' + label + '\"', 'url:\"' + url + '\"');

    if (url && targetWindow !== '_blank') {
      ga('send', 'event', category, action, label, {'hitCallback':
        function () {
          document.location = url;
        }
      });
  
    } else {
      ga('send', 'event', category, action, label);    
    }
  };

  me.initTracking = function() {
    var location = window.location.href;

    switch (true) {
      case (location.indexOf('franchise-about') > -1):
         init_franchisePage_about();
         break;
      case (location.indexOf('structure-and-fees') > -1):
         init_franchisePage_structure();
         break;
      case (location.indexOf('application-process') > -1):
         init_franchisePage_application();
         break;
      case (location.indexOf('careers') > -1):
         init_careersPage();
         break;
      case (location.indexOf('contact') > -1):
         init_contactPage();
         break;

    }

  };

  function init_franchisePage_about() {
    // Set up tracking

    // Franchise About
    $('.dividerBanner.franchise_about_1 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      Tracker.track(Tracker.category.FRANCHISE_ABOUT, 'Upcoming Locations', 'Button', url);
      return false;
    });    

    $('.dividerBanner.franchise_about_2 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      var targetWindow = $(this).attr('target');
      Tracker.track(Tracker.category.FRANCHISE_ABOUT, 'Franchising Package', 'PDF Button', url, targetWindow);
      return true;
    });     

  }

  function init_franchisePage_structure() {
    // Set up tracking
    // Franchise Structure
    $('.dividerBanner.franchise_structure_1 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      Tracker.track(Tracker.category.FRANCHISE_STRUCTURE, 'Upcoming Locations', 'Button', url);
      return false;
    });    

    $('.dividerBanner.franchise_structure_2 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      var targetWindow = $(this).attr('target');
      Tracker.track(Tracker.category.FRANCHISE_STRUCTURE, 'Franchising Package', 'PDF Button', url, targetWindow);
      return true;
    });     

  }  

  function init_franchisePage_application() {
    // Set up tracking

    // Franchise Application
    $('.dividerBanner.franchise_application_1 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      Tracker.track(Tracker.category.FRANCHISE_APPLICATION, 'Upcoming Locations', 'Button', url);
      return false;
    });    

    $('.dividerBanner.franchise_application_2 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      var targetWindow = $(this).attr('target');
      Tracker.track(Tracker.category.FRANCHISE_APPLICATION, 'Franchising Package', 'PDF Button', url, targetWindow);
      return true;
    });     

  }  


  function init_careersPage() {
    $('.dividerBanner.careers_1 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      Tracker.track(Tracker.category.CAREERS, 'Locations', 'Button', url);
      return false;
    });  
    

  }  

  function init_contactPage() {
    $('.dividerBanner.contact_1 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      var targetWindow = $(this).attr('target');
      Tracker.track(Tracker.category.CONTACT, 'Franchising Package', 'PDF Button', url, targetWindow);
      return true;
    });  

    $('.dividerBanner.contact_3 .dividerBanner-button').click(function() {
      var url = $(this).attr('href');
      Tracker.track(Tracker.category.CONTACT, 'Careers Widget', 'Button', url);
      return false;
    });  

  }  




  me.trackHomePageBucket = function(index, url) {
    console.log(index, url);
    var category = me.category.HOME;
    var action = index == 0 ? 'View Menu' : 'View Locations';
    var label = 'Button';

    me.track(category, action, label, url);


  };



  
  return me;
}());

