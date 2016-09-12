<?php
/*
Template Name: About - About Page
*/
?>
<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section id="about_textImage_block_1">
			<?php render_textImageBlock('about_about_1') ?>
		</section>

		<section id="about_dividerBanner_1">
			<?php render_dividerBanner('about_about_1') ?>
		</section>
			
		<section id="about_timeline">
			<div class="container">
				<?php render_gradientHeader('about_about_1') ?>

				<?php render_timeline() ?>


			</div>

		</section>
			
		<!-- /section -->
	</main>

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
