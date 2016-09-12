<?php

  
function renderCurrentLocationsData($status = 'open') {
  $records = getCustomPosts('location', 'status', $status);

  echo "<script>";
     echo "var location_data = [\n";

    foreach ($records as $record) {
	  $id = $record->ID;
      $city = get_field('city', $record->ID);
      $location = get_field('location', $record->ID);
      $address = snip(get_field('address', $record->ID));
	  $coordinates = get_field('coordinates', $record->ID);
	  $explode_cord = explode(",", $coordinates);
	  

      $phone = get_field('phone', $record->ID);
      $hours = cleanup(get_field('hours', $record->ID));
      $features = get_field('features', $record->ID);

 	  $lon = $explode_cord[1];
	  $lat = $explode_cord[0];

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
		echo "id:\"$id\", ";
        echo "city:\"$city\", ";
        echo "location:\"$location\",";
        echo "address:\"$address\", ";
        echo "phone:\"$phone\", ";
        echo "hours:\"$hours\", ";
		echo "cords:\"$coordinates\", ";
		echo "lon:\"$lon\", ";
		echo "lat:\"$lat\", ";
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
    //echo "console.log(location_data);";
   
	echo "var location_data_map = location_data;";
	//echo "console.log(location_data_map);";
	
  echo "</script>";
}