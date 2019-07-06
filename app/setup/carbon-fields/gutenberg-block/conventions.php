<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field\Field;

Block::make(__('Salons'))
->add_fields([])
->set_description(__('Afficher les salons les plus proches'))
->set_category('Convention')
->set_render_callback(function($fields = [], $attributes = []){
  WPEmerge\render('gutenberg-block/conventions', array_merge($fields, $attributes));
});
