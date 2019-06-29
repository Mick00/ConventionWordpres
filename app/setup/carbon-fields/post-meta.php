<?php
/**
 * Post Meta.
 *
 * Here, you can register custom post meta fields using the Carbon Fields library.
 *
 * @link https://carbonfields.net/docs/containers-post-meta/
 *
 * @package WPEmergeCli
 */

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

Container::make('post_meta', __("Date de l'évènement"))
->where('post_type', '=', 'convention')
->add_fields( array(
  Field::make('date','start',__('Début')),
  Field::make('date','end', __('Fin')),
  Field::make('text', 'conference_id', __('Id de la conference')),
));

Container::make('post_meta', __('Lieu'))
->where('post_type', '=', 'convention')
->add_fields(array(
  Field::make('text','location_name',__('Lieu')),
  Field::make('text','location_adress', __('Adresse')),
  Field::make('text', 'postal_code',__('Code postale')),
  Field::make('complex', 'rooms', __('Salles disponibles'))
  ->add_fields([
    Field::make('text', 'room_name', __('Nom de la salle')),
    ])
));

add_action( 'rest_api_init', 'create_api_posts_meta_field' );

function create_api_posts_meta_field() {

    // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
    register_rest_field( 'convention', 'rooms', array(
           'get_callback'    => 'get_rooms_for_rest',
           'schema'          => null,
        )
    );
}

function get_rooms_for_rest( $object ) {
    //get the id of the post object array
    $post_id = $object['id'];

    //return the post meta
    return carbon_get_post_meta($object['id'],'rooms');
}

Container::make('post_meta', __('Exposants'))
->where('post_type', '=', 'convention')
->add_fields([
  Field::make('complex','exhibitors', __('Exposants'))
  ->add_fields([
    Field::make('association','exposants',__('Exposant'))
    ->set_types([
      [
        'type' => 'post',
        'post_type' => 'exhibitor',
      ]
    ]),
    Field::make('text', 'kiosk', __('Kiosque')),
    Field::make('rich_text', 'kiosk_description' ,'Description du kiosque'),
  ])
  ->set_header_template('Kiosque <%- kiosk %>')
]);

Container::make('post_meta', __('Informations'))
->where('post_type','=','exhibitor')
->add_fields([
    Field::make('text','firstname',__('Prénom'))->set_width(33),
    Field::make('text','lastname',__('Nom'))->set_width(33),
    Field::make('text','city',__('City'))->set_width(33),
    Field::make('image','picture',__('Photo'))->set_width(20),
    Field::make('rich_text', 'bio', __('Bio'))->set_width(80),
    Field::make('complex', 'phones', __('Phones'))->set_width(33)
    ->add_fields([Field::make('text', 'number', __('Number'))]),
    Field::make('complex','emails',__('Courriels'))->set_width(33)
    ->add_fields([Field::make('text','email',__('Courriel'))]),
    Field::make('complex','sites',__('Sites webs'))->set_width(33)
    ->add_fields([Field::make('text','url',__('Adresse'))]),
]);

Container::make('post_meta', __('Informations'))
->where('post_type','=','conferences')
->add_fields([
  Field::make('text', 'convention_id', __('Id de la convention')),
]);
// phpcs:disable
/*
Container::make( 'post_meta', __( 'Custom Data', 'app' ) )
	->where( 'post_type', '=', 'page' )
	->add_fields( array(
		Field::make( 'complex', 'crb_my_data' )
			->add_fields( array(
				Field::make( 'text', 'title' )
					->help_text( 'lorem' ),
			) ),
		Field::make( 'map', 'crb_location' )
			->set_position( 37.423156, -122.084917, 14 ),
		Field::make( 'image', 'crb_img' ),
		Field::make( 'file', 'crb_pdf' ),
	));
*/
// phpcs:enable
