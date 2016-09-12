<?php
/*
Template Name: Food Page
*/
?>								
										
<?php get_header(); ?>
	<div class="main addPadding">
		<main role="main">
			<?php render_header();?>

			<div ng-app="foodPageApp" ng-controller="foodMenuCtrl">
				<section id="filter" class="centreColumn">
					<?php render_foodFilterData();?>

					<div class="container" ng-cloak ng-show="filtersAvailable()">
					  <div class="row">
					  	<div class="filter-holder">
								<h4 class="on-phone">Narrow It Down</h4>
					      <div class="filter {{item.filter}}" ng-cloak ng-repeat="item in filterDataProvider" ng-show="filterAvailable(item.filter);">
					        <button href="javascript:void(0);" ng-click="toggleFilter(item.filter);" class="button" ng-class="{selected: filters[item.filter]}">
					        	<span>{{item.label}}</span>
					        	<div class="icon {{item.filter}}"></div>
					        </button>
					      </div>
					      <span class="on-phone"><hr class="full"/></span>
					    </div>
					  </div>
					</div>
				</section>

				<?php render_foodData();?>

				<section id="foodList" class="centreColumn">
				
					<div class="disclaimer"><?php render_foodDisclaimer() ?></div>				
				
					<div class="container">
						<div class="row">
							<div class="category" ng-cloak ng-repeat="category in categories" ng-show="categoryItemsVisible(category);">
								<a name="{{category.anchor}}"></a>
								<div class="category-header">
									<h3 ng-cloak>{{category.title}}</h3>
									<p class="subheader" ng-cloak ng-show="category.subheader.length > 0;">{{category.subheader}}</p>
								</div>
								<div class="menuItem col-xs-12 col-sm-6" ng-repeat="item in category.items" ng-show="itemFiltered(item);">
									<div class="top-row row">
										<div class="food-text col-xs-12">
											<div class="food-title">{{item.title}}</div>
										</div>
										<div class="food-price col-xs-4" ng-show="item.price_sm.length > 0;" ng-bind-html="getPrice_sm(item);"></div>
										<div class="food-price col-xs-4" ng-show="item.price.length > 0;" ng-bind-html="getPrice(item);"></div>
										<div class="food-price col-xs-4" ng-show="item.price_lg.length > 0;" ng-bind-html="getPrice_lg(item);"></div>
										<div class="food-text col-xs-12">

											<div class="food-description" ng-bind-html="item.description"></div>
										</div>






									</div>
									<div class="bottom-row row">
										<div class="food-info">
											<button class="nutrition-btn" ng-click="showNutrition($event);" ng-cloak ng-show="item.nutrition.calories.length > 0;">Nutrition List</button>
											<ul class="filter-icons">
												<li class="favourites" ng-class="{on:hasFilter(item, 'favourites')}"></li>
												<li class="healthy" ng-class="{on:hasFilter(item, 'healthy')}"></li>
												<li class="new" ng-class="{on:hasFilter(item, 'new')}"></li>
											</ul>
										</div>
										<div class="food-nutrition-mask">
											<div class="food-nutrition">
												<button class="close-btn" ng-click="hideNutrition($event);"> X</button>
												<div class="nutrition-content">
													<p class="nutrition-title">Nutrition Facts</p>
													<p class="nutrition-serving">Per serving {{getServingValue(item);}}</p>
													<table class="nutrition-header">
														<tr>
															<th>Amount</th>
															<th class="align-right">% Daily Value</th>
															<th class="spacer">&nbsp;</th>
															<th>Amount</th>
															<th class="align-right">% Daily Value</th>
														</tr>
													</table>
													<table class="nutrition-items">
														<tr>
															<td colspan="2"><strong>Calories</strong>&nbsp;{{getValue(item, 'calories', 0);}}</td>
															<td class="spacer">&nbsp;</td>
															<td><strong>Sodium</strong>&nbsp;{{getValue(item, 'sodium', 0);}} mg</td>
															<td class="align-right percentage">{{getValue(item, 'sodium', 1);}}</td>
														</tr>
														<tr>
															<td><strong>Fat {{getValue(item, 'fat_total', 0);}} g</strong></td>
															<td class="align-right percentage">{{getValue(item, 'fat_total', 1);}}</td>
															<td class="spacer">&nbsp;</td>
															<td><strong>Carbohydrate</strong>&nbsp;{{getValue(item, 'carb_total', 0);}} g</td>
															<td class="align-right percentage">{{getValue(item, 'carb_total', 1);}}</td>
														</tr>
														<tr>
															<td class="indent no-border">Saturated {{getValue(item, 'fat_saturated', 0);}} g</td>
															<td class="align-right percentage" rowspan="2">{{getValue(item, 'fat_saturated', 1);}}</td>
															<td class="spacer">&nbsp;</td>
															<td class="indent">Fibre {{getValue(item, 'fibre', 0);}} g</td>
															<td class="align-right percentage">{{getValue(item, 'fibre', 1);}}</td>
														</tr>
														<tr>
															<td class="indent">+ Trans {{getValue(item, 'fat_trans', 0);}} g</td>
															<td class="spacer">&nbsp;</td>
															<td class="indent">Sugars {{getValue(item, 'sugars', 0);}} g</td>
															<td class="align-right">&nbsp;</td>
														</tr>
														<tr>
															<td colspan="2"><strong>Cholesterol {{getValue(item, 'cholesterol', 0);}} mg</strong></td>
															<td class="spacer">&nbsp;</td>
															<td colspan="2"><strong>Protein</strong> {{getValue(item, 'protein', 0);}} g</td>
														</tr>
														<tr class="vitamins">
															<td colspan="5" class="no-border">Vitamin A {{getValue(item, 'vitamin_a', 0);}} % • Vitamin C {{getValue(item, 'vitamin_c', 0);}} % • Calcium {{getValue(item, 'calcium', 0);}} % • Iron {{getValue(item, 'iron', 0);}} %</td>
														</tr>
													</table>

												</div>


											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					

				</section>
			</div>

			<section class="otherMenuItems centreColumn" ng-controller="OtherItemsCtrl">
				<?php render_otherItemData() ?>
				<h4>Other Menu Items</h4>
				<ul class="row">
					<li ng-repeat="item in otherItems" class="col-sm-4">
						<a href="javascript:void(0);" ng-click="navOtherItem(item.url);" ng-bind-html="item.title;"></a>
					</li>
				</ul>


			</section>

			<?php render_dividerRotatorData() ?>

			<section id="dividerRotator" class="dividerRotator" ng-app="DividerRotatorApp" ng-controller="DividerRotatorCtrl">
			
        <div class="divider-slides swiper-container" ng-style="getImageBK();">
          <div class="swiper-wrapper" >
            <div class="divider-slide swiper-slide" ng-repeat="slide in slides" init-rotator>
              <div class="rotator text-center">
                <div class="rotator-image"></div>
                <div class="rotator-content">
                  <div class="rotator-content-holder" ng-bind-html="slide.content"></div>
                </div>
              </div>
            </div>                
          </div>

        </div>	
       <div class="pagination">
        <button ng-repeat="slide in slides" ng-click="onPageButton($index);" ng-class="{active:(state.currentIndex == $index)}">&nbsp;</button>
       </div>              



			</section>


		</main>
	</div>			

<?//php get_sidebar(); ?>

<?php get_footer(); ?>
