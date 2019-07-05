<?php
/**
 * Register post types.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_rewrite_endpoint( 'salons', EP_PAGES );
register_post_type( 'convention', array(
	'labels' => array(
		'name'               => __( 'Salons', 'app' ),
		'singular_name'      => __( 'Salon', 'app' ),
		'add_new'            => __( 'Ajouter un salon', 'app' ),
		'add_new_item'       => __( 'Ajouter un salon', 'app' ),
		'view_item'          => __( 'Voir le salon', 'app' ),
		'edit_item'          => __( 'Modifier le salon', 'app' ),
		'new_item'           => __( 'Nouveau Salon', 'app' ),
		'view_item'          => __( 'Voir le salon', 'app' ),
		'search_items'       => __( 'Chercher un salon', 'app' ),
		'not_found'          => __( 'Aucun salon trouvé', 'app' ),
		'not_found_in_trash' => __( 'Aucun salon trouvé dans la corbeille', 'app' ),
	),
	'public'              => true,
	'exclude_from_search' => false,
	'show_ui'             => true,
	'show_in_rest'       	=> true,
	'show_in_nav_menus'		=> true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'_edit_link'          => 'post.php?post=%d',
	'query_var'           => true,
	'menu_icon'           => 'dashicons-admin-post',
	'supports'            => array( 'title', 'editor', 'page-attributes','excerpt', 'thumbnail' ),
	'rewrite'             => array(
		'slug'       => __('salon'),
		'with_front' => false,
	),
));

register_post_type( 'conferences', array(
	'labels' => array(
		'name'               => __( 'Conférences', 'app' ),
		'singular_name'      => __( 'Conférence', 'app' ),
		'add_new'            => __( 'Ajouter une horaire de conférences', 'app' ),
		'add_new_item'       => __( 'Ajouter une horaire de conférences', 'app' ),
		'view_item'          => __( 'Voir les conférences', 'app' ),
		'edit_item'          => __( 'Modifier les conférences', 'app' ),
		'new_item'           => __( 'Nouvelle horaire de conférences', 'app' ),
		'view_item'          => __( 'Voir l\'horaire des conférences', 'app' ),
		'search_items'       => __( 'Chercher une horaire', 'app' ),
		'not_found'          => __( 'Aucune horaire trouvé', 'app' ),
		'not_found_in_trash' => __( 'Aucune horaire trouvé dans la corbeille', 'app' ),
	),
	'public'              => true,
	'exclude_from_search' => false,
	'show_ui'             => true,
	'show_in_rest'       => true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'_edit_link'          => 'post.php?post=%d',
	'query_var'           => true,
	'menu_icon'           => 'dashicons-admin-post',
	'supports'            => array( 'title', 'editor', 'page-attributes','excerpt' ),
	'rewrite'             => array(
		'slug'       => 'conference',
		'with_front' => false,
	),
));

register_post_type( 'exhibitorslist', array(
	'labels' => array(
		'name'               => __( 'Liste d\'exposants', 'app' ),
		'singular_name'      => __( 'Liste d\'exposant', 'app' ),
		'add_new'            => __( 'Ajouter une liste', 'app' ),
		'add_new_item'       => __( 'Ajouter une list', 'app' ),
		'view_item'          => __( 'Voir l\'exposant', 'app' ),
		'edit_item'          => __( 'Modifier l\'exposant', 'app' ),
		'new_item'           => __( 'Nouvelle l\'exposant', 'app' ),
		'view_item'          => __( 'Voir l\'exposant', 'app' ),
		'search_items'       => __( 'Chercher un exposant', 'app' ),
		'not_found'          => __( 'Aucun exposant', 'app' ),
		'not_found_in_trash' => __( 'Aucun exposant trouvé dans la corbeille', 'app' ),
	),
	'public'              => true,
	'exclude_from_search' => false,
	'show_ui'             => true,
	'show_in_rest'       => false,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'_edit_link'          => 'post.php?post=%d',
	'query_var'           => true,
	'menu_icon'           => 'dashicons-admin-post',
	'supports'            => array( 'title', 'editor', 'page-attributes','excerpt'),
	'rewrite'             => array(
		'slug'       => 'exposants',
		'with_front' => false,
	),
));

register_post_type( 'exhibitor', array(
	'labels' => array(
		'name'               => __( 'Exposants', 'app' ),
		'singular_name'      => __( 'Exposant', 'app' ),
		'add_new'            => __( 'Ajouter un exposant', 'app' ),
		'add_new_item'       => __( 'Ajouter un exposant', 'app' ),
		'view_item'          => __( 'Voir l\'exposant', 'app' ),
		'edit_item'          => __( 'Modifier l\'exposant', 'app' ),
		'new_item'           => __( 'Nouvelle l\'exposant', 'app' ),
		'view_item'          => __( 'Voir l\'exposant', 'app' ),
		'search_items'       => __( 'Chercher un exposant', 'app' ),
		'not_found'          => __( 'Aucun exposant', 'app' ),
		'not_found_in_trash' => __( 'Aucun exposant trouvé dans la corbeille', 'app' ),
	),
	'public'              => true,
	'exclude_from_search' => false,
	'show_ui'             => true,
	'show_in_rest'       => false,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'_edit_link'          => 'post.php?post=%d',
	'query_var'           => true,
	'menu_icon'           => 'dashicons-admin-post',
	'supports'            => array('none'),
	'rewrite'             => array(
		'slug'       => 'exposant',
		'with_front' => false,
	),
));
// phpcs:disable
/*
register_post_type( 'app_custom_post_type', array(
	'labels' => array(
		'name'               => __( 'Custom Types', 'app' ),
		'singular_name'      => __( 'Custom Type', 'app' ),
		'add_new'            => __( 'Add New', 'app' ),
		'add_new_item'       => __( 'Add new Custom Type', 'app' ),
		'view_item'          => __( 'View Custom Type', 'app' ),
		'edit_item'          => __( 'Edit Custom Type', 'app' ),
		'new_item'           => __( 'New Custom Type', 'app' ),
		'search_items'       => __( 'Search Custom Types', 'app' ),
		'not_found'          => __( 'No custom types found', 'app' ),
		'not_found_in_trash' => __( 'No custom types found in trash', 'app' ),
	),
	'public'              => true,
	'exclude_from_search' => false,
	'show_ui'             => true,
	'capability_type'     => 'post',
	'hierarchical'        => false,
	'_edit_link'          => 'post.php?post=%d',
	'query_var'           => true,
	'menu_icon'           => 'dashicons-admin-post',
	'supports'            => array( 'title', 'editor', 'page-attributes' ),
	'rewrite'             => array(
		'slug'       => 'custom-post-type',
		'with_front' => false,
	),
));
*/
// phpcs:enable
