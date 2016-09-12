<?php
/*
Template Name: Slots Page
*/
?>
<?php get_header(); ?>

	<main role="main">
		<!-- section -->

		<?php

		// $blocks = getCustomPosts('page_content_blocks');
		wp_reset_query();

		$pageData = get_post();
		$blocks = get_field('page_content_blocks', $pageData->ID);
		// var_dump($blocks);

		foreach ($blocks as $block) {
			$blockData = $block['content_block'];
			$id = $blockData->ID;
			$slotID = get_field('slot_id', $id);
			$slotType = get_field('type', $id);
			$slotData = get_field($slotType, $id);

			switch ($slotType) {
				case 'textImageBlock':
					render_textImageBlock_slot($slotID, $slotType, $slotData);
					break;
				case 'dividerBanner':
					render_dividerBanner_slot($slotID, $slotType, $slotData);
					break;
			}

			// var_dump($slotType);
			// var_dump($slotData);

		}


		 ?>
<!-- 		
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
 -->			
		<!-- /section -->
	</main>

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
