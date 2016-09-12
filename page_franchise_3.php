<?php
/*
Template Name: Franchise Page 3
*/
?>
<?php get_header(); ?>
	<div class="main addPadding">
		<main role="main">


			<section id="franchise_submenu" class="centreColumn">
				<div class="container">
					<?php render_gradientHeader('franchise_application_1') ?>
					<?php render_franchiseSubmenu() ?>
				</div>
			</section>

			<section id="columns_1" class="centreColumn">
				<div class="container">
					<?php render_columnContent('franchise_application_1') ?>
				</div>
			</section>

			<!--<section id="dividerBanner_1">
				<?php // commenting out 3 sections as per SGR-249
				//render_dividerBanner('franchise_application_1'); ?>
			</section>-->


			<!--
			<section id="textImage_block_2">1
				<?php render_textImageBlock('franchise_application_1') ?>
			</section>
			-->

			<!---->
			<section id="dividerBanner_2">2
				<?php render_dividerBanner('franchise_application_2'); ?>
			</section>
			

			<!--
			<section id="dividerBanner_3">
				<?php render_dividerBanner('franchise_application_3'); ?>
			</section>
			-->

				
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
