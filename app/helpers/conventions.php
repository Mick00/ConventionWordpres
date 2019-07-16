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
  return;
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
  $conv_ex = carbon_get_post_meta(get_associated($convid, 'exhibitorslist')->ID, 'exhibitors');
  foreach ($conv_ex as $exposition) {
    foreach ($exposition['exposants'] as $exhibitor) {
      if($exhibitor['id'] == $exid){
        return $exposition['kiosk'];
      }
    }
  }
  return "introuvable";
}
// add_action('save_post','create_or_update_conferences_post',10,2);
// function create_or_update_conferences_post($con_id, $con_post){
//   return;
//   /* Remove action to stop infinite loop */
//   remove_action('save_post','create_or_update_conferences_post',10,2);
//
//   if ($conference_post_id && !is_wp_error($conference_post_id)) {
//     update_metadata('post', $conference_post_id, '_convention_id', $con_id);
//   } else {
//     echo $list_post_id->get_error_message();
//   }
// }
//
// function set_conferenceid_meta($con_id, $con_after){
//   remove_action('carbon_fields_post_meta_container_saved','set_conferenceid_meta',10,2);
//   $conference = get_posts([
//     'post_type' => 'conferences',
//     'meta_key'  => '_convention_id',
//     'meta_value'=> $con_id,
//     'post_status' => 'publish',
//   ])[0];
//   update_metadata('post', $con_id, '_conference_id', $conference->ID );
// }
