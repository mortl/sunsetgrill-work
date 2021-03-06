<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel='stylesheet' href='<?php echo get_stylesheet_directory_uri();?>/css/non-sass.css'>
    <?php gravity_form_enqueue_scripts( 1, true ); ?>
		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

        <?php render_menuData() ?>


	</head>
	<body <?php body_class('ng-cloak'); ?> ng-app="MainApp">
    <!--<div class="devices">
        <div class="phone">Phone</div>
        <div class="tablet">Tablet</div>
        <div class="desktop">Desktop</div>
        <!-- <div class="device-size">{{'[' + viewRules.deviceSize + ']'}}</div> -->
    <!--</div>-->
    
    <div class="breakpoint-indicator hidden">
      <div class="breakpoint-text"></div>
    </div>
    <div class="wrapper">
      <!-- header -->
      <header class="header clear" role="banner">


        <?php 
          /*
           * Determine the slug for the page
           */
          $pagePost = get_post( $post_id );
          $slug = $pagePost->post_name;

          if ($slug == 'home-page') {
            $rotator = getCustomPost('masthead_rotator');
            $items = get_field('slides', $rotator->ID);

            $js = "";
            // $js .= "<pre style=\"margin-top:100px\">";
            $js .= "<script>";
            $js .= "var rotatorData = [";
            
            foreach ($items as $item) { 
              $image = $item['main_image'];
              $plateImage = $item['plate_image'];
              $content = snip($item['content']);

              $js .= "{";
              $js .= "content:'$content',";
              $js .= "image:{url:'{$image['url']}', alt:'{$image['alt']}'},";
              $js .= "plateImage:{url:'{$plateImage['url']}', alt:'{$plateImage['alt']}'},";
              $js .= "},";
            }

            $js .= "];";

            // $js .= "console.log('rotatorData', rotatorData);";
            // $js .= "</pre>";
            $js .= "</script>";

            echo $js;
            ?>

            <section ng-app="HomeRotator" ng-controller="HomeRotatorCtrl" data-module="home_rotator">
              <div class="home-slides swiper-container">
                <div class="swiper-wrapper" >
                  <div class="home-slide swiper-slide" ng-repeat="slide in slides" init-rotator>
                    <div class="masthead text-center">
                      <div class="masthead-image" ng-style="getImageBK(slide);"></div>
                      <div class="masthead-content">
                        <div class="masthead-content-holder" ng-bind-html="slide.content"></div>
                      </div>
                    </div>
                  </div>                
                </div>

   
              </div>

             <div class="pagination">
              <button ng-repeat="slide in slides" ng-click="onPageButton($index);" ng-class="{active:(state.currentIndex == $index)}">&nbsp;</button>
             </div>              


              <!--
              <div class="plates">
                <div class="plate-holder">
                  <img class="plate" ng-repeat="slide in slides" ng-src="{{slide.plateImage.url}}" ng-show="state.currentIndex == $index"/>
                </div>
              </div>
            -->

            <?php

            wp_reset_query();
            $pageData = get_post();
            $items = get_field('top_buckets', $pageData->ID);

            $leftBucketData = $items[0];
            $rightBucketData = $items[1];


            ?>

              <div class="plateContainer">
			  	<div class="plateWrapper" data-module-role="plate">
                	<img class="plate" ng-repeat="slide in slides" ng-src="{{slide.plateImage.url}}" ng-show="state.currentIndex == $index"/>
             	</div>
			  </div>

              <section class="cta-section">
                <div class="centreColumn">
                  <div class="group left" data-module-role="left_text">
                    <?php echo $leftBucketData['content'];?>
                    <div class="btn-holder">
                      <!-- <a href="<?php echo $leftBucketData['cta_url'];?>" class="btn"><?php echo $leftBucketData['cta_label'];?></a> -->
                      <a href="javascript:void(0);" onclick="Tracker.trackHomePageBucket(0, '<?php echo $leftBucketData['cta_url'];?>');" class="btn"><?php echo $leftBucketData['cta_label'];?></a>
                    </div>
                  </div>
                  <div class="group plate-cell">
                    <!--
                    <div class="plate-holder">
                      <img class="plate" ng-repeat="slide in slides" ng-src="{{slide.plateImage.url}}" ng-show="state.currentIndex == $index"/>
                    </div>
                  -->
                  </div>
                  <div class="group right" data-module-role="right_text">
                    <?php echo $rightBucketData['content'];?>
                    <div class="btn-holder">
                      <!-- <a href="<?php echo $rightBucketData['cta_url'];?>" class="btn"><?php echo $rightBucketData['cta_label'];?></a> -->
                      <a href="javascript:void(0);" onclick="Tracker.trackHomePageBucket(1, '<?php echo $rightBucketData['cta_url'];?>');" class="btn"><?php echo $rightBucketData['cta_label'];?></a>

                    </div>
                  </div>
                </div>
              </section>
            </section>



          <?php 
          } else {


            /*
             * Prepare the masthead
             */
            $title = 'No Masthead Defined';
            $subtitle = '';

            $post_name = $pagePost->post_name;

            $mastheads = getCustomPosts('masthead');
            $post;
            if ($post_name == null) {
              $post_name = '404-page-not-found';
            }


            foreach($mastheads as $masthead) {
              $id = $masthead->ID;
              $page = get_field('page', $id);
              if (strpos($page, $post_name) !== false) {
                $post = $masthead;
                break;
              }
            }

          
            // $post = getCustomPost('masthead', 'page_slug', $slug);
            // $post = getCustomPost('masthead', 'page_slug', $slug);

            // Set values
            if ($post) {
              $content = get_field('content');
              $image = get_field('masthead_image');
            } else {
              $post = getCustomPost('masthead', 'page_slug', 'about-us');
              $content = get_field('content');
              $image = get_field('masthead_image');
              
            }

            wp_reset_query();

            ?>

            <div class="masthead text-center" >
              <div class="masthead-image" style="background-image:url('<?php echo $image;?>');"></div>
              <div class="masthead-content" >
                <div class="masthead-content-holder">
                  <?php echo $content ?>
                </div>
              </div>

            </div>

          <?php } ?>


        <!-- nav -->
        <div class="nav-container">
          <div class="nav-holder on-desktop">
            <nav class="nav collapsed" role="navigation">
              <?php renderMenu() ?>

              <div class="submenu-mask hidden">
                <div class="submenu-holder">
                  <a href="javascript:void(0);" class="close-btn"></a>
                </div>
              </div>
            </nav>
          </div>

          <div class="nav-holder on-phone on-tablet">
            <nav class="navbar navbar-default bootstrap">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <?php
                    $logo = getGlobalSetting('menu_logo');
                  ?>
                  <a class="navbar-brand" href="<?php bloginfo('url')?>"><div class="menu-logo"><img src="<?php echo $logo['url'];?>"></div></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <?php renderBootstrapMenu()?>
                  </ul>
                  
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>



          </div>
        </div>
        <!-- /nav -->

      </header>
      <!-- /header -->


		
