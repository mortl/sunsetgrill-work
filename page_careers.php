<?php
/*
Template Name: Careers Page
*/
?>
<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section id="careers_textImage_block">
			<?php
			  render_textImageBlock('careers_1');
			?>
		</section>
		
		
		<section id="careers_positions" class="centreColumn">
			<?php render_gradientHeader('careers_2') ?>
			<?php render_columnContent('careers_1') ?>
			<?php render_jobPositions() ?>
		</section>
		
		
		<section id="careers_dividerBanner">
			<?php
					render_dividerBanner('careers_1');
			?>
		</section>

		<section id="careers_currentOpportunities" class="centreColumn">
			<?php //render_gradientHeader('careers_1') ?>
			<?php //render_jobOpportunities() ?>


		</section>





			
		<!-- /section -->
	</main>

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
