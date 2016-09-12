<?php

function render_timeline() {
  // $items = getCustomPosts('milestone', null, null, 'timeline_date', 'ASC');
  $items = getCustomPosts('milestone', null, null, 'post_title', 'ASC');
  //echo "<pre>";
  //print_r($items);
  //echo "</pre>";
  
  $markup = "";

  /********************
  * Timeline
  ********************/
  $markup .= "<div class=\"timeline-timeline\">";
  $markup .=   "<a href=\"javascript:void(0);\" class=\"cell fit arrow prev\">";
  $markup .=     "<div class=\"timeline-spacer\">&nbsp;</div>";
  $markup .=     "<div class=\"timeline-icon\"></div>";
  $markup .=   "</a>";

  foreach ($items as $item) {
    $date = get_field('timeline_date', $item->ID);

    $markup .=   "<a href=\"javascript:void(0);\" class=\"cell timeline-milestone\">";
    $markup .=     "<div class=\"timeline-date\">$date</div>";
    $markup .=     "<div class=\"timeline-marker\"></div>";
    $markup .=   "</a>";
  }

  $markup .=   "<a href=\"javascript:void(0);\" class=\"cell fit arrow next\">";
  $markup .=     "<div class=\"timeline-spacer\">&nbsp;</div>";
  $markup .=     "<div class=\"timeline-icon\"></div>";
  $markup .=   "</a>";
  $markup .= "</div>";
  
  /********************
  * Slides
  ********************/
  $markup .= "<div class=\"timeline-slides swiper-container\">";
  $markup .=  "<div class=\"swiper-wrapper\">";

  foreach ($items as $item) {  
    $image = get_field('image', $item->ID);

    // var_dump($image);
    $content = get_field('content', $item->ID);


    $markup .=  "<div class=\"timeline-slide swiper-slide\">";


    $markup .=   "<div class=\"row\">";
    $markup .=    "<div class=\"image col-xs-12 col-sm-4 col-md-4 col-lg-4\">";
    $markup .=     "<img src=\"{$image['url']}\" alt=\"{$image['alt']}\"/>";
    $markup .=    "</div>";

    $markup .=    "<div class=\"content col-xs-12 col-sm-8 col-md-8 col-lg-8\">";
    $markup .=     $content;
    $markup .=    "</div>";

    $markup .=   "</div>";
    $markup .=  "</div>";
  }

  $markup .=  "</div>";
  $markup .= "</div>";
  
  $markup .= "<script>Timeline.init();</script>";


  echo $markup;
}