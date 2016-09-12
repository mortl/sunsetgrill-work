<?php
function render_franchiseSubmenu() {
  $permalink = get_permalink();
  $currentPage = array_pop(explode('franchising/', $permalink));
  $currentPage = array_shift(explode('/', $currentPage));

  $items = getCustomPosts('franchise_submenu', null, null, 'order', 'ASC', true);


  echo "<div class=\"row\">";
  foreach ($items as $item) {
    $label = get_field('label', $item->ID);
    $icon = get_field('icon', $item->ID);
    $dest = get_field('url', $item->ID);

    $myPage = array_pop(explode('franchising/', $dest));
    $myPage = array_shift(explode('/', $myPage));

    $currentClass = $myPage == $currentPage ? 'current' : '';

    echo "<div class=\"col-xs-4\">";
      echo "<a href=\"$dest\" class=\"button $currentClass\">";
        echo "<span>{$label}</span>";
        echo "<div class=\"icon\" style=\"background-image:url('$icon');\"></div>";
      echo "</a>";
    echo "</div>";
  }
  echo "</div>";  

}
