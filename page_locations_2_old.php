<?php
/*
Template Name: Locations Page 2 old
*/
?>
<?php get_header(); ?>
	<div class="main addPadding" ng-app="currentLocationsApp">
		<main role="main">


			<section id="location_search" class="centreColumn" ng-controller="searchController">
				<div class="container">
					<?php render_gradientHeader('locations_comingSoon_1') ?>
					<div class="location-search-group">
						<p>Select a city to see where our new Sunset Grill locations are being developed.</p>

						<select id="city_select" ng-change="onCityChange();" data-module-role="cities" ng-model="city" ng-options="item.name for item in cities">
						</select>
					</div>
				</div>

				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe10y9K-_M1TfMj7s0c192dm5hP7TfyrI"></script>
				<?php renderCurrentLocationsData('coming_soon')?>

		    <script type="text/javascript">
		      function initialize() {
		        var mapOptions = {
		          center: { lat: -34.397, lng: 150.644},
		          zoom: 8
		        };
		        var map = new google.maps.Map(document.getElementById('map-canvas'),
		            mapOptions);
		      }
		      google.maps.event.addDomListener(window, 'load', initialize);
		    </script>

				<div class="map">
					<div id="map-canvas"></div>
				</div>

				<div class="results row">
					<div class="location-tile col-xs-6 col-md-4" ng-repeat="result in locations" ng-show="result.city == city.name">
						<div class="address-block">
							<h5 ng-bind-html="result.city"></h5>
							<h6 ng-bind-html="result.location"></h6>
							<hr/>
							<p class="address" ng-bind-html="trimMarkup(result.address)">{{result.address}}</p>
							<p class="phone" ng-bind-html="result.phone">{{result.phone}}</p>
						</div>
						<p class="hours" ng-bind-html="trimMarkup(result.hours)">{{result.hours}}</p>
						<ul class="features">
							<li ng-repeat="feature in result.features" class="feature-icon" ng-class="getFeatureClass(feature)" ng-style="getFeatureIconStyle(feature);"></li>
						</ul>						
					</div>

				</div>


			</section>

			<section id="dividerBanner_1">
				<?php render_dividerBanner('locations_comingSoon_1'); ?>
			</section>


			<!-- /section -->
		</main>
	</div>			

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
