<?php

function render_jobOpportunities() {
  //global $post;

  /*
   * Prepare the text/image block
   */
  $posts = getCustomPosts('job_opening', 'status', 'open');


  // var_dump($posts);



  // echo "<div class=\"container\">";
  echo  "<div class=\"row\">";
  foreach ($posts as $post) {
    render_jobOpportunity($post);

  }
  echo   "</div>";
  // echo  "</div>";

  wp_reset_query();
}

function render_jobOpportunity($post) {
  $id = $post->ID;
  $location = get_field('location', $id);
  $title = get_field('title', $id);
  $content = get_field('content', $id);


  echo "<div class=\"job-tile col-xs-12 col-sm-6\">";
  echo  "<h3>$location</h3>";
  echo  "<h4>$title</h4>";
  echo  "<hr/>";
  echo  "<div class=\"content\">";
  echo    $content;
  echo  "</div>";
  echo "</div>";

}
  
function render_jobPositions() {
  //global $post;

  /*
   * Prepare the text/image block
   */
  $posts = getCustomPosts('position', null, null, 'order', 'ASC', true);

  echo "<div id=\"positionsAccordion\" class=\"ui-accordion ui-widget ui-helper-reset\">";
    foreach ($posts as $post) {
      render_jobPosition($post);
    }
  echo "</div>";

  echo "<script>Accordion.init(\"#positionsAccordion\");</script>";



  wp_reset_query();
}

function render_jobPosition($post) {
  $id = $post->ID;
  $title = get_field('title', $id);
  $content = get_field('content', $id);

  echo "<h3 class=\"accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all\">";
    echo "<span class=\"ui-accordion-header-icon ui-icon ui-icon-plusthick\"></span>";
    // echo "<span class=\"ui-accordion-header-icon ui-icon ui-icon-triangle-1-e\"></span>";
    echo $title;
    echo "</h3>";
    echo "<div class=\"ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom\">";
    echo $content;
    echo "</div>";
}
  

function render_jobPositions_xxx() {
  //global $post;

  /*
   * Prepare the text/image block
   */
  $posts = getCustomPosts('position', null, null, 'order', 'ASC', true);

  // echo "<div class=\"container\">";
    echo "<div id=\"positionsAccordion\">";
          foreach ($posts as $post) {
            render_jobPosition($post);
          }
    echo "</div>";
  // echo "</div>";

  echo "<script>Accordion.init(\"#positionsAccordion\");</script>";



  wp_reset_query();
}

function render_jobPosition_xxx($post) {
  $id = $post->ID;
  $title = get_field('title', $id);
  $content = get_field('content', $id);

  echo "<h3>$title</h3>";
  echo "<div>";
    echo $content;
  echo "</div>";
}
  
