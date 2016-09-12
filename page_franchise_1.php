<?php
/*
Template Name: Franchise Page 1
*/
?>

<?php get_header(); ?>
	<div class="main addPadding">
		<main role="main">

			<section id="franchise_submenu" class="centreColumn">
				<div class="container">
					<?php render_gradientHeader('franchise_about_1') ?>
					<?php render_franchiseSubmenu() ?>
				</div>
			</section>

			<section id="textImage_block_1">
				<?php render_textImageBlock('franchise_about_1') ?>
			</section>

			<section id="textImage_block_2">
				<?php render_textImageBlock('franchise_about_2') ?>
			</section>	


			<section id="dividerBanner_1">
				<?php render_dividerBanner('franchise_about_1'); ?>
			</section>	

			<section id="columns_1 centreColumn">
				<div class="container">
					<?php render_gradientHeader('franchise_about_2', true) ?>
					<?php render_columnContent('franchise_about_1') ?>
				</div>
			</section>


			<section id="dividerBanner_2">
				<?php render_dividerBanner('franchise_philosophy_1'); ?>
			</section>
			<?php /*
			<section id="dividerBanner_3">
				<?php render_dividerBanner('franchise_about_2'); ?>
			</section>
			*/ ?>

			<?php /*
			<section id="textImage_block_3">
				<?php render_textImageBlock('franchise_about_3') ?>
			</section>		
			*/ ?>

			<section id="dividerBanner_4">
				<?php render_dividerBanner('franchise_about_3'); ?>
			</section>

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