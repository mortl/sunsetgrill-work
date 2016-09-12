<?php
/*
Template Name: Franchise Page 2
*/
?>
<?php get_header(); ?>
	<div class="main addPadding">
		<main role="main">


			<section id="franchise_submenu" class="centreColumn">
				<div class="container">
					<?php render_gradientHeader('franchise_structure_1') ?>
					<?php render_franchiseSubmenu() ?>
				</div>
			</section>

			<section id="columns_1" class="centreColumn">
				<div class="container">
					<?php render_columnContent('franchise_structure_1') ?>
				</div>
			</section>

		<!--	<section id="dividerBanner_1">
				<?php render_dividerBanner('franchise_structure_1'); ?>
			</section>  -->



			<section id="textImage_block_1">
				<?php render_textImageBlock('franchise_structure_1') ?>
			</section>			



		<!--	<section id="dividerBanner_2">
				<?php render_dividerBanner('franchise_structure_2'); ?>
			</section> -->
			
			<section id="columns_2" class="centreColumn">
				<div class="container">
					<?php render_gradientHeader('franchise_structure_2') ?>
					<?php render_columnContent('franchise_structure_2') ?>
					<?php render_columnContent('franchise_structure_3') ?>
				</div>
			</section>


		<!--	<section id="textImage_block_2">
				<?php render_textImageBlock('franchise_structure_2') ?>
			</section>				

			<section id="dividerBanner_3">
				<?php render_dividerBanner('franchise_structure_3'); ?>
			</section>  -->

				
			<!-- /section -->
            <section id="franchise_submenu" class="centreColumn bottomCentreColumn">
				<div class="container">
					<?php render_franchiseSubmenu() ?>
				</div>
			</section>
		</main>
	</div>			

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
