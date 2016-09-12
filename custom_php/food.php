<?php


function render_header() {
  wp_reset_query();

  $pageData = get_post();
  $title = get_field('title', $pageData->ID);
  echo "<h2 class=\"gradientHeader\"><strong>$title</strong></h2>";
}

function render_foodFilterData() {
  // echo "<p class=\"filter-prompt\">This is the filter.</p>";


  $items = array();
  $items[] = array(
    'label' => 'Sunset Grill Favourites', 
    'filter' => 'favourites'
    );
  $items[] = array(
    'label' => 'Lighter Option', 
    'filter' => 'healthy'
    );
  $items[] = array(
    'label' => 'New Items', 
    'filter' => 'new'
    );



  $js = "";
  $js .= "<script>";
  $js .= "var filterDataProvider = [";

  foreach ($items as $item) {
    $label = $item['label'];
    $filter =$item['filter'];
    $js .= "{label:'$label', filter:'$filter'},";
  }

  $js .= "];";
  // $js .= "console.log('filterDataProvider', filterDataProvider);";
  $js .= "</script>";

  echo $js;

  return;


  $markup = "";



  $markup .= "<div class=\"row on-tablet on-desktop\">";
    $markup .= "<div class=\"filter-holder\">";
    foreach ($items as $item) {
      $label = $item['label'];
      $filter =$item['filter'];

        $markup .= "<div class=\"filter\" ng-cloak ng-show=\"filterAvailable('$filter');\">";
          $markup .= "<button href=\"javascript:void(0);\" ng-click=\"toggleFilter('$filter');\" class=\"button\" ng-class=\"{selected: filters['$filter']}\">";
            $markup .= "<span>{$label}</span>";
            $markup .= "<div class=\"icon $filter\"></div>";
          $markup .= "</button>";
        $markup .= "</div>";
    }
      $markup .= "</div>";  
    $markup .= "</div>";  



    echo $markup;
}

function render_foodData() {
  wp_reset_query();
  $pageData = get_post();
  $categories = get_field('subcategories', $pageData->ID);


  // $category_js = "var categoryDataProvider={";
  $category_js = "var categoryDataProvider = [\n";
  $food_js = "var foodDataProvider = [\n";
  $categoryID;
  $menuItems;

  $foodFields = array(
    array('field'=>'title', 'type'=>'string'),
    array('field'=>'sizequantity_sm', 'type'=>'string'),	
    array('field'=>'price_sm', 'type'=>'string'),
    array('field'=>'sizequantity', 'type'=>'string'),	
    array('field'=>'price', 'type'=>'string'),
    array('field'=>'sizequantity_lg', 'type'=>'string'),
    array('field'=>'price_lg', 'type'=>'string'),
    array('field'=>'featured', 'type'=>'boolean'),
    array('field'=>'featured_image', 'type'=>'string'),
    array('field'=>'description', 'type'=>'string'),
    array('field'=>'filters', 'type'=>'array')
  );
  

  $nutritionFields = array(
    array('field'=>'serving_size', 'type'=>'string'),
    array('field'=>'calories', 'type'=>'string'),
    array('field'=>'fat_total', 'type'=>'string'),
    array('field'=>'fat_saturated', 'type'=>'string'),
    array('field'=>'fat_trans', 'type'=>'string'),
    array('field'=>'cholesterol', 'type'=>'string'),
    array('field'=>'sodium', 'type'=>'string'),
    array('field'=>'carb_total', 'type'=>'string'),
    array('field'=>'sugars', 'type'=>'string'),
    array('field'=>'fibre', 'type'=>'string'),
    array('field'=>'protein', 'type'=>'string'),
    array('field'=>'vitamin_a', 'type'=>'string'),
    array('field'=>'vitamin_c', 'type'=>'string'),
    array('field'=>'calcium', 'type'=>'string'),
    array('field'=>'iron', 'type'=>'string')
  );

  function renderField($id, $fieldData) {
    $fieldName = $fieldData['field'];
    $fieldType = $fieldData['type'];
    $data = get_field($fieldName, $id);

    if ($fieldType == 'string') {
      $result = "$fieldName:" . json_encode($data) . ", \n";
    } else if ($fieldType == 'boolean') {
      $result = $fieldName . ":" . ($data == true ? 'true' : 'false') . ", \n";
    } else if ($fieldType == 'array') {
      if ($data == false) {
        $dataOutput = '[]';
      } else {
        $dataOutput = '[';
        foreach ($data as $item) {
          if (is_string($item)) {
            $dataOutput .= json_encode($item) . ", ";
          } else {
            $dataOutput .= "$item, ";
          }
        }

        $dataOutput = substr($dataOutput, 0, strlen($dataOutput) - 2);

        $dataOutput .= ']';
      }

      $result = $fieldName . ":" . $dataOutput . ", \n";
    } else {
      $result = $fieldName . ":" . ($data != false ? $data : 'false') . ", \n";
    }

    return $result;
  }

  if ($categories) {
    foreach ($categories as $categoryList) {
      $category = $categoryList['category'];
      $categoryID = $category->ID;
      $categoryTitle = get_field('title', $categoryID);
      $categorySubheader = get_field('subheader', $categoryID);
      $anchor = get_field('anchor', $categoryID);

      $category_js .= "{title:" . json_encode($categoryTitle) . ", subheader:" . json_encode($categorySubheader) . ", anchor:" . json_encode($anchor) . ", count:0, items:[";


      $menuItems = get_field('menu_items', $categoryID);

      foreach ($menuItems as $menuItemList) {
        $item = $menuItemList[''];
        $id = $item->ID;


        $foodRecord = "{";
        
        foreach ($foodFields as $field) {
          $foodRecord .= renderField($id, $field);
  
        }
		  
		  //echo '<pre>';
		  ////print_r($foodFields);
		  //var_dump($foodRecord);		  
		  //echo '</pre>';
		  

        $foodRecord .= "nutrition: {";
        foreach ($nutritionFields as $field) {
          $foodRecord .= renderField($id, $field);
        }
        $foodRecord .= "}, "; // end nutrition

        $foodRecord .= "},"; // end food record

        $category_js .= $foodRecord;


        $food_js .= $foodRecord;

      }



      // var_dump($menuItems);

      $category_js .= "]},";
    }

  }

  $food_js .= "];";
  $category_js .= "];";

  echo "<script>";
    echo $category_js . "\n";
    echo "console.log('categoryDataProvider:', categoryDataProvider);" . "\n";

    echo $food_js . "\n";
    // echo "console.log('foodDataProvider:', foodDataProvider);" . "\n";
  echo "</script>";








  return;

  echo "<script>";
     echo "var location_data = [\n";

    foreach ($records as $record) {
      $city = get_field('city', $record->ID);
      $location = get_field('location', $record->ID);
      $address = snip(get_field('address', $record->ID));

      $phone = get_field('phone', $record->ID);
      $hours = snip(get_field('hours', $record->ID));
      $features = get_field('features', $record->ID);

      if (is_array($features)) {
        $accessible = is_int(array_search('accessible', $features)) ? 'true' : 'false';
        $patio = is_int(array_search('patio', $features)) ? 'true' : 'false';
        $licensed = is_int(array_search('licensed', $features)) ? 'true' : 'false';
      } else {
        $accessible = 'false';
        $patio = 'false';
        $licensed = 'false';
      }


      echo "{";
        echo "city:\"$city\", ";
        echo "location:\"$location\",";
        echo "address:\"$address\", ";
        echo "phone:\"$phone\", ";
        echo "hours:\"$hours\", ";
        echo "features:[";
          echo "{id:'accessible', value:$accessible},";
          echo "{id:'patio', value:$patio},";
          echo "{id:'licensed', value:$licensed}";
          echo "]";
        echo "},\n";
    }

    echo "];\n";

    $iconFolder = get_template_directory_uri() . '/img/icons/feature_icons/';
    echo "var iconFolder ='$iconFolder';";
    // echo "console.log(location_data);";


  echo "</script>";
}


