<?php
function render_textImageBlock($slotID) {

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

  $post = getCustomPost('text_image_block', 'slotID', $slotID);
  // Set values
  if ($post) {
    if (get_field('is_copy')) {
      $original = get_field('original');
      $post = getCustomPost('text_image_block', 'slotID', $original);
    }

    $content = get_field('content');
    $image = get_field('text_image__image');
    $textSide = get_field('text_image__textSide');
    $side_class = $textSide == 'right' ? 'text-right' : 'text-left';
  
  // echo "<div class=\"textImageBlock $side_class\">";
  // echo  "<div class=\"textImageBlock-image\" style=\"background-image:url('$image');\"></div>";
  // echo  "<div class=\"textImageBlock-content textContent\">$content</div>";
  // echo "</div>";

    echo "<div class=\"textImageBlock $side_class\">";
      
      echo  "<div class=\"textImageBlock-content textContent\">$content</div>";
	  echo  "<div class=\"textImageBlock-image\" style=\"background-image:url('$image');\"></div>";

  /*
    if ($textSide == 'left') {
      echo  "<div class=\"textImageBlock-content textContent\">$content</div>";
      echo  "<div class=\"textImageBlock-image\" style=\"background-image:url('$image');\"></div>";
    } else {
      echo  "<div class=\"textImageBlock-image\" style=\"background-image:url('$image');\"></div>";
      echo  "<div class=\"textImageBlock-content textContent\">$content</div>";
    }
  */  
    echo "</div>";
  }

  wp_reset_query();
}


  
function render_textImageBlock_slot($id, $type, $data) {
  $postID = $data->ID;
  $elementID = $type . '_' . $id;

  $content = get_field('content', $postID);
  $image = get_field('text_image__image', $postID);
  $textSide = get_field('text_image__textSide', $postID);

  $side_class = $textSide == 'right' ? 'text-right' : 'text-left';

  $markup = "";

  $markup .= "<div id=\"$elementID\" class=\"$type $id $side_class\">";
  if ($textSide == 'left') {
    $markup .=  "<div class=\"textImageBlock-content textContent\">$content</div>";
    $markup .=  "<div class=\"textImageBlock-image\" style=\"background-image:url('$image');\"></div>";
  } else {
    $markup .=  "<div class=\"textImageBlock-image\" style=\"background-image:url('$image');\"></div>";
    $markup .=  "<div class=\"textImageBlock-content textContent\">$content</div>";
  }
  $markup .= "</div>";

  echo $markup;

}
