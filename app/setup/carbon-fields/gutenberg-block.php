<?php

function render_block_with_twig($template, $param = []){
	$loader = new \Twig\Loader\FilesystemLoader(APP_APP_DIR."src/View/gutenberg-block");
	$twig = new \Twig\Environment($loader);
	return $twig->render($template.".twig", $param);
}

$blocs = glob( APP_APP_SETUP_DIR.'carbon-fields/gutenberg-block/*.php' );
foreach ( $blocs as $bloc ) {
	if ( ! is_file( $bloc ) ) {
		continue;
	}
	require_once $bloc;
}
