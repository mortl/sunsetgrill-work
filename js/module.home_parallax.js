(function($, d) {
	
	// touchy.js ~ Tim Ziegel ~ 3 25 2014
	(function(d, ua, mtp) {
		d.touch = !!(('ontouchstart' in window || d['ms' + mtp] || d[mtp]) && !ua.match(/windows phone os 7/i));
		d.documentElement.className += ' touch-' + (d.touch ? 'en' : 'dis') + 'abled';
	}(document, navigator.userAgent, 'MaxTouchPoints'));
	
	var $w = $(window);
	
	$.fn.moduleHomeRotator = function(OPTIONS) {
		if (Object(OPTIONS) !== OPTIONS) OPTIONS = {};
		if ('number' != typeof OPTIONS.ANIMATION_SPEED) OPTIONS.ANIMATION_SPEED = 800;
		if ('number' != typeof OPTIONS.DELAY) OPTIONS.DELAY = 300;
		OPTIONS.ON_LOAD = !!OPTIONS.ON_LOAD;
		OPTIONS.ANIMATION_SPEED *= 0.001;
		OPTIONS.DELAY *= 0.001;
		
		var EVENT = {
			LOAD: 'load.module_home_rotator'
		};
		
		return this.each(function() {
			
			var that = this;
			var plate = that.querySelector('[data-module-role="plate"]');
			var left_text = that.querySelector('[data-module-role="left_text"]');
			var right_text = that.querySelector('[data-module-role="right_text"]');
			
			if (plate && left_text && right_text) {
				
				TweenLite.set(plate, { opacity: 0, y: '50%', rotation: -30 });
				TweenLite.set(left_text, { opacity: 0, x: '-50%' });
				TweenLite.set(right_text, { opacity: 0, x: '50%' });
				
				var INIT = function() {
					TweenLite.to(plate, OPTIONS.ANIMATION_SPEED, { css: { opacity: 1, y: '0%', rotation: 0 }, delay: OPTIONS.DELAY * 1, ease: Power1.easeOut });
					TweenLite.to(left_text, OPTIONS.ANIMATION_SPEED * 0.7, { css: { opacity: 1, x: '0%' }, delay: OPTIONS.DELAY * 2, ease: Power1.easeInOut });
					TweenLite.to(right_text, OPTIONS.ANIMATION_SPEED * 0.7, { css: { opacity: 1, x: '0%' }, delay: OPTIONS.DELAY * 2, ease: Power1.easeInOut });
				};
				
				
				if (!OPTIONS.ON_LOAD || window.loaded) INIT();
				else $w.one(EVENT.LOAD, INIT);
								
			} else return console.warn('$.fn.moduleHomeRotator error - missing elements.', 'Plate: ' + !!plate, 'Left text: ' + !!left_text, 'Right text: ' + !!right_text);
		});
	};
	
	$.fn.moduleParallax = function(OPTIONS) {
		if (Object(OPTIONS) !== OPTIONS) OPTIONS = {};
		if ('number' != typeof OPTIONS.ANIMATION_SPEED) OPTIONS.ANIMATION_SPEED = 800;
		
		var EVENT = {
			PANE: 'windowpane.module_home_parallax'
		};
		
		return this.each(function() {
			
			var that = this;
			var style = that.getAttribute('data-module-style') || '';
			that.module_animation_speed = (parseInt(that.getAttribute('data-module-speed') || '') || OPTIONS.ANIMATION_SPEED) / 1000;
			that.module_offset = that.getAttribute('data-module-offset') || '';
			if ('half' != that.module_offset) that.module_offset = parseInt(that.module_offset) || 250;
			that.module_actions = null;
			
			switch (style) {
				
				case 'fade_left':
					that.module_actions = {
						init: function() { TweenLite.set(that, { opacity: 0, x: '50%' }) },
						inside: function() { TweenLite.to(that, that.module_animation_speed, { css: { opacity: 1, x: '0%' }, ease: Power2.easeInOut }); }
					};
				break;
				case 'fade_right':
					that.module_actions = {
						init: function() { TweenLite.set(that, { opacity: 0, x: '-50%' }); },
						inside: function() { TweenLite.to(that, that.module_animation_speed, { css: { opacity: 1, x: '0%' }, ease: Power2.easeInOut }); }
					};
				break;
				case 'fade_down':
					that.module_actions = {
						init: function() { TweenLite.set(that, { opacity: 0, y: '-25%' }); },
						inside: function() { TweenLite.to(that, that.module_animation_speed, { css: { opacity: 1, y: '0%' }, ease: Power2.easeOut }); }
					};
				break;
				case 'fade_up':
					that.module_actions = {
						init: function() { TweenLite.set(that, { opacity: 0, y: '25%' }); },
						inside: function() { TweenLite.to(that, that.module_animation_speed, { css: { opacity: 1, y: '0%' }, ease: Power2.easeOut }); }
					};
				break;
				case 'fade_in':
					that.module_actions = {
						init: function() { TweenLite.set(that, { opacity: 0 }); },
						inside: function() { TweenLite.to(that, that.module_animation_speed, { css: { opacity: 1 }, ease: Power2.easeOut }); }
					};
				break;
				case 'grow':
					that.module_actions = {
						init: function() { TweenLite.set(that, { opacity: 0, scale: 0.5 }); },
						inside: function() { TweenLite.to(that, that.module_animation_speed, { css: { opacity: 1, scale: 1 }, ease: Power2.easeOut }); }
					};
				break;
			}
			
			if (that.module_actions) {

				if (!('end' in that.module_actions)) that.module_actions.end = function() {
					that.module_complete = true;
				};

				if (!('pane' in that.module_actions)) that.module_actions.pane = function() {
					var offset = ('half' == that.module_offset) ? (that.offsetHeight || 0) / 2 : that.module_offset;
					if (!that.module_complete && window.pane.inside(that, offset || 250)) {
						that.module_actions.inside();
						that.module_actions.end();
					}
				};
				
				if ('init' in that.module_actions) that.module_actions.init();
				
				if (d.touch) {
					that.module_actions.inside();
					that.module_actions.end();
				} else $w.bind(EVENT.PANE, that.module_actions.pane);
				
			}
		});
	};
	
	$w.one('load', function() { window.loaded = true; });
	
	$(function() {
		if ('TweenLite' in window) {
			
			var home_rotator = d.querySelector('[data-module="home_rotator"]');
			if (home_rotator) $(home_rotator).moduleHomeRotator();
			home_rotator = null;
			
			var home_parallax = d.querySelectorAll('[data-module="parallax"]');
			if (home_parallax.length) $(home_parallax).moduleParallax();
			home_parallax = null;
			
		} else console.warn('module.home_parallax.js error - missing GSAP dependency.');		
	});
	
}(window.jQuery, document));