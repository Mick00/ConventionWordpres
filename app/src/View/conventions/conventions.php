<?php
/*
App Layout: /layouts/nosidebar.php
*/
global $wp_query;
var_dump($wp_query->query_vars);
$posts = get_posts(array(
  "post_type"=>"convention",
  "post_status"=>"publish"
));
$loader = new \Twig\Loader\FilesystemLoader(APP_APP_DIR."src/View");
$twig = new \Twig\Environment($loader);
$convention_card = $twig->load('partials/convention_card.twig');
foreach ($posts as $convention) {
  echo $convention_card->render(get_convention_data($convention));
}

var_dump(strtolower(get_post_type_object( 'convention')->labels->name));
