<?php
/*
Return associative array containing convention data
*/
define('CONVENTIONS_PATH', "/".strtolower(__('Salons')));

function get_convention_data($convention){

  return array(
    'thumbnail_url'   => get_the_post_thumbnail_url($convention->ID),
    'thumbnail_meta'  => wp_get_attachment_metadata($convention->ID),
    'title'           => $convention->post_title,
    'excerpt'         => $convention->post_excerpt,
    'url'             => get_post_permalink($convention->ID),
    'date_start'      => date_i18n('j F Y', strtotime(carbon_get_post_meta($convention->ID,'start'))),
    'date_end'        => date_i18n('j F Y', strtotime(carbon_get_post_meta($convention->ID,'end'))),
    'location_name'   => carbon_get_post_meta($convention->ID, 'location_name'),
    'location_adress' => carbon_get_post_meta($convention->ID, 'location_adress'),
    'postal_code'     => carbon_get_post_meta($convention->ID, 'location_code'),
  );
}

function get_associated($convention_id, $post_type, $qt = 1){
  $posts = get_posts([
    'post_type'         => $post_type,
    'post_status'       => 'publish',
  ]);
  foreach ($posts as $post) {
    $meta = carbon_get_post_meta($post->ID, 'convention');
    if (count($meta) > 0 && $meta[0]['id'] == $convention_id){
      return $post;
    }
  }
  return false;
}

function custom_post_meta($view, $post){
  if ($post->post_type === 'convention') {
    return "conventions/convention_meta";
  } else if ($post->post_type === 'conferences'){
    return "conferences/conference_meta";
  } else if ($post->post_type === 'exhibitorslist'){
    return "exhibitorslist/exhibitorslist_meta";
  }
  return $view;
}

function get_exhibitor_kiosk($convid, $exid){
  $exhibitorlist = get_associated($convid, 'exhibitorslist');
  if($exhibitorlist){    
    $conv_ex = carbon_get_post_meta($exhibitorlist->ID, 'exhibitors');
    foreach ($conv_ex as $exposition) {
      foreach ($exposition['exposants'] as $exhibitor) {
        if($exhibitor['id'] == $exid){
          return $exposition['kiosk'];
        }
      }
    }
  }
  return false;
}

function count_exhibitors($convid){
  return count(carbon_get_post_meta(get_associated($convid, 'exhibitorslist')->ID, 'exhibitors'));
}

function count_conferences($convid){
  $dates = carbon_get_post_meta(get_associated($convid, 'conferences')->ID, 'dates');
  $n_conf = 0;
  foreach ($dates as $date){
    foreach($date['rooms'] as $room){
      $n_conf += count($room['conferences']);
    }
  }
  return $n_conf;
}

function count_days($convid){
  $start = new DateTime(carbon_get_post_meta($convid,'start'));
  $end = new DateTime(carbon_get_post_meta($convid,'end'));
  return $start->diff($end)->format("%a");
}