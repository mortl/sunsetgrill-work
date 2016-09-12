<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>



	<main role="main">
		<!-- section -->
        
		<section id="home_modules">
			<?php render_gradientHeader('home_block_title'); ?>
			<?php render_homeModules() ?>
		</section>
		<!-- /section -->
	</main>


<?//php get_sidebar(); ?>

<?php get_footer(); ?>
