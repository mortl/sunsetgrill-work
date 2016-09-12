<?php
function render_gradientHeader($slotID) {
  $image = '';
  // $spacingClass = $topSpacing ? 'topSpacing' : '';
  $post = getCustomPost('gradient_header', 'slotID', $slotID);

  if ($post) {
    $text = get_field('text');
  }

  // echo "<h2 class=\"gradientHeader $slotID $spacingClass\"><strong>$text</strong></h2>";
  echo "<h2 class=\"gradientHeader $slotID\"><strong>$text</strong></h2>";
  // echo "<gradient-header id=\"gh_" . $slotID . "\" slot-class=\"" . $slotID . "\" text=\"" . $text . "\" size=\"48\"></gradient-header>";
/*
  $markup = "";
  $markup .= "<h2 class=\"svg_gradientHeader\">";
  $markup .= "<svg class=\"svg_gradientHeader invisible\" xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\">";
  $markup .= "<defs>";
  $markup .= "<linearGradient id=\"grad1\" x1=\"0%\" y1=\"0%\" x2=\"0%\" y2=\"100%\">";
  $markup .= "<stop offset=\"0%\" style=\"stop-color:#FF6600;stop-opacity:1\" />";
  $markup .= "<stop offset=\"100%\" style=\"stop-color:#FFF000;stop-opacity:1\" />";
  $markup .= "</linearGradient>";
  $markup .= "</defs>";
  $markup .= "<text fill=\"url(#grad1)\" alignment-baseline=\"hanging\" font-size=\"48\" font-family=\"Oswald-Light\" x=\"0\" y=\"0\">";  $markup .= $text;
  $markup .= "</text>";
  $markup .= "</svg>";
  $markup .= "</h2>";

  echo $markup;
*/
 

  wp_reset_query();
}
/*
function render_gradientHeaderText($text) {
  // echo "<h2 class=\"gradientHeader $spacingClass\"><strong>$text</strong></h2>";

  $markup = "";
  $markup .= "<h2 class=\"svg_gradientHeader\">";

  $markup .= "<svg class=\"invisible\" xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\">";
  $markup .= "<defs>";
  $markup .= "<linearGradient id=\"grad1\" x1=\"0%\" y1=\"0%\" x2=\"0%\" y2=\"100%\">";
  $markup .= "<stop offset=\"0%\" style=\"stop-color:#FF6600;stop-opacity:1\" />";
  $markup .= "<stop offset=\"100%\" style=\"stop-color:#FFF000;stop-opacity:1\" />";
  $markup .= "</linearGradient>";
  $markup .= "</defs>";
  $markup .= "<text fill=\"url(#grad1)\" alignment-baseline=\"hanging\" font-size=\"48\" font-family=\"Oswald-Light\" x=\"0\" y=\"0\">";
  $markup .= $text;
  $markup .= "</text>";
  $markup .= "</svg>";
  $markup .= "</h2>";

  echo $markup;  
}

*/
