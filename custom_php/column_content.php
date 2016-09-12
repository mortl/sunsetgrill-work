<?php

function render_columnContent($slot) {
  $item = getCustomPost('column_content', 'slot', $slot);

  if (get_field('is_copy')) {
    $original = get_field('original');
    $item = getCustomPost('divider_banner', 'slotID', $original);
  }


  $columns = get_field('columns', $item->ID);
  $columnCount = count($columns);

  $colClass;
  if ($columnCount == 1) {
    $colClass = 'col-xs-12';
  } else if ($columnCount == 2) {
    $colClass = 'col-xs-12 col-sm-6';
  } else if ($columnCount == 3) {
    $colClass = 'col-xs-12 col-sm-4';
  } else if ($columnCount == 4) {
    $colClass = 'col-xs-12 col-sm-3';
  }

  echo "<div class=\"row columnContent textContent $slot\">";
    foreach($columns as $content) {
    echo "<div class=\"$colClass\">";
    echo $content['column'];
    echo "</div>";
    }
  echo "</div>";




}