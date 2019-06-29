<?php

namespace Conventions\PostMetaSaved;

function exhibitor_saved($post_id){
  $post = get_post($post_id);
  if ($post->post_type === "exhibitor") {
    $post->post_title = carbon_get_post_meta($post_id, 'firstname')." ".\carbon_get_post_meta($post_id,'lastname');
    wp_update_post($post,true);
  }
}
