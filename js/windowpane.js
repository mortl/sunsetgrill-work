// windowpane.js ~ handy access to viewport dimensions ~ Tim Ziegel
// v2 ~ optimizations, added inside function ~ 11 26 2014
// v3 ~ added individual set functions that can be triggered without the use of a windowpane event
// v3.1 ~ added argument for windowpane event based on original event type ~ 12 18 2014

window.pane = {top:0,bottom:0,left:0,right:0,width:0,height:0,verticalMiddle:0,horizontalMiddle:0,end:0,set:function(){},inside:function(){}};

(function($, d) {
	
	var html = d.documentElement;
	var $window = $(window);
	
	var EVENT = {
		LOAD: 'load.pane',
		RESIZE: 'resize.pane',
		SCROLL: 'scroll.pane',
		ORIENT: 'orientationchange.pane',
		TRIGGER: 'trigger.pane',
		REFRESH: 'windowpane'
	};
	
	EVENT.ALL = [EVENT.LOAD, EVENT.RESIZE, EVENT.SCROLL, EVENT.ORIENT, EVENT.TRIGGER].join(' ');
	
	window.pane.inside = function(element, padding) {
		if (!element || 1 !== element.nodeType) return false;
		if ('number' != typeof padding) padding = 0;
		element = element.getBoundingClientRect();
		return element.bottom >= padding && element.top <= (window.pane.height - padding);
	};
	
	window.pane.set = function(e) {
		window.pane.set.bottom();
		window.pane.set.right();
		window.pane.set.end();
		window.pane.verticalMiddle = window.pane.top + (window.pane.height / 2);
		window.pane.horizontalMiddle = window.pane.left + (window.pane.width / 2);
		$window.trigger(EVENT.REFRESH, (e && e.type) ? e.type : 'invocation');
	};
	
	window.pane.set.width = function() { window.pane.width = window.innerWidth || html.offsetWidth; };
	window.pane.set.height = function() { window.pane.height = window.innerHeight || html.offsetHeight; };
	window.pane.set.top = function() { window.pane.top = window.pageYOffset || html.scrollTop; };
	window.pane.set.left = function() { window.pane.left = window.pageXOffset || html.scrollLeft };
	window.pane.set.bottom = function() { window.pane.set.top(); window.pane.set.height(); window.pane.set.height; window.pane.bottom = window.pane.top + window.pane.height; };
	window.pane.set.right = function() { window.pane.set.left(); window.pane.set.width(); window.pane.right = window.pane.left + window.pane.width; };
	window.pane.set.verticalMiddle = function() { window.pane.set.top(); window.pane.set.height(); window.pane.verticalMiddle = window.pane.top + (window.pane.height / 2); };
	window.pane.set.horizontalMiddle = function() { window.pane.set.left(); window.pane.set.width(); window.pane.horizontalMiddle = window.pane.left + (window.pane.width / 2) };
	window.pane.set.end = function() { var body = d.body || html; window.pane.end = Math.max(body.scrollHeight, body.offsetHeight, html.scrollHeight, html.offsetHeight, html.clientHeight); };
	
	$window.unbind(EVENT.ALL).bind(EVENT.ALL, window.pane.set).trigger(EVENT.TRIGGER);
	
}(window.jQuery, document));