<?php
function round_up($number, $precision = 0)
{
    $fig = (int) str_pad('1', $precision, '0');
    return (ceil($number * $fig) / $fig);
}

function round_down($number, $precision = 0)
{
    $fig = (int) str_pad('1', $precision, '0');
    return (floor($number * $fig) / $fig);
}
function renderMenu() {
  $menu_name = 'header-menu';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

  $topLevelItems = array();
  $secondLevelItems = array();
  foreach( $menuitems as $item ) {
    $parentID = $item->menu_item_parent;
    if ($parentID != '0') {
      if (!is_array($secondLevelItems[$parentID])) {
        $secondLevelItems[$parentID] = array();
      }
      $secondLevelItems[$parentID][] = $item;
    } else {
      $topLevelItems[] = $item;
    }
  }

  $pagePost = get_post( $post_id );
  $postID = $pagePost->ID;
  $postParentID = $pagePost->post_parent;

  $post = getGlobalSetting('menu_logo');
  $image = get_field('menu_logo');
  $logoURL = $image['url'];
  $alt = $image['alt'];  

  $markup = "";
  $markup .= "<ul>";
  $markup .= "<li><a href=\"" . site_url() . "\" class=\"logo\"><img src=\"$logoURL\" alt=\"$alt\"/></a></li>";


  foreach ($topLevelItems as $topItem) {
    $label = $topItem->title;
    $id = $topItem->object_id;
    $currentClass = ($id == $postID) ? ' current' : '';

    $link = $topItem->url;
    $childItems = $secondLevelItems[$topItem->ID];
    $childCount = count($childItems);
    $calculatedForColumns = round_up($childCount/4 );
    //echo $calculatedForColumns . " ";
      
    if ($childItems == null) {
      $markup .= "<li class=\"item" . $currentClass . "\"><a href=\"javascript:void(0);\" class=\"title main-nav-item\" data-link=\"$link\"><span>" . $label . "</span></a></li>";
    } else {

      $currentClass = ($id == $postParentID) ? ' current' : '';
      $i = 0;
      $markup .= "<li class=\"item hasDropdown" . $currentClass . "\">";
      $markup .= "<a href=\"javascript:void(0);\" class=\"title main-nav-item\" data-link=\"$link\"><span>" . $label . "</span></a>";
      $markup .= "<ul class=\"sub-menu hidden row\">";
    
      foreach ($childItems as $child) {
        
        $i = $i + 1;
        if ($i == 1) {
            $markup .= "<div class=\"menu-column-wrapper\">";
        }
          //echo $i;
        $label = $child->title;
        $link = $child->url; 
        if ($i %$calculatedForColumns == 0 && $i != $childCount) {
           
            
            $markup .= "<li class=\"item\"><a href=\"$link\" class=\"title\"><span>" . $label . "</span></a></li></div><div class=\"menu-column-wrapper\">";
        } else {
            
            $markup .= "<li class=\"item\"><a href=\"$link\" class=\"title\"><span>" . $label . "</span></a></li>"; 
        }
        
            //echo "modulos calc - $childCount, $i , $calculatedForColumns, ";
            //echo $i %$calculatedForColumns . " end <br/>";
        if ($i ==  $childCount) {
            $markup .= "</div>";
        }   
      }

      $markup .= "</ul>";
      $markup .= "</li>";

    }

  }

  echo $markup;

}


function renderBootstrapMenu() {
  $menu_name = 'header-menu';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

  $topLevelItems = array();
  $secondLevelItems = array();
  foreach( $menuitems as $item ) {
    $parentID = $item->menu_item_parent;
    if ($parentID != '0') {
      if (!is_array($secondLevelItems[$parentID])) {
        $secondLevelItems[$parentID] = array();
      }
      $secondLevelItems[$parentID][] = $item;
    } else {
      $topLevelItems[] = $item;
    }
  }


  $markup = "";
  foreach ($topLevelItems as $topItem) {
    $label = $topItem->title;
    $link = $topItem->url;
    $childItems = $secondLevelItems[$topItem->ID];
    if ($childItems == null) {
      $markup .= "<li><a href=\"$link\">$label</a></li>";
    } else {
      $markup .= "<li class=\"dropdown\">";
      $markup .= "<a href=\"javascript:void(0);\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">$label <span class=\"caret\"></span></a>";
      $markup .= "<ul class=\"dropdown-menu\" role=\"menu\">";
      foreach ($childItems as $child) {
        $label = $child->title;
        $link = $child->url;
        $markup .= "<li><a href=\"$link\">" . $label . "</a></li>";

      }

      $markup .= "</ul>";
      $markup .= "</li>";

    }

  }

  echo $markup;
}

function render_menuData() {
  $menu_name = 'header-menu';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array('order' => 'DESC' ) );

  // var_dump($menuitems);

  $topLevelItems = array();
  $secondLevelItems = array();
  foreach( $menuitems as $item ) {
    $parentID = $item->menu_item_parent;
    if ($parentID != '0') {
      if (!is_array($secondLevelItems[$parentID])) {
        $secondLevelItems[$parentID] = array();
      }
      $secondLevelItems[$parentID][] = $item;
    } else {
      $topLevelItems[] = $item;
    }
  }

  wp_reset_query();
  $pageData = get_post();
  $currentPageID = $pageData->ID;

  

  // var_dump($pageData);


  // render js
  $js = "\n\n<script>";
  $js .= "var menuData = [";
  foreach ($topLevelItems as $topItem) {
    $label = $topItem->title;
    $itemID = $topItem->ID;
    $pageID = $topItem->object_id;

    $slug = strtolower($label);
    $slug = str_replace(' ', '_', $slug);
    $slug = str_replace('\'', '', $slug);


    $label = str_replace('\'', '&apos;', $label);

    $link = $topItem->url;
    $childItems = $secondLevelItems[$topItem->ID];
    if ($childItems == null) {
      $js .= "{id:$itemID, pageID:$pageID, slug:'$slug', title:'$label', url:'$link'},";
    } else {
      $js .= "{id:$itemID, pageID:$pageID, slug:'$slug', title:'$label', url:'$link', children:[";
      foreach ($childItems as $child) {
        $pageID = $child->object_id;
        // var_dump($child);

        $label = $child->title;
        $link = $child->url;
        $itemID = $child->ID;
        $slug = strtolower($label);
        $slug = str_replace(' ', '_', $slug);
        $slug = str_replace('\'', '', $slug);
        $label = str_replace('\'', '&apos;', $label);
        $js .= "{id:$itemID, pageID:$pageID, slug:'$slug', title:'$label', url:'$link'},"; 
      }
      $js .= "]},";
    }
  }

  $js .= "];";
  $js .= "var currentPageID = $currentPageID;";
  // $js .= "console.log('menuData', menuData);";
  // $js .= "console.log('currentPageID', currentPageID);";
  $js .= "</script>";

  echo $js;


}
