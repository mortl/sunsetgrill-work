<?php

  function getCustomPost($type, $key = null, $value = null) {

    $args = array(  
      'numberposts' => -1,
      'post_type' => $type
    );

    if ($key != null) {
      $args['meta_key'] = $key;
      $args['meta_value'] = $value;
    }

    $the_query = new WP_Query( $args );

    // Set values
    if ($the_query->have_posts()) {
      $the_query->the_post(); // execute it
      $post = $the_query->post;

      return $post;

    } else {
      return false;
    }
  }

  function getCustomPosts($type, $key = null, $value = null, $orderBy = null, $order = 'DESC', $numeric = false) {

    $args = array(  
      'numberposts' => -1,
      'post_type' => $type,
      'posts_per_page' => -1
    );

    if ($key != null) {
      $args['meta_key'] = $key;
      $args['meta_value'] = $value;
    }

    if ($orderBy) {
      $args['order'] = strtoupper($order);
      if ($numeric) {
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = $orderBy;
      } else {
        $args['orderby'] = $orderBy;
      }
    }

    $the_query = new WP_Query( $args );

    // Set values
    if ($the_query->have_posts()) {
      $the_query->the_post(); // execute it
      $posts = $the_query->posts;

      return $posts;

    } else {
      return false;
    }
  }

  function getGlobalData() {
   $args = array(  
      'numberposts' => 1,
      'post_type' => 'global_settings',
    );

    $the_query = new WP_Query( $args );

    // Set values
    if ($the_query->have_posts()) {
      $the_query->the_post(); // execute it
      $post = $the_query->post;

      return $post;

    } else {
      return false;
    }

  }

  function getGlobalSetting($key) {


    $args = array(  
      'numberposts' => -1,
      'post_type' => 'global_settings',
      'meta_key' => $key
    );

    $the_query = new WP_Query( $args );

    // Set values
    if ($the_query->have_posts()) {
      $the_query->the_post(); // execute it
      $post = $the_query->post;

      return get_field($key, $post->ID);
      
    } else {
      return false;
    }

  }