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

add_action('save_post','create_or_update_conferences_post',10,2);
function create_or_update_conferences_post($con_id, $con_post){
  if($con_post->post_type !== 'convention'){
    return;
  }
  /* Remove action to stop infinite loop */
  remove_action('save_post','create_or_update_conferences_post',10,2);
  $args = [
    'post_title'  => $con_post->post_title,
    'post_type'   => 'conferences',
    'post_status' => 'publish',
  ];
  $conference_post_id = get_metadata('post', $con_id, '_conference_id');
  if (!empty($conference_post_id)) {
    $args['ID'] = $conference_post_id;
  }
  $conference_post_id = wp_insert_post($args);
  if ($conference_post_id && !is_wp_error($conference_post_id)) {
    /* Register a hook or meta get overide later by the current post*/
    add_action('carbon_fields_post_meta_container_saved','set_conferenceid_meta',10,2);
    update_metadata('post', $conference_post_id, '_convention_id', $con_id);
  }
  add_action('save_post','create_or_update_conferences_post',10,2);
}

function set_conferenceid_meta($con_id, $con_after){
  remove_action('carbon_fields_post_meta_container_saved','set_conferenceid_meta',10,2);
  $conference = get_posts([
    'post_type' => 'conferences',
    'meta_key'  => '_convention_id',
    'meta_value'=> $con_id,
    'post_status' => 'any',
  ])[0];
  update_metadata('post', $con_id, '_conference_id', $conference->ID );
}
