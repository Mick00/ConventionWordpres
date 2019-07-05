<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field\Field;

Block::make(__('Exposants'))
->add_fields([
  Field::make('text', 'id', __('Salon')),
])
->set_description(__('Afficher tous les exposants'))
->set_category('Convention')
->set_render_callback(function($fields){
  $exhibitors = carbon_get_post_meta(get_the_ID(), 'exposants');
  var_dump($exhibitors);
  render_block_with_twig('exhibitor', $exhibitors[0]);
});
