<?php
/*
Template Name: Locations Page 1
*/
?>
<?php get_header(); ?>
	<div class="main addPadding" ng-cloak ng-app="currentLocationsApp">
		<main role="main">

		
		
		



			<section id="location_search" class="centreColumn" ng-controller="searchController">
			
				<div class="container">
					<?php render_gradientHeader('locations_current_1', false) ?>
					<?php render_columnContent('locations_current_1') ?>
					<div class="location-search-group">
					<!--
						<div class="search-field-group">
							<input type="text" id="search"/><button class="btn btn-rev">Find</button>
						</div>
						<span> OR </span>
						<select id="city_select">
							<option>City 1</option>
						</select>
						<button class="btn btn-rev gps-btn">Use your location</button>
					-->	
						
						
						
					</div>
				</div>
				
				<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/markerclusterer.js"></script>   
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe10y9K-_M1TfMj7s0c192dm5hP7TfyrI"></script>
				<?php renderCurrentLocationsData()?>

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
	

	
				<?php
				/*
					$args = array(
						'post_type' => 'location',
						//'posts_per_page' => '-1'

					);
					$query = new WP_Query( $args );		
					
					// The Loop
					while ( $query->have_posts() ) {
						$query->the_post();
						
						$value = get_field( "city");
						echo '<li>' . $value . '</li>';
						//echo '<li>' . get_the_title() . '</li>';
						
						
						//echo $value;
					}

					// * Restore original Post Data 
					// * NB: Because we are using new WP_Query we aren't stomping on the 
					// * original $wp_query and it does not need to be reset with 
					// * wp_reset_query(). We just need to set the post data back up with
					// * wp_reset_postdata().
					 
					wp_reset_postdata();	
					*/
				?>
				
				
				
				
				
				
				
<?php
/*
    function  query_group_by_filter($groupby){
       global $wpdb;

       return $wpdb->postmeta . '.meta_key = "city"';
    }
?>
<?php add_filter('posts_groupby', 'query_group_by_filter'); ?>
<?php $city = new WP_Query(array(
    'post_type' => 'location',
    //'post_status' => 'publish',
    //'posts_per_page' => -1,
    'meta_key' => 'city'
)); 
?>
<?php remove_filter('posts_groupby', 'query_group_by_filter'); ?>
<select id="" class="" name="siege_pays" >
     <option value=""></option>
<?php
while ( $city->have_posts() ) : $city->the_post();


//echo "<option value=".get_field_object('city').">".get_field_object('city')."</option>"; 
echo "<option value=". get_field('city').">".get_field('city')."</option>"; 


endwhile;
echo "</select>";
*/

?>

				
	




	
<?php
    function  query_group_by_filter($groupby){
       global $wpdb;

       return $wpdb->postmeta . '.meta_value ';
    }
?>
<?php add_filter('posts_groupby', 'query_group_by_filter'); ?>
<?php $city = new WP_Query(array(
    'post_type' => 'location',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    /*'order ' => 'ASC',*/
    'order ' => 'DESC',
	'orderby'   => 'meta_value',
    'meta_key' => 'city',
	
	'meta_query' => array(		
		array(
			'key'     => 'status',
			'value'   => 'Open',
			/*'compare' => 'IN',*/
		),
	),
)); 
?>
<?php remove_filter('posts_groupby', 'query_group_by_filter'); ?>
<!--
	<select id="" class="" name="siege_pays" > 
	<?php
	while ( $city->have_posts() ) : $city->the_post();
	echo "<option value=".reset(get_post_custom_values('city')).">" /* .get_the_title()*/ .reset(get_post_custom_values('city'))."</option>"; 
	endwhile;
	?>
	</select>				
