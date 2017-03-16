<?php


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}




// everywhere except home
function my_best_posts_on_each_pages_and_single($qty){
 	
 	if( is_home() ) {

 	}
 	else{
 		return 'mybestposts:...';	
 	}
 	
}
// my_best_posts_on_each_pages_and_single(5)

function show_portfolio(){
	$post = get_page_by_path('portfolio');
	$pageId = $post->ID;
	$args = array(
			'post_type' => 'page',
			'numberposts' => -1, // -1 signifie toutes les sous-pages
			'post_parent' => $pageId, // num�ro de la page parente

	);
	$posts = get_posts($args);
	foreach ($posts as $post){
		setup_postdata($post);
		echo get_the_title($post);
		echo the_content();
	}
}

function show_services(){
	$post = get_page_by_path('services');
	setup_postdata($post);
	echo '<div class="block services">'.the_content();
	echo '<div class="container"><ul class="services__list">';
	
	$pageId = $post->ID;
	$args = array(
			'post_type' => 'page',
			'numberposts' => -1, // -1 signifie toutes les sous-pages
			'post_parent' => $pageId, // num�ro de la page parente
			'orderby' => 'menu_order'
	);
	$posts = get_posts($args);
	foreach ($posts as $post){
		setup_postdata($post);
		echo '<li class="services__list__item">';
		echo '<div class="services__list__item__img">';
		
		echo '</div>';
		echo '<div class="services__list__item__title">'.get_the_title($post).'</div>';
		echo '<div class="services__list__item__desc">'.the_content().'</div>';
		echo '</li>';
	}
	echo '</ul></div></div>';
}


/*

// modify each title 
add_filter( 'the_title', 'title_lol', 10, 1 );

function title_lol($title){
	return $title.' lol';	
}
// add_filter( 'the_title', function( $title ) { return 'title . ' lol'; } );

*/


/*
// add two new custom menus..

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
*/

/*

// https://codex.wordpress.org/Function_Reference/register_post_type
add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'projets',
    array(
      'labels' => array(
        'name' => __( 'Projets' ),
        'singular_name' => __( 'Projet' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'projet'),
    )
  );
}


*/

?>