function render_foodDisclaimer() {
  $data = getGlobalSetting('food_page_disclaimer');
  // var_dump($data);
  echo $data;
}

function render_otherItemData() {
  return;
  
  wp_reset_query();

  $menu_name = 'header-menu';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );


  

  $pageData = get_post();
  $currentID = $pageData->ID;
  $parent = $pageData->post_parent;
  //var_dump($pageData);
  //var_dump($menuitems);
  $pages = get_pages(array('child_of'=>$parent));
  // var_dump($pages);

  $js = "";
  $js .= "<script>";
  $js .= "var otherItems = [";

  foreach ($pages as $page) {
    if ($page->ID != $currentID) {
      $title = $page->post_title;
      $title = str_replace('\'', '&apos;', $title);
      $url = get_permalink($page->ID);


      $js .= "{title:'$title', url:'$url'},";
    }
  }
  $js .= "];";
  // $js .= "console.log('otherItems', otherItems);\n";

  $js .= "</script>";

  echo $js;

  return;

}

function render_dividerRotatorData() {
  wp_reset_query();
  $pageData = get_post();
  $rotator = get_field('divider_rotator', $pageData->ID);
  $items = get_field('slides', $rotator->ID);
  $bkImage = get_field('background_image', $rotator->ID);


  $js = "";
  // $js .= "<pre style=\"margin-top:100px\">";
  $js .= "<script>";
  $js .= "var dividerRotatorData = {";
  $js .= "backgroundImage:'$bkImage',";
  $js .= "slides:[";

  if ($items) {
    
    foreach ($items as $item) { 
      $image = $item['image'];
      $content = snip($item['content']);

      $js .= "{";
      $js .= "content:'$content',";
      $js .= "image:{url:'{$image['url']}', alt:'{$image['alt']}'},";
      $js .= "},";
    }

  }
  $js .= "]};";

  $js .= "console.log('dividerRotatorData', dividerRotatorData);";
  // $js .= "</pre>";
  $js .= "</script>";

  echo $js;

}