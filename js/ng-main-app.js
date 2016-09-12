'use strict';

window.$ = jQuery;

angular.module('MainApp', ['ngSanitize'])
.run(function($rootScope) {
  // alert('run');
})
.controller('MainController', function($scope) {

})

;  


function updateCanvases() {
  var windowWidth = $(window).width();
  var $canvases = $('.gradientTextCanvas canvas');
  $canvases.each(function(index, element) {
    if (element.width >= windowWidth * 0.90) {
      $(element).addClass('shrink');
    } else {
      $(element).removeClass('shrink');
    }
  });
};

function monitorGradientText() {
  $(window).on('resize', function(e) {
    updateCanvases();
  });

  updateCanvases();

}

function renderCanvasText(element, text, id, slotClass) {
  if (id === undefined || id === null) id = 'gh_' + new Date().getTime();
  if (slotClass === undefined || slotClass === null) {
    slotClass = '';
  } else {
    slotClass = slotClass.split('gradientHeader').join('');
   slotClass = ' ' + slotClass;
  }

  var htmlText = '<h2 class="gradientTextCanvas gradientHeader' + slotClass + '"><canvas id="' + id + '"></canvas></h2>';
  element.replaceWith(htmlText);

  // render canvas
  var c = document.getElementById(id);
  c.width = 500;
  c.height = 80;
  var ctx = c.getContext('2d');
  ctx.font = '48px GradientText';
  ctx.textBaseline = 'hanging';

  var textWidth = Math.floor(ctx.measureText(text).width);
  c.width = textWidth;

  // need to re-declare after canvas has been resized.
  ctx.font = '48px GradientText';
  ctx.textBaseline = 'hanging';

  var spreadFactor = 0.5;
  var x = -c.width * spreadFactor;

  var gradient=ctx.createLinearGradient(x,0,c.width * spreadFactor,0);
  gradient.addColorStop('0','#FFF000');
  gradient.addColorStop('1.0','#FF6600');
  // Fill with gradient
  ctx.fillStyle=gradient;
  ctx.fillText(text,0,5);

  updateCanvases();

}

function waitForFontsToLoad(callback) {
  var maxTextWidth = 150;
  var testElement = $('<p style="font-size:100px; font-family:GradientText; position:fixed; top:-200px; z-index:5000;">XiX</p>');
  $('body').append(testElement);

  var timer = setInterval(function() {
    var width = testElement.width();
    if (width < maxTextWidth) {
      clearInterval(timer);
      callback();
    }

  }, 50);

}



function replaceGradientHeaders() {
  if (browserType !== 'webkit') {

    waitForFontsToLoad(function() {
      var $headers = $('h2 strong');

      $headers.each(function(index, element) {
        var $element = $(this);
        var text = $element.text();
        var $parent = $element.parent();
        var slotClass = $parent.attr('class');
        // console.log(slotClass);
        // if ($parent.hasClass('autosize')) {
        //   slotClass = 'autosize';
        // }

        renderCanvasText($parent, text, null, slotClass);
      });  

      monitorGradientText();

    });
    
  }

}