-->	





			
				
	
<div class="storelocator-container">
	<div id="map-left" class="storelocator-finder map">
		<form class="storelocator no-print" data-module="store_search">
		
			<div class="location-search-group">
					
				<div class="search-field-group col-xs-12 col-md-5">
					<input type="text" id="search" data-module-role="address" placeholder="Enter a city, address, postal code, intersection, ect." />
					<input type="submit" class="btn btn-rev" value="Find" />
				</div>
				<!--<span> OR </span>-->
                <div class="city-select-holder col-xs-6 col-md-3">
                

				
				
				
				<select id="city_select" data-module-role="cities" name="cities" class="city-select-dropdown">
					<option  disabled selected>Select a City</option>
					
					
					<?php if( have_rows('city_list', 43) ): ?>
						<?php while( have_rows('city_list', 43) ): the_row(); ?>

							<?php $city_name = get_sub_field('city_name'); ?>		
							<?php $long = get_sub_field('longitude'); ?>		
							<?php $lat = get_sub_field('latitude'); ?>	
							<option data-lat="<?php echo $long; ?>" data-lon="<?php echo $lat; ?>"><?php echo $city_name; ?></option>
							

						<?php endwhile; ?>
					<?php endif; ?>	



					
					<!--
					
					<option data-lat="43.850855300000006" data-lon="-79.02037319999995">Ajax</option>
					<option data-lat="44.15386669999998" data-lon="-79.86933320000004">Alliston</option>
					<option data-lat="44.00648000000001" data-lon="-79.45039600000001">Aurora</option>
					<option data-lat="44.389355599999995" data-lon="-79.69033159999994">Barrie</option>
					<option data-lat="44.12022099999999" data-lon="-79.56190800000002">Bradford</option>
					<option data-lat="43.683333000000005" data-lon="-79.76666699999997">Brampton</option>
					<option data-lat="43.3784312" data-lon="-79.75445600000002">Brantford</option>
					<option data-lat="43.32551960000001" data-lon="-79.7990319">Burlington</option>
					<option data-lat="43.36162110000002" data-lon="-80.31442759999997">Cambridge</option>
					<option data-lat="44.5007687" data-lon="-80.21690469999996">Collingwood</option>
					<option data-lat="43.4988825" data-lon="-80.1932398">Guelph</option>
					<option data-lat="44.919643000000015" data-lon="-79.37418339999999">Gravenhurst</option>
					<option data-lat="43.250020800000016" data-lon="-79.8660914">Hamilton</option>
					<option data-lat="44.243611" data-lon="-79.47583299999997">Keswick</option>					
					<option data-lat="43.9286902" data-lon="-79.5281431">King City</option>
					<option data-lat="43.449999999999996" data-lon="-80.48333299999997">Kitchener</option>
					<option data-lat="43.51829910000001" data-lon="-79.87740419999997">Milton</option>
					<option data-lat="43.58904520000002" data-lon="-79.64411980000001">Mississauga</option>					
					<option data-lat="44.059187" data-lon="-79.46125600000002">Newmarket</option>
					<option data-lat="43.08955770000001" data-lon="-79.08494359999992">Niagara Falls</option>
					<option data-lat="43.9021887" data-lon="-79.65269970000001">Nobleton</option>
					<option data-lat="43.467516999999994" data-lon="-79.6876659">Oakville</option>
					<option data-lat="43.8970929" data-lon="-78.86579119999995">Oshawa</option>					
					<option data-lat="45.4214" data-lon="-75.6919">Ottawa</option>
					<option data-lat="43.83841169999998" data-lon="-79.0867579">Pickering</option>
					<option data-lat="43.882840099999996" data-lon="-79.44028080000001">Richmond Hill</option>
					<option data-lat="43.77642580000002" data-lon="-79.2317521">Scarborough</option>
					<option data-lat="53.542683" data-lon="-113.903217">Spruce Grove</option>					
					<option data-lat="53.630475299999986" data-lon="-113.62564199999997">St. Albert</option>
					<option data-lat="43.15937450000002" data-lon="-79.24686259999996">St. Catharines</option>
					<option data-lat="43.65322600000002" data-lon="-79.38318429999997">Toronto</option>
					<option data-lat="43.837207900000024" data-lon="-79.50827600000007">Vaughan</option>					
					<option data-lat="44.52074190000001" data-lon="-80.01606679999999">Wasaga Beach</option>
					<option data-lat="43.33200000000002" data-lon="-79.905983">Waterdown</option>
					<option data-lat="43.89754460000001" data-lon="-78.94293290000003">Whitby</option>					-->
					
				
					

				</select>
                <label for="cities" class="city-select-label">Select a City</label>
				</div>
				<!--<span> OR </span>-->
				<a href="#!" class="btn btn-rev gps-btn col-xs-6 col-md-3" data-module-role="gps">Use your location</a>	
						
						
						
			</div>
			
		</form>

		
		
		<article class="google-map"></article>
 		<div class="storelocator-map" id="map-canvas" style="width:100%;"></div>

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
							<!--<p class="phone" ng-bind-html="result.phone" ng-show="result.phone != null">{{result.phone}}</p>-->
							<a class="phone" ng-bind-html="result.phone" ng-show="result.phone != null" title="Call {{result.city}} {{result.location}} location" href="tel:{{result.phone}}">{{result.phone}}</a>
						</div>
						<p class="hours" ng-bind-html="trimMarkup(result.hours)" ng-show="result.hours != null">{{result.hours}}</p>
						<!--<ul class="features">
							<li ng-repeat="feature in result.features" class="feature-icon" ng-class="getFeatureClass(feature)" title="{{getFeatureClass2(feature)}}" ng-style="getFeatureIconStyle(feature);" ></li>
						</ul>	-->
					</div>

				</div>
		
				<?php 
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post(); 
						
							if (get_field('show_holiday_message') == 'Show') { 						
								the_field('holiday_message');
							}
							
							the_content();
					} // end while
				} // end if
				?>				

				
				
				<?php the_content; ?>
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
