<?php get_header(); ?>

<main class="project-content">
    <h1><?php the_title(); ?></h1>

    <?php if ($client = get_field('client_name')): ?>
        <p><strong>Client:</strong> <?php echo esc_html($client); ?></p>
    <?php endif; ?>

    <?php if ($image = get_field('project_image')): ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
    <?php endif; ?>

    <?php if ($description = get_field('project_description')): ?>
        <div class="description">
            <?php echo wp_kses_post($description); ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
