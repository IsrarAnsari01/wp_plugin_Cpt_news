<?php
function wpdocs_create_news_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x('News Type', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('News', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search News type', 'textdomain'),
        'all_items'         => __('All News Type', 'textdomain'),
        'parent_item'       => __('Parent News Type', 'textdomain'),
        'parent_item_colon' => __('Parent News type:', 'textdomain'),
        'edit_item'         => __('Edit NewsType', 'textdomain'),
        'update_item'       => __('Update NewsType', 'textdomain'),
        'add_new_item'      => __('Add New News Type', 'textdomain'),
        'new_item_name'     => __('New News Type Name', 'textdomain'),
        'menu_name'         => __('News Type', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'newstype'),
    );
    register_taxonomy('newstype', 'news', $args);
}
add_action('init', 'wpdocs_create_news_taxonomies');
