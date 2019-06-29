<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field\Field;

Block::make( __( 'Lien conferences' ) )
    ->add_fields( array(
        Field::make( 'text', 'text', __( 'Texte du lien' ) ),
        Field::make( 'checkbox','btn', __('Boutton'))->set_width(30),
        Field::make( 'select', 'color', __('Couleur'))
        ->set_options('get_bootstrap_colors')
        ->set_width(70)
    ) )
    ->set_description( __( 'A simple block consisting of a heading, an image and a text content.' ) )
    ->set_category(__('Salons'))
    ->set_render_callback(function($fields, $attribute=[], $inner_blocks=[]){
      $fields['id'] = get_the_ID();
      echo render_block_with_twig('link',$fields);
    });
