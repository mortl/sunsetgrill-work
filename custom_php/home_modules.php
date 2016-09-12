<?php
function render_homeModules() {
  wp_reset_query();
  $pageData = get_post();
  $items = get_field('modules', $pageData->ID);
  $i = 1;

  foreach ($items as $item) {
    ?>
    <!-- <div class="module module_<?php echo $i; ?>" style="background-image:url('<?php echo $item['image']['url'];?>');"> -->
    <div class="module module_<?php echo $i; ?>" style="background-image:url('<?php echo $item['image']['url'];?>');" >
        <!--<div class="module_background">
        	<img src="<?php echo $item['image']['url'];?>"/>
        </div>-->
        <div class="module_content">
        	<?php echo $item['content'];?>
        </div>
    </div>
    <?php
    $i++;
  }

  wp_reset_query();

}

/*
    <div class="module module_<?php echo $i; ?>">
      <!-- <div class="module-holder"> -->
        <div class="content-holder">
          <img src="<?php echo $item['image']['url'];?>"/>

<!--           <div class="content">
            <?php echo $item['content'];?>
          </div>
 -->          
 <!--        </div> -->
      </div>
      <!-- <div class="clearfix"></div> -->
    </div>

*/


  
