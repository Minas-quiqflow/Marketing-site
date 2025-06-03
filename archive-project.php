<?php get_header(); ?>

<main class="project-archive">
    <h1>Our Projects</h1>

    <div class="project-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="project-card">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <?php if ($image = get_field('project_image')): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>

                <p><strong>Client:</strong> <?php the_field('client_name'); ?></p>
                <p><?php the_field('project_description'); ?></p>
            </article>
        <?php endwhile; else : ?>
            <p>No projects found.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
