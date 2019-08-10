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
  Field::make('date','start',__('Début'))->set_width(50),
  Field::make('date','end', __('Fin'))->set_width(50),
));

Container::make('post_meta', __('Lieu'))
->where('post_type', '=', 'convention')
->add_fields(array(
  Field::make('text','location_name',__('Lieu')),
  Field::make('text','location_adress', __('Adresse')),
  Field::make('text', 'postal_code',__('Code postale')),
))
->add_fields([
  Field::make('complex','schedule','Horaire')->add_fields(array(
    Field::make('select','day_start','Jour de debut')->add_options(get_days_of_week()),
    Field::make('select','day_end','Jour de fin')->add_options(get_days_of_week()),
    Field::make('checkbox','closed','Fermé'),
    Field::make('time','opens_at','Ouverture')->set_storage_format( "H:i" )->set_input_format("H:i","H:i")
    ->set_conditional_logic(array(
      array(
        'field' => 'closed',
        'value' => false,
      ) ) ),
      Field::make('time','closes_at','Fermeture')->set_storage_format( "H:i" )->set_input_format("H:i","H:i")
      ->set_conditional_logic(array(
        array(
          'field' => 'closed',
          'value' => false,
        ) ) )
      ))->set_header_template("<%- day_start %><% if (day_end != day_start){%> au <%- day_end %><%}%> <% if (closed){%> - Fermé <%} else {%> de <%- opens_at %> à <%- closes_at %><%}%>")
      ->set_layout('tabbed-vertical')
])
->add_fields([
  Field::make('complex', 'pricing', __('Prix d\'entrée'))
  ->add_fields([
    Field::make('text', 'package_name', __('Forfait'))->set_width(50),
    Field::make('text', 'package_price', __('Prix'))->set_width(50),
  ])->set_layout('tabbed-vertical')->set_header_template('<%- package_name %>')
])
->add_fields([
  Field::make('image', 'siteplan', __('Plan du site'))
]);

Container::make('post_meta', __('Exposants'))
->where('post_type', '=', 'exhibitorslist')
->add_fields([
  Field::make('association', 'convention', __('Convention'))
  ->set_types([
    [
      'type'      => 'post',
      'post_type' => 'convention',
    ]
  ])->set_max(1),
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
    field::make('text', 'kiosk_title', __('Titre du kiosque')),
    Field::make('rich_text', 'kiosk_description' ,'Description du kiosque'),
  ])
  ->set_layout('tabbed-vertical')
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
  Field::make('association', 'convention', __('Pour quel salon est cet horaire'))
  ->set_types([
    [
      'type'      => 'post',
      'post_type' => 'convention',
    ]
  ])->set_max(1),
  Field::make('complex', 'dates', __('Dates'))
  ->add_fields([
    Field::make('date', 'date', __('Jour')),
    Field::make('complex', 'rooms', __('Salle'))
    ->add_fields([
      Field::make('text', 'room_name', __('Nom du lieu')),
      field::make('complex', 'conferences', __('Conférences'))
      ->add_fields([
        Field::make('time', 'starts_at', __('Début:')),
        Field::make('association', 'conferencier', __('Exposant'))
        ->set_types([
          [
            'type' => 'post',
            'post_type' => 'exhibitor',
          ]
        ]),
        Field::make('text','title', __('Titre de la conférence')),
        Field::make('rich_text', 'description', __('Description'))
      ])
      ->set_layout('tabbed-vertical')
      ->set_header_template('<%- starts_at %>')
    ])
    ->set_layout('tabbed-horizontal')
    ->set_header_template('<%- room_name %>')
  ])
  ->set_layout( 'tabbed-horizontal' )
  ->set_header_template( "<%- date %>" )
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
