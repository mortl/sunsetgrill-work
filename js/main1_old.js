var store_data = location_data_map.slice();
var map = {};

(function($, d) {

	var map_canvas = document.getElementById('map-canvas');
	if (!map_canvas) return console.warn('Map error - canvas element not found.');
	
	map = new google.maps.Map(map_canvas, {
		zoom: 4,
		center: new google.maps.LatLng(52.02714857444259, -88.8589346408844),
        mapTypeControl: false,
        navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
        mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	
	map.markers = [];
	map.clusterer = {};
	map.geocoder = new google.maps.Geocoder();

	var reset_markers = function() {
		
		if (map.markers.length) {
			for (var a = 0; a < map.markers.length; a++) {
				map.markers[a].setMap(null);
			}
		}
		
		map.markers = [];
		
		$.each(store_data, function(i) {
			map.markers.push(new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng(this.lat, this.lon),
				icon: '../../wp-content/themes/sunset/img/__pushpin.png',
				html: '<div class="infoWindowCopy" style="overflow: hidden;">' + 
					'<p class="details-link"><strong>' + this.location + '</strong></p>' +
					'<p class="details-link"><a href="http://maps.apple.com/?q=' + encodeURIComponent(this.address) + '+' +  encodeURIComponent(this.city) + '+' + encodeURIComponent(this.province) + '&t=m&z=11" target="_blank">' + this.address + 
					'<br/>' + this.city + ', ' + this.province + '<br>' + this.postalcode + '</a> <a href="tel:' + this.phone +'">' + this.phone +'</a></p>' +
				'</div>',
			}));
		});
		
		map.clusterer = new MarkerClusterer(map, map.markers, {
			maxZoom: 9,
			gridSize: 40
		});
		
	};
	
	$.fn.moduleStoreSearch = function(OPTIONS) {
		if (Object(OPTIONS) !== OPTIONS) OPTIONS = {};
		
		var EVENT = {
			CLICK: 'click.module_store_search',
			CHANGE: 'change.module_store_search',
			SUBMIT: 'submit.module_store_search'
		};
		
		return this.each(function() {
		
			var that = this;
			var address = that.querySelector('[data-module-role="address"]');
			var cities = that.querySelector('[data-module-role="cities"]');
			var gps = that.querySelector('[data-module-role="gps"]');
			
			if (address && cities && gps) {
			
				$(that).unbind(EVENT.SUBMIT).bind(EVENT.SUBMIT, function(e) {
					e.preventDefault();
					map.geocoder.geocode({ 'address': (address.value || '').trim(), region: 'ca' }, function(results, status) { 

						if (status == google.maps.GeocoderStatus.OK && results && results.length) {
							
							map.setZoom('country' == results[0].types[0] ? 4 : 10);
							map.panTo(results[0].geometry.location);
							
						}
				
					});
				});
				
				$(cities).unbind(EVENT.CHANGE).bind(EVENT.CHANGE, function(e) {
					// Get lat lang from option somehow
				});
				
				$(gps).unbind(EVENT.CLICK).bind(EVENT.CLICK, function(e) {
					e.preventDefault();
					// hook into geolocation API to get lat lang
				});
			
			} else return console.warn('$.fn.moduleStoreSearch error - missing elements.');		
		});	
	};
	
	$(function() {
		reset_markers();
		
		var store_search = d.querySelectorAll('[data-module="store_search"]');
		if (store_search.length) $(store_search).moduleStoreSearch();
		store_search = null;
	});
	
})(window.jQuery, document);