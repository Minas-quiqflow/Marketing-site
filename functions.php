<?php

// -----------------------------------------------------------------------------
// Enqueue Styles
// -----------------------------------------------------------------------------
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'twentytwentyfive-child-style',
        get_stylesheet_uri(),
        ['twentytwentyfive-style'],
        wp_get_theme()->get('Version')
    );
});


// -----------------------------------------------------------------------------
// Register Custom Post Type: Projects
// -----------------------------------------------------------------------------
function register_projects_cpt() {
    register_post_type('project', [
        'label'         => 'Projects',
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'projects'],
        'supports'      => ['title', 'editor', 'thumbnail'],
        'show_in_rest'  => true, // Enables block editor and REST API
    ]);
}
add_action('init', 'register_projects_cpt');


// -----------------------------------------------------------------------------
// Register ACF Blocks
// -----------------------------------------------------------------------------
add_action('acf/init', function () {
    if (function_exists('acf_register_block_type')) {

        // ---------------------------------------------------------------------
        // ACF Block: Client Name
        // ---------------------------------------------------------------------
        acf_register_block_type([
            'name'            => 'client-name',
            'title'           => 'Client Name',
            'render_callback' => 'render_client_name_block',
            'category'        => 'formatting',
            'icon'            => 'id',
            'keywords'        => ['client', 'acf'],
            'post_types'      => ['project'],
            'mode'            => 'auto',
            'supports'        => ['align' => false],
        ]);

        // ---------------------------------------------------------------------
        // ACF Block: Project Description
        // ---------------------------------------------------------------------
        acf_register_block_type([
            'name'            => 'project-description',
            'title'           => 'Project Description',
            'render_callback' => 'render_project_description_block',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'keywords'        => ['description', 'acf'],
            'post_types'      => ['project'],
            'mode'            => 'auto',
            'supports'        => ['align' => false],
        ]);
    }
});


// -----------------------------------------------------------------------------
// ACF Block Render Callback: Client Name
// -----------------------------------------------------------------------------
function render_client_name_block($block) {
    $client_name = get_field('client_name');
    if ($client_name) {
        echo '<p><strong>Client:</strong> ' . esc_html($client_name) . '</p>';
    }
}


// -----------------------------------------------------------------------------
// ACF Block Render Callback: Project Description
// -----------------------------------------------------------------------------
function render_project_description_block($block) {
    $description = get_field('project_description');
    if ($description) {
        echo '<div class="project-description">' . wp_kses_post($description) . '</div>';
    }
}


// -----------------------------------------------------------------------------
// Register Navigation Menus
// -----------------------------------------------------------------------------
function mytheme_register_menus() {
    register_nav_menus([
        'main_menu' => __('Main Menu', 'mytheme'),
    ]);
}
add_action('init', 'mytheme_register_menus');
