<?php

function render_charityData() {
  $items = getCustomPosts('charity_event', null, null, 'order', 'DESC', true);

  $js = "";
  $js .= "<script>";
  $js .= "var charityDataProvider = [";

  foreach ($items as $item) {

    $image = get_field('image', $item->ID);
    $image_url = $image['url'];
    $image_alt = $image['alt'];
    $content = get_field('content', $item->ID);
    $content = snip($content);

    $js .= "{content:'$content', image:'$image_url', alt:'$image_alt'},";
  }

  $js .= "];";
  // $js .= "console.log('charityDataProvider', charityDataProvider);";
  $js .= "</script>";

  echo $js;

}

function render_charityTiles() {
  //global $post;

  /*
   * Prepare the text/image block
   */
  $content = '<h1>No Content Defined</h1>';
  $image = '';
  
  $posts = getCustomPosts('charity_event', null, null, 'order', 'DESC', true);
  // var_dump($posts);



  echo "<div class=\"container\">";
  echo  "<div class=\"row\">";
  foreach ($posts as $post) {
    render_charityTile($post);

  }
  echo   "</div>";
  echo  "</div>";

  wp_reset_query();
}

function render_charityTile($post) {
  $image = get_field('image', $post->ID);
  $image_url = $image['url'];
  $image_alt = $image['alt'];
  $image_title = $image['title'];

  $content = get_field('content', $post->ID);
  echo "<div class=\"charity-tile col-xs-12 col-sm-6\">";
  echo  "<img src=\"$image_url\" alt=\"$image_alt\" title=\"$image_title\">";
  echo  "<div class=\"content\">";
  echo    $content;
  echo  "</div>";
  echo "</div>";

}
  
