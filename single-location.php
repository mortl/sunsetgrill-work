<?php get_header(); ?>

<style>

h1 {
	padding: 25px 0;
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

</style>


	<main role="main">
	<!-- section -->
	<section id="location_search" class="centreColumn ng-scope" ng-controller="searchController">	

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post title -->
			<h1>
				<?php the_title(); ?>
			</h1>
			<!-- /post title -->

			<?php
				// check if the repeater field has rows of data
				if( have_rows('fully_executed_details') ):

					// loop through the rows of data
					while ( have_rows('fully_executed_details') ) : the_row();
 


					
					
?>
<?php 

$file = get_sub_field('site_plan');

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
	
	?>

<?php endif; ?>

					
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Lato-Light, Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:14px;padding:10px 5px;border-style:ridge;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Lato-Light, Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:ridge;border-width:1px;overflow:hidden;word-break:normal;}
</style> 
<table class="tg">
  <tr>
    <th class="tg-031e">Possession</th>
    <th class="tg-031e"><?php the_sub_field('possession'); ?></th>
  </tr>
  <tr>
    <td class="tg-031e">Square Footage</td>
    <td class="tg-031e"><?php the_sub_field('square_footage'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Net Rent</td>
    <td class="tg-031e"><?php the_sub_field('net_rent'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">TMI</td>
    <td class="tg-031e"><?php the_sub_field('tmi'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Tenant Allowance</td>
    <td class="tg-031e"><?php the_sub_field('tenant_allowance'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Fixturing Period</td>
    <td class="tg-031e"><?php the_sub_field('fixturing_period'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Free Net Rent</td>
    <td class="tg-031e"><?php the_sub_field('free_net_rent'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Term</td>
    <td class="tg-031e"><?php the_sub_field('term'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Renewal Option</td>
    <td class="tg-031e"><?php the_sub_field('renewal_option'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Indemnification</td>
    <td class="tg-031e"><?php the_sub_field('indemnification'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Exclusivity</td>
    <td class="tg-031e"><?php the_sub_field('exclusivity'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Pylon</td>
    <td class="tg-031e"><?php the_sub_field('pylon'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Patio</td>
    <td class="tg-031e"><?php the_sub_field('patio'); ?></td>
  </tr>
  <tr>
    <td class="tg-031e">Site Plan</td>
    <td class="tg-031e">
		<a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
			<img src="<?php echo $icon; ?>" />
			<span><?php echo $title; ?></span>
		</a>	
	</td>
  </tr>
  <tr>
    <td class="tg-031e">Notes</td>
    <td class="tg-031e"><?php the_sub_field('notes'); ?></td>
  </tr>
</table>					
					
					
<?php					
					

					endwhile;

				endif;			
			?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>



	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>


<?php  get_footer(); ?>
