var store_data = location_data_map.slice();
var map = {};

(function($, d) {

	var map_canvas = document.getElementById('map-canvas');
	if (!map_canvas) return console.warn('Map error - canvas element not found.');
	
  // old center of map, was causing issues with displaying certain offices
	//new google.maps.LatLng(52.02714857444259, -88.8589346408844)
	map = new google.maps.Map(map_canvas, {
		zoom: 11,
		center: new google.maps.LatLng(43.65322600000002, -79.38318429999997),
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
      
      /*EXPERIMENTING*/
			google.maps.event.addListener(map.markers[i],'click', function(){

				map.setZoom(14);
				map.setCenter(map.markers[i].getPosition());

			});
			/*END*/
		});
		
		map.clusterer = new MarkerClusterer(map, map.markers, {
			maxZoom: 11,
			gridSize: 40,
      imagePath: '../../wp-content/themes/sunset/img/__pushpin.png'
		});
		
	};

	var get_location_at_start = function(){
		if ('geolocation' in navigator)
			navigator.geolocation.getCurrentPosition(function(position) {
				map.setZoom(11);
				map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));

			}, function(error){

				console.log(error);
				var tLat = 43.65322600000002;
				var tLon =-79.38318429999997;
				map.setZoom(11);
				map.panTo(new google.maps.LatLng(tLat,tLon));

			});

		else alert("Geolocation not supported.");
	};
	var reset_locations = function() {
		var locations = d.querySelectorAll('[data-module="locations"]');
		if (locations.length) $(locations).moduleLocations();
		locations = null;
	};
	
	google.maps.event.addListener(map, 'idle', reset_locations, false);
	
	$.fn.moduleStoreSearch = function(OPTIONS) {

		//get_location_at_start();
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
							
							map.setZoom('country' == results[0].types[0] ? 4 : 11);
							map.panTo(results[0].geometry.location);

						}
				
					});
				});
				
				$(cities).unbind(EVENT.CHANGE).bind(EVENT.CHANGE, function(e) {
					var lat = lon = 0;
					for (var a = 0; a < this.options.length; a++) {
						if (this.options[a].selected) {
							lat = this.options[a].getAttribute('data-lat') || 0;
							lon = this.options[a].getAttribute('data-lon') || 0;
							break;
						}
					}
					
					if (lat && lon)	{
						map.setZoom(11);
						map.panTo(new google.maps.LatLng(lat, lon));
					}
					lat = lon = null;
				});
				
				$(gps).unbind(EVENT.CLICK).bind(EVENT.CLICK, function(e) {
					e.preventDefault();
					get_location_at_start();


				});

				if ('location_search' == window.location.hash.replace('#', '')) $(gps).trigger(EVENT.CLICK);
			
			} else return console.warn('$.fn.moduleStoreSearch error - missing elements.');		
		});	
	};
	
	$.fn.moduleLocations = function(OPTIONS) {
		if (Object(OPTIONS) !== OPTIONS) OPTIONS = {};
		if ('number' != typeof OPTIONS.MAX_VISIBLE) OPTIONS.MAX_VISIBLE = 6;
		
		return this.each(function() {
			
			var that = this;
			var locations = that.querySelectorAll('[data-module-role="location"]');
			var bounds = map.getBounds();
			var center = map.getCenter();
			var rad = function(x) { return x * Math.PI / 180; };
			var distance_from = function(lat, lon) {
				var mLat = center.lat();
				var mLon = center.lng();
				var dLat = rad(lat - mLat);
				var dLon = rad(lon - mLon);
				var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(mLat)) * Math.cos(rad(mLon)) * Math.sin(dLon/2) * Math.sin(dLon/2);
				var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
				return 6371 * c;
			};
			
			if (!bounds || !center) return;
			if (locations.length) {
				
				var visible_locations = [];
				
				for (var a = 0; a < locations.length; a++) {
					locations[a].style.display = 'none';
					locations[a].module_lat = locations[a].getAttribute('data-lat') || 0;
					locations[a].module_lon = locations[a].getAttribute('data-lon') || 0;
					if (bounds.contains((new google.maps.LatLng(locations[a].module_lat, locations[a].module_lon)))) visible_locations.push(locations[a]);
				}
				
				visible_locations.sort(function(a, b) {
					return distance_from(a.module_lat, a.module_lon) - distance_from(b.module_lat, b.module_lon);
				});
				
				for (var a = 0; a < Math.min(visible_locations.length, OPTIONS.MAX_VISIBLE); a++) {
					visible_locations[a].style.display = 'block';
				}
				
			} else return console.warn('$.fn.moduleLocations error - missing elements.');
		});
	};
	
	$(function() {


		reset_markers();
		reset_locations();


		var store_search = d.querySelectorAll('[data-module="store_search"]');
		if (store_search.length) $(store_search).moduleStoreSearch();
		store_search = null;
	});
	
})(window.jQuery, document);


$(document).ready(function(){

	$('.btn.btn-rev.gps-btn').trigger('click');
});