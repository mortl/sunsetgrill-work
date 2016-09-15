<?php
/*
Template Name: Locations Page - view all open locations
*/


$args = array(
	'post_type'=> 'location',
	'posts_per_page' => -1,	
	'meta_key'  => 'city',	
	'orderby' => 'meta_value',	
	'order'    => 'ASC',
	'meta_query'	=> array(						
		//'relation'		=> 'OR',
			array(
				'key'	 	=> 'status',
				'value'	  	=> 'open ',
			),
			/*array(
				'key'	  	=> 'status',
				'value'	  	=> 'fully_executed ',
			),*/
		),
);


?>

<?php get_header(); ?>
	<div class="main addPadding" ng-app="currentLocationsApp">
		<main role="main">	

			<section id="location_search" class="centreColumn" ng-controller="searchController">
			<div class="results row" >
			
			<?php
         //By Martin Benes
         //counter for the ids        
			    $id_counter = 0;
			   //End
        
				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) {
					echo '<ul>';
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
	  
            
            //This increments the counter
            //everytime the loop runs
						$id_counter++;
            
            //I then print the counter in 2 locations. 
            //They are below if you see the echo $id_counter statments.

						//echo '<li>' . get_field('city') . '</li>';
						//echo '<li>' . get_the_title() . '</li>';
						?>
							
								<div class="location-tile col-xs-6 col-md-4">
									<div class="address-block">
                    
										<h5 id="header-<?php echo $id_counter ?>"><?php echo get_field('city'); ?></h5>
										<h6><?php echo get_field('location'); ?></h6>
										<hr/>
										<p class="address"><?php echo get_field('address'); ?></p>
										<!--<p class="phone"><?php echo get_field('phone'); ?></p>-->
										<a class="phone"  href="tel:<?php echo get_field('phone'); ?>" title="Call <?php echo get_field('address'); ?> location"><?php echo get_field('phone'); ?></a>
									</div>
									<p class="hours" id="hours-<?php echo $id_counter?>"><?php echo get_field('hours'); ?></p>			
								</div>
												
						
						<?php
						
						
					}
					echo '</ul>';
				} else {
					// no posts found
				}
				// Restore original Post Data 
				wp_reset_postdata();
			
			
			
			?>
			</div>	
			
			
			
			
			
			
			
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
					</div>
				</div>

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
