<?php
/*
Template Name: About - Charity Page
*/
?>
<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section id="about_textImage_block">
			<?php
				// doesn't appear to exist according to the copy deck
			  //render_textImageBlock('about_charity_1') 
			?>
		</section>

		<section id="about_dividerBanner">
			<?php
				// doesn't appear to exist according to the copy deck
				//render_dividerBanner('about_charity_1') ?>
		</section>

		<section id="charities" ng-controller="CharityCtrl">
			<?php render_gradientHeader('about_charity_1') ?>
			<?php render_charityData() ?>

		  <div class="container">
		  	<div class="row">

				  <div class="charity-tile col-xs-12 col-sm-6" ng-repeat="item in dataProvider|limitTo:itemsToShow">
					  <img ng-src="{{item.image}}" alt="{{item.alt}}">
					  <div class="content" ng-bind-html="item.content"></div>
				  </div>  		

		  	</div>
		  </div>
		  <div class="btn-holder">
		  	<button class="btn btn-rev full" ng-cloak ng-show="dataProvider.length > itemsToShow" ng-click="loadNextPage();">Load More</button>
		  </div>

			<?//php render_charityTiles() ?>
		</section>



			
		<!-- /section -->
	</main>

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
