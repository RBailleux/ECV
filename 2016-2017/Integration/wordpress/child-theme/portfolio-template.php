<?php 
/*
	Template Name: Portfolio
*/
?>
<?php get_header(); ?>

<?php
if(have_posts()){
$parentid = $post->ID;
// on récupère l'id de la page courante soit la page parente
$args = array(
		'post_type' => 'page',
		'numberposts' => -1, // -1 signifie toutes les sous-pages
		'post_parent' => $parentid, // numéro de la page parente
		'orderby' => 'menu_order'
);

$posts = get_posts($args);
?>
<?php foreach ($posts as $post) :
    setup_postdata($post); ?>
    <div class="entry">
    <h2><?php  the_title(); ?></h2>
    <?php the_content() ; ?>
    </div>
    <?php endforeach; 
}?>
<?php get_footer(); ?>