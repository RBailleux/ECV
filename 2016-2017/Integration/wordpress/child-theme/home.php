<?php get_header(); 

echo '<div class="zone">';

    $args = array('posts_per_page' => 5);

    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
      the_title();
      echo '<div class="entry-content">';
      the_content();
      echo '</div>';
    endwhile;

echo '</div>';

get_footer(); ?>



