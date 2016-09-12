			<!-- footer -->
<?php

  $globalData = getGlobalData();

  $logo = get_field('menu_logo', $globalData->ID);
  $copyrightText = get_field('footer_copyright', $globalData);

  function renderFeaturedDishesTitle() {
    $title = getGlobalSetting('featured_dishes_title');
    if ($title) echo $title;
  }

  function renderFeaturedDishes() {
  	$items = getCustomPosts('featured_dish', null, null, 'order', 'ASC');
  	foreach ($items as $item) {
  		$image = get_field('image', $item->ID);
  		$title = get_field('title', $item->ID);
  		$url = get_field('url', $item->ID);
      $anchor = get_field('anchor', $item->ID);
      if (strlen($anchor) > 0) {
        $anchor = '#' . $anchor;
      }

  		echo "<div class=\"featured-dish col-xs-12 col-sm-4\">";
      echo  "<a href=\"{$url}{$anchor}\">";
  		echo   "<img src=\"{$image['url']}\"/>";
  		echo 	 "<div class=\"title\">$title</div>";
      echo  "</a>";
  		echo "</div>";

  	}
  }

  function renderPromoTiles() {
  	$items = getCustomPosts('footer_promo', null, null, 'order', 'ASC');
  	foreach ($items as $item) {
  		$cols = get_field('width', $item->ID);
  		$content = get_field('content', $item->ID);

  		echo "<div class=\"promo-tile col-xs-12 col-sm-$cols\">$content</div>";
  	}
  }

  function renderSocialLinks() {
  	$items = getCustomPosts('social_media', null, null, 'order', 'ASC');
  	foreach ($items as $item) {
  		$url = get_field('url', $item->ID);
  		$icon = get_field('icon', $item->ID);
      if (strlen($url) > 0) {
  		  echo "<li><a href=\"$url\" target=\"_blank\"><img src=\"{$icon['url']}\" alt=\"{$icon['alt']}\"/></a></li>";
      }
  	}
  }

 ?>

 			<div class="featured-dishes">
        <h5><?php renderFeaturedDishesTitle(); ?></h5>
 				<div class="container">
	 				<div class="row">
	 						<?php renderFeaturedDishes() ?>
	 				</div>
	 			</div>
 			</div>


 			<div class="footer-promos container">
 				<div class="row">
 						<?php renderPromoTiles() ?>
 				</div>
 			</div>


			<footer class="footer" role="contentinfo">
				<div class="container">
					<div class="row">
						<div class="col-sm-5 col-xs-12 info">
							<img class="logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt'];?>"/>
							<ul class="social">
								<?php renderSocialLinks() ?>
							</ul>
						</div>

						<div class="col-sm-7 col-xs-12 footerMenu-group">
							<?php renderFooterMenu() ?>
						</div>

					</div>

					<!-- copyright -->
					<p class="copyright">
						Copyright &copy; <?php echo date('Y') . ' ' . $copyrightText; ?>  
					</p>
					<!-- /copyright -->
					
				</div>


			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php //wp_footer(); ?>

		<!-- analytics -->

    <?php 
      $server = $_SERVER['SERVER_NAME'];      
      $ga_id;

      if (strpos($server, '192.168') !== false || strpos($server, 'tekkromancer') !== false) {
        $ga_id = 'UA-60580364-1';
      } else {
        $ga_id = 'UA-60580364-2';
      }

    ?>


		<script>

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function()
      { (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', '<?php echo $ga_id; ?>', 'auto');
      ga('send', 'pageview');
		</script>

	</body>
</html>
