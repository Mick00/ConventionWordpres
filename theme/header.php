<?php
/**
 * Theme header partial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php app_shim_wp_body_open(); ?>
		<div class="nav-wrapper">
			<a class="lg-brand text-center" href="<?=get_home_url()?>">
				<img src="<?=carbon_get_theme_option('light_logo')?>" alt="Logo sombre <?=bloginfo('name')?>" class="logo mx-auto mt-3">
			</a>
			<nav id="nav" class="navbar navbar-expand-md navbar-light<?=is_admin_bar_showing()?" admin-bar-showing":"" ?>" role="navigation">
				
				<a href="<?=get_home_url()?>" class="navbar-brand md-brand">
					<img src="<?=carbon_get_theme_option('light_logo')?>" alt="Logo sombre <?=bloginfo('name')?>" class="logo mt-3">
				</a>
				<div>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-items-container" aria-controls="navbar-items-container" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

							<?php
							wp_nav_menu( array(
								'theme_location'    => 'main-menu',
								'depth'             => 2,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse',
								'container_id'      => 'navbar-items-container',
								'menu_class'        => 'nav navbar-nav mx-auto',
								'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
								'walker'            => new WP_Bootstrap_Navwalker(),
							) );
							?>
					</div>
			</nav>
		</div>
		<?php
				if(is_front_page()){
					do_action('emergence_is_front_page');
				}
		?>
