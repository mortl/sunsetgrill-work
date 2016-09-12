(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
    /**************************************************
    * Browser Detection
    **************************************************/
    var agent = navigator.userAgent.toLowerCase();
    var browserClass = '';
    if (agent.indexOf('webkit') > -1) {
      browserClass = 'webkit';
    } else {
      browserClass = 'mozilla';
    }

    window.browserType = browserClass;

    $(document.body).addClass(browserClass);

    if (agent.indexOf('android') > -1 || agent.indexOf('ios') > -1) {
      $(document.body).addClass('touch');
    } else {
      $(document.body).addClass('no-touch');
    }

    /**************************************************
    * Menu
    **************************************************/

    // Make a clone of the nav menu for desktop
    // Use the original for mobile.
    var $mainMenuHolder = $('.nav-container');

    function initialize_desktopMenu() {
      var $desktopMenu = $('.nav-holder.on-desktop');

      var $navItems = $desktopMenu.find('.main-nav-item');
      var $submenus = $desktopMenu.find('.sub-menu');
      var $submenuMask = $desktopMenu.find('.submenu-mask');
      var $submenuHolder = $desktopMenu.find('.submenu-holder');
      var $closeButton = $desktopMenu.find('.close-btn');

      var submenuList = [];

      var currentIndex = -1;


      // setup submenus
      $navItems.each(function(index) {
        var $item = $(this);
        var dest = $item.attr('data-link');
        $item.attr('data-index', index);
        var $submenu = $item.parent().find('ul');
        if ($submenu.length > 0) {
          submenuList[index] = $submenu;
          $submenu.detach();
          $item.attr('data-hassub', true)
          if ($submenu.length > 4) {
            // $submenu.addClass('multiRow');
          }

          $submenuHolder.append($submenu);
        }

      });

   


      $navItems.click(function() {
        var $item = $(this);
        var dest = $item.attr('data-link');
        var index = $item.attr('data-index');
        var hasSubmenu = $item.attr('data-hassub');

        if (!hasSubmenu) {
          // navigate to the page
          location.href = dest;
        } else {
          if (index == currentIndex) {
            closeSubmenu();
          } else {
            openSubmenu(index);
          }
        }

      });

      $navItems.mouseover(
        function() {
          //openSubmenu($(this).attr('data-index'));
        }
      );

      function openSubmenu(index) {
        currentIndex = index;
        hideAllSubmenus();
        var $submenu = submenuList[index];
        var childCount = $submenu.find('li').length;
        if (childCount > 4) {
          $submenuHolder.addClass('multiRow');
        } else {
          $submenuHolder.removeClass('multiRow');
        }

        
        if ($submenu) {
          $submenuMask.removeClass('hidden');
          $submenu.removeClass('hidden');
          $desktopMenu.removeClass('collapsed');
        } 
      }

      function closeSubmenu() {
        currentIndex = -1;
        $submenuMask.addClass('hidden');
        $desktopMenu.addClass('collapsed');

        hideAllSubmenus();
      }

      function showSubmenu(index) {
        var $submenu = submenuList[index];
        if ($submenu) {
          $submenu.removeClass('hidden');
        } 
      }

      function hideAllSubmenus() {
        $submenus.addClass('hidden');
      }

      $closeButton.click(function() {
        closeSubmenu();
      });

      //openSubmenu(0);
      $desktopMenu.mouseout(function() {

      });

      $(document).click(function(e) {
        var nav = $desktopMenu[0];
        var bounds = nav.getBoundingClientRect();
        if (e.pageX < bounds.left || e.pageX > bounds.right || e.pageY > bounds.bottom) {
          closeSubmenu();
        }

      });


      // DEBUG -- open submenu on start
      // openSubmenu(0);


      if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function(obj, start) {
          for (var i = (start || 0), j = this.length; i < j; i++) {
            if (this[i] === obj) { return i; }
          }
          return -1;
        }
      }

     }


    initialize_desktopMenu();

    /**************************************************
    * Watcher
    **************************************************/
    $(window).on('resize', function(e) {
      // console.log('resize 1');
      //console.log(e);
    });

    // monitorGradientText();

    // don't need this; switching to Canvas
    setTimeout(function() {

      replaceGradientHeaders();
      Tracker.initTracking();
      // monitorGradientText();
    }, 250);
  
    
	});

	
})(jQuery, this);


jQuery(window).load(function(){
	$ = jQuery;
	if($('.gform_confirmation_message').is(':visible')) {
		$('html, body').animate({ 
		scrollTop: $('#contact_form').offset().top 
		}, 1000);	
	}
});

    /**************************************************
    * Select and Label text sync
    **************************************************/
jQuery(document).ready(function() {
    $ = jQuery;
    $('#city_select').change(function(){var selectedOption = $(this).val(); $('.city-select-label').text(selectedOption);});
});
