<?php
$args = [
    'post_type' => 'post',       
    'posts_per_page' => 3,       
];

$latest_posts = new WP_Query($args);

if ($latest_posts->have_posts()) :
    echo '<div class="latest-posts">';
    while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
        <article class="post-card">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo get_the_excerpt(); ?></p>
            <p><small>Published: <?php echo get_the_date(); ?></small></p>
        </article>
    <?php endwhile;
    echo '</div>';
    wp_reset_postdata();
else :
    echo '<p>No posts found.</p>';
endif;
?>