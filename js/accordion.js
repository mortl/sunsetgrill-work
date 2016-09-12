'use strict';

window.Accordion2 = (function($) {
  var me = {};
  me.init = function(elementID) {
    $(elementID).accordion();    
    $(elementID).accordion('option', 'icons', { 'header': 'ui-icon-plusthick', 'activeHeader': 'ui-icon-minusthick' });    
    $(elementID).accordion('option', 'heightStyle', 'content');    
    $(elementID).accordion( "option", "collapsible", true );

  }

  return me;
}(jQuery));

window.Accordion = (function($) {
  var me = {};
  me.init = function(elementID) {
    var headers = $(elementID + ' .accordion-header');
    var contentAreas = $(elementID + ' .ui-accordion-content ').hide();
    var expandLink = $('.accordion-expand-all');

    headers.click(function() {
        var panel = $(this).next();
        var isOpen = panel.is(':visible');

        if (isOpen) {
          $(this).find('span').addClass('ui-icon-plusthick');
          $(this).find('span').removeClass('ui-icon-minusthick');
        } else {
          $(this).find('span').removeClass('ui-icon-plusthick');
          $(this).find('span').addClass('ui-icon-minusthick');

          var text = $(this).text().toLowerCase();
          text = text.split('/').join('');
          text = text.split(' ').join('_');
          text = text.split('__').join('_');

          Tracker.track(Tracker.category.CAREERS, 'About Positions', text);

        }


        // open or close as necessary
        panel[isOpen? 'slideUp': 'slideDown']()
            // trigger the correct custom event
            .trigger(isOpen? 'hide': 'show');

        // stop the link from causing a pagescroll
        return false;
    });  


  }

  return me;
}(jQuery));


// http://stackoverflow.com/questions/3479447/jquery-ui-accordion-that-keeps-multiple-sections-open

/*
jQuery(document).ready(function(){
  $('.accordion .head').click(function() {
      $(this).next().toggle();
      return false;
  }).next().hide();
});

jQuery(document).ready(function(){
  $('.accordion .head').click(function() {
      $(this).next().toggle('slow');
      return false;
  }).next().hide();
});

*/