<?php
/*
Template Name: Locations Page - Realestate
*/
?>
<?php  get_header(); ?>

	<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	
	#location_search {		
		padding: 50px;
	}
	
	.realestate-item {
		
		padding-left: 30px;
	}
	
	.TextMenuBold {
		font-family: Lato-Light, Arial, 'Helvetica Neue', Helvetica, sans-serif;
		font-size: 36px;
		color: #1f1f1f;
		margin: 0;		
		
	}
	
	</style>	
					
	<div class="main addPadding" ng-app="currentLocationsApp">
		<main role="main">			 
			<section id="location_search" class="centreColumn" ng-controller="searchController">	

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php
				
				$top =  get_field( "top_editor" );
				$bottom =  get_field( "second_editor" );

				echo $top;
				
					$args = array( 
						'post_type' => 'location', 
						'posts_per_page' => 10, 
						'orderby' => 'ID', 
						'order' => 'ASC' ,
						'meta_query'	=> array(						
							'relation'		=> 'AND',
								array(
									'key'	 	=> 'status',
									'value'	  	=> 'fully_executed',
								),

							),
					);	
					
					$loop = new WP_Query( $args );					
					$count = $loop->post_count; 				
					
						
					while ( $loop->have_posts() ) : $loop->the_post();							
							
													
						$city =  get_field( "city" ); 
						$loc =  get_field( "location" ); 
						
						echo '<span class="realestate-item">'. $city .' - <a href="' . get_post_permalink() . '" >' . $loc . '</a></span><br>';
					  
											
					endwhile;
				?>
<br>



				<?php
				
				echo $bottom;
				

					$args = array( 
						'post_type' => 'location', 
						'posts_per_page' => 10, 
						'orderby' => 'ID', 
						'order' => 'ASC' ,
						'meta_query'	=> array(						
							'relation'		=> 'AND',
								array(
									'key'	 	=> 'status',
									'value'	  	=> 'open',
								),
								array(
									'key'	 	=> 'for_sale',
									'value'	  	=> 1,
								),

							),
					);	
					
					$loop = new WP_Query( $args );					
					$count = $loop->post_count; 				
					
						
					while ( $loop->have_posts() ) : $loop->the_post();							
							
						$file = get_field('pdf');

						if( $file ): 

							// vars
							$url = $file['url'];
							$title = $file['title'];
							$caption = $file['caption'];	

							// icon
							$icon = $file['icon'];
							
							if( $file['type'] == 'image' ) {		
								$icon =  $file['sizes']['thumbnail'];		
							}	
						endif;	
												
						$city =  get_field( "city" ); 
						$loc =  get_field( "location" ); 
						
						echo $city; ?> - 
							<a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
								<span><?php echo $title; ?></span>
							</a>							
						<?php
						echo '<br>';
											
					endwhile;
				?>


			
				<br class="clear">
				<?php // edit_post_link(); ?>
			</article>
			<!-- /article -->
		<?php endwhile; ?>
		<?php endif; ?>		 
		 
		 </section>
		</main>
	</div>			 

<?php // get_footer(); ?>