<?php
/*
Template Name: Locations Page 2
*/
?>
<?php get_header(); ?>
	<div class="main addPadding" ng-app="currentLocationsApp">
		<main role="main">

		
		
		



			<section id="location_search" class="centreColumn" ng-controller="searchController">			
				<!--<div class="container">
					<?php render_gradientHeader('locations_comingSoon_1') ?>			
					<div class="location-search-group">
						<p>Select a city to see where our new Sunset Grill locations are being developed.</p>

						<select id="city_select" ng-change="onCityChange();" data-module-role="cities" ng-model="city" ng-options="item.name for item in cities">
						</select>
					</div>
				</div>-->
				
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/markerclusterer.js"></script>   
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe10y9K-_M1TfMj7s0c192dm5hP7TfyrI"></script>
				<?php renderCurrentLocationsData('coming_soon')?>

		    <script type="text/javascript">
		      /*function initialize() {
		        var mapOptions = {
		          center: { lat: -34.397, lng: 150.644},
		          zoom: 8
		        };
		        var map = new google.maps.Map(document.getElementById('map-canvas'),
		            mapOptions);
		      }
		      google.maps.event.addDomListener(window, 'load', initialize);*/
		    </script>

<div class="storelocator-container">
	<div id="map-left" class="storelocator-finder">
		<form class="storelocator no-print" data-module="store_search">
		
			<div class="location-search-group">
					
				<div style="display: none" class="search-field-group">
					<input type="text" id="search" data-module-role="address" />
					<input type="submit" class="btn btn-rev" value="Find" />
				</div>				
				<p>Select a city to see where our new Sunset Grill locations are being developed.</p>
				<select id="city_select" data-module-role="cities">
					<option  disabled selected>Select a City</option>
					
					<?php if( have_rows('city_list', 47) ): ?>
						<?php while( have_rows('city_list', 47) ): the_row(); ?>

							<?php $city_name = get_sub_field('city_name'); ?>		
							<?php $long = get_sub_field('longitude'); ?>		
							<?php $lat = get_sub_field('latitude'); ?>	
							<option data-lat="<?php echo $long; ?>" data-lon="<?php echo $lat; ?>"><?php echo $city_name; ?></option>
							

						<?php endwhile; ?>
					<?php endif; ?>						
					<!--
					<option data-lat="43.2177791" data-lon="-79.98728349999999">Ancaster</option>
					<option data-lat="44.389355599999995" data-lon="-79.69033159999994">Barrie</option>
					<option data-lat="43.3784312" data-lon="-79.75445600000002">Brantford</option>
					<option data-lat="43.683333000000005" data-lon="-79.76666699999997">Brampton</option>
					
					<option data-lat="43.620494600000015" data-lon="-79.51319829999998">Etobicoke</option>
					<option data-lat="45.3088185" data-lon="-75.89868350000006">Kanata</option>
					
					<option data-lat="43.449999999999996" data-lon="-80.48333299999997">Kitchener</option>
					<option data-lat="43.856100200000014" data-lon="-79.33701879999997">Markham</option>
					<option data-lat="44.74951600000001" data-lon="-79.89219229999996">Midland</option>
					<option data-lat="43.58904520000002" data-lon="-79.64411980000001">Mississauga</option>
					<option data-lat="43.2549988" data-lon="-79.07726159999996">Niagara on the Lake</option>
					
					<option data-lat="43.91997880000001" data-lon="-80.09431130000003">Orangeville</option>
					<option data-lat="45.4215296" data-lon="-75.69719309999996">Ottawa</option>
					<option data-lat="52.26811180000002" data-lon="-113.81123860000002">Red Deer</option>
					
					
					<option data-lat="43.227218199999996" data-lon="-79.71955860000004">Stoney Creek</option>
					<option data-lat="43.970586099999984" data-lon="-79.24428419999997">Stouffville</option>
					<option data-lat="43.46425779999999" data-lon="-80.5204096">Waterloo</option>
					-->
				</select>
				
				

				<a style="display: none" href="#!" class="btn btn-rev gps-btn" data-module-role="gps">Use your location</a>	
						
						
						
			</div>
			
		</form>

		<article class="google-map"></article>
 		<div class="storelocator-map" id="map-canvas" style="height:450px;width:100%;"></div>

	</div>
	<div id="locations-toggle" ng-controller="locationToggler">
        <ul class="row">
            <li ng-repeat="item in otherItems" class="locationsToggle {{item.activeState}}">
                <a href="{{item.url}}" >{{item.title}}</a>
            </li>
        </ul>
    </div>
	<div id="info-right" class="storelocator-results">
<!--		<ul id="store-list"></ul> -->
	</div> 
</div>
<div class="clear"></div> 				
			
			
			
				<!-- <div class="map">
					<div id="map-canvas"></div>
				</div> -->

				<div class="results row" data-module="locations">
					<div class="location-tile col-xs-6 col-md-4" ng-repeat="result in locations" data-lat="{{result.lat}}" data-lon="{{result.lon}}" data-module-role="location">
						<div class="address-block">
							<h5 ng-bind-html="result.city"></h5>
							<h6 ng-bind-html="result.location"></h6>
							<hr/>
							<p class="address" ng-bind-html="trimMarkup(result.address)" ng-show="result.address != null">{{result.address}}</p>
                            <p class="phone" ng-bind-html="result.phone" ng-show="result.phone != null">{{result.phone}}</p>
						</div>
						<p class="hours" ng-bind-html="trimMarkup(result.hours)" ng-show="result.hours != null">{{result.hours}}</p>
						<!--<ul class="features">
							<li ng-repeat="feature in result.features" class="feature-icon" ng-class="getFeatureClass(feature)" ng-style="getFeatureIconStyle(feature);"></li>
						</ul>	-->					
					</div>

				</div>

				<?php 
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post(); 
							the_content();
					} // end while
				} // end if
				?>	
				
				
			</section>

			<section id="dividerBanner_1">
				<?php render_dividerBanner('locations_current_1'); ?>
			</section>
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main1.js"></script> 
                <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/locationsToggle.js"></script>   

		</main>
	</div>			

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
