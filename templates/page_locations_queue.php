<?php
/*
Template Name: Locations Page - Queue
*/
?>
<?php  get_header(); ?>

	<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}

	.TextMenuBold {
		font-family: Lato-Light, Arial, 'Helvetica Neue', Helvetica, sans-serif;
		font-size: 36px;
		color: #1f1f1f;
		margin: 0;		
		
	}	
	
	.tg {
		
		margin: auto;
		margin-bottom: 60px;
	}
	table.tg td,
	table.tg th {
		border-width: 0;
	}

	tr {
		border-bottom: 1px solid black;
	}
	
	#location_search {		
		padding: 50px;
	}	
	
	</style>	
					
	<div class="main addPadding" ng-app="currentLocationsApp">
		<main role="main">			 
			<section id="location_search" class="centreColumn" ng-controller="searchController">	

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<?php				
// must add field key of the field you want
        $field_key = "field_5602cc9770153";
        $field = get_field_object($field_key);

        if( $field )
        {
            echo '<div class="acf-task-difficulty-values">';
                foreach( $field['choices'] as $k => $v )
                {
				
				
					$args = array( 
						'post_type' => 'location', 
						'posts_per_page' => 10, 
						'orderby' => 'ID', 
						'order' => 'ASC' ,
						'meta_query'	=> array(						
							'relation'		=> 'AND',
								array(
									'key'	 	=> 'status',
									'value'	  	=> 'queue',
								),
								array(
									'key'	  	=> 'province',
									'value'	  	=> $v,
								),
							),
					);	
					
					$loop = new WP_Query( $args );					
					$count = $loop->post_count; 
					
					if ($count > 0) {					
					
						echo '<br><div class="TextMenuBold">'. $v .'</div><br>';
						echo  'The following list is the current queue status for ' . $v .'.<br>';
						?>

						<table class="tg" border="0">
						  <tr>
							<th class="tg-031e">#</th>
							<th class="tg-031e">Name</th>
							<th class="tg-031e">Prefered Cities</th>
						  </tr>
						
						<?php					
						
						while ( $loop->have_posts() ) : $loop->the_post();							
							
						?>
							  <tr>
								<td class="tg-031e"><?php the_ID(); ?> </td>
								<td class="tg-031e"><?php echo get_field( "owners_names" ); ?></td>
								<td class="tg-031e"><?php echo get_field( "city" ); ?></td>
							  </tr>					  
						<?php					
						
						endwhile;	
						echo '</table>';
					
					}
                }			
            
            echo '</div>';			
        }				
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



<?php  get_footer(); ?>
