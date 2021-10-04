<?php
function create_custom_post_type()
{
    $supports = array(
        'title', // post title
        'editor', // post content
        'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );
    $labels = array(
        'name' => _x('IA CPT', 'plural'),
        'singular_name' => _x('IA Sample', 'singular'),
        'menu_name' => _x('News', 'admin menu'),
        'name_admin_bar' => _x('News', 'admin bar'),
        'add_new' => _x('Add New', 'add Latest'),
        'add_new_item' => __('Add latest news'),
        'new_item' => __('Latest news'),
        'edit_item' => __('Edit news'),
        'view_item' => __('View news'),
        'all_items' => __('All news'),
        'search_items' => __('Search news'),
        'not_found' => __('No news found.'),
    );

    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'description' => 'Here are some latest and hottest news',
        'public' => true,
        'taxonomies' => array('newstype'),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'news'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 2,
    );

    register_post_type('news', $args);
}
add_action('init', 'create_custom_post_type');
