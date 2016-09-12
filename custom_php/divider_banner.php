<?php
function render_dividerBanner($slotID) {
  //global $post;

  /*
   * Determine the slug for the page
   */
  $pagePost = get_post( $post_id );
  $pageSlug = $pagePost->post_name;

  /*
   * Prepare the text/image block
   */
  $content = '<h1>No Content Defined</h1>';
  $image = '';

  $post = getCustomPost('divider_banner', 'slotID', $slotID);

  // Set values
  if ($post) {
    if (get_field('is_copy')) {
      $original = get_field('original');
      $post = getCustomPost('divider_banner', 'slotID', $original);
    }
    
    $content = get_field('content');
    $image = get_field('image');
    $hasCTAButton = get_field('has_cta_button');
    $ctaLabel = get_field('cta_button_label');
    $ctaType = get_field('cta_link_type');
    $ctaURL = get_field('cta_url');
    // $ctaPage = get_field('cta_page');
    // $ctaFile = get_field('cta_file');

    if ($ctaType == 'page') {
      $ctaURL = get_field('cta_page');
    } else if ($ctaType == 'file') {
       $ctaURL = get_field('cta_file');
    }
    


    $ctaWindow = get_field('cta_window');
    $backgroundType = get_field('background_type');

    $forceButtonLegibility = get_field('force_btn_legibility');
    $btnLegibilityClass = $forceButtonLegibility ? 'force-legible' : '';

    $backgroundColour = get_field('background_colour');
    $size = get_field('text_size');
    $sizeClass;
    if ($size == 'small') {
      $sizeClass = 'text-small';
    } else if ($size == 'large') {
      $sizeClass = 'text-large';
    } else {
      $sizeClass = 'text-large';
    }

  }

  echo "<div class=\"dividerBanner $slotID\">";
  if ($backgroundType == 'image') {
    echo  "<div class=\"dividerBanner-image\" style=\"background-image:url('$image');\"></div>";
  } else {
    echo  "<div class=\"dividerBanner-image\" style=\"background-color:$backgroundColour;\"></div>";
  }
  echo   "<div class=\"dividerBanner-content $sizeClass\">";
  echo    "<div class=\"dividerBanner-content-holder\">";
  echo     $content;
  if ($hasCTAButton) {  
    if ($ctaType == 'page') {
	  echo   "<a class=\"dividerBanner-button $btnLegibilityClass\" href=\"$ctaURL\" target=\"$ctaWindow\">$ctaLabel</a>";
    } else if ($ctaType == 'file') {
	    echo   "<a class=\"dividerBanner-button $btnLegibilityClass\" href=\"$ctaURL[url]\" target=\"$ctaWindow\">$ctaLabel</a>";
    }   
  }
  echo    "</div>";
  echo   "</div>";
  echo  "</div>";

  wp_reset_query();
}


  
function render_dividerBanner_slot($id, $type, $data) {
  $postID = $data->ID;
  $elementID = $type . '_' . $id;

  // Slot-Specific Values
  $content = get_field('content', $postID);
  $image = get_field('image', $postID);
  $hasCTAButton = get_field('has_cta_button', $postID);
  $ctaLabel = get_field('cta_button_label', $postID);
  $ctaURL = get_field('cta_url', $postID);
  $ctaWindow = get_field('cta_window', $postID);
  $backgroundType = get_field('background_type', $postID);
  $backgroundColour = get_field('background_colour', $postID);
  $size = get_field('text_size', $postID);
  $sizeClass;
  if ($size == 'small') {
    $sizeClass = 'text-small';
  } else if ($size == 'large') {
    $sizeClass = 'text-large';
  }

  // Markup
  $markup = "";
  
  // TODO: remove inline style (move to CSS)
  $markup .= "<div id=\"$elementID\" class=\"$type $id\" style=\"height:300px;\">"; 
  if ($backgroundType == 'image') {
    $markup .=  "<div class=\"dividerBanner-image\" style=\"background-image:url('$image');\"></div>";
  } else {
    $markup .=  "<div class=\"dividerBanner-image\" style=\"background-color:$backgroundColour;\"></div>";
  }
  $markup .=   "<div class=\"dividerBanner-content $sizeClass\">";
  $markup .=    "<div class=\"dividerBanner-content-holder\">";
  $markup .=     $content;
  if ($hasCTAButton) {
    $markup .=   "<a class=\"dividerBanner-button\" href=\"$ctaURL\" target=\"$ctaWindow\">$ctaLabel</a>";
  }
  $markup .=    "</div>";
  $markup .=   "</div>";
  $markup .=  "</div>";  

  echo $markup;

}
