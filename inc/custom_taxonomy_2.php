<?php
function wpdocs_create_news_taxonomies2()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x('Politices', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Politices', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Politices', 'textdomain'),
        'all_items'         => __('All Politices', 'textdomain'),
        'parent_item'       => __('Parent Politices', 'textdomain'),
        'parent_item_colon' => __('Parent Politices:', 'textdomain'),
        'edit_item'         => __('Edit Politices', 'textdomain'),
        'update_item'       => __('Update Politices', 'textdomain'),
        'add_new_item'      => __('Add New Politices Type', 'textdomain'),
        'new_item_name'     => __('New Politices Type Name', 'textdomain'),
        'menu_name'         => __('Politices Type', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'politices'),
    );
    register_taxonomy('politices', 'news', $args);
}
add_action('init', 'wpdocs_create_news_taxonomies2');
