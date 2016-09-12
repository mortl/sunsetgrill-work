<?php
function renderFooterMenu() {
  $menu_name = 'sidebar-menu';
  $locations = get_nav_menu_locations();

  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );


  $menu_list = "";
  $menu_list .= "<ul class=\"footerMenu primary 1\">";

  
  $item;
  for ($i=0; $i<3; $i++) {
    $item = $menuitems[$i];
    $menu_list .= "<li class=\"item\">";
	if ($i == 2) {
		$menu_list .= "<a href=\"{$item->url}#location_search\">{$item->title}</a>";		
	} else {
		$menu_list .= "<a href=\"{$item->url}\">{$item->title}</a>";	
	}

    $menu_list .= "</li>";
  }

  $menu_list .= "</ul>";
  $menu_list .= "<ul class=\"footerMenu secondary\">";

  for ($i=3; $i<count($menuitems); $i++) {
    $item = $menuitems[$i];
    $menu_list .= "<li class=\"item\">";
    $menu_list .= "<a href=\"{$item->url}\">{$item->title}</a>";
    $menu_list .= "</li>";
  }

  $menu_list .= "</ul>";

  echo $menu_list;

}