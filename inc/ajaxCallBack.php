<?php
// die;
function ajax_filter_search_cb()
{
    header("Content-Type: application/json");
    $newsType =  sanitize_text_field($_POST["newsType"]);
    $metaValue = sanitize_text_field($_POST["metaValue"]);
    $sortingType = sanitize_text_field($_POST["sortingType"]);
    $keyword = sanitize_text_field($_POST["keyword"]);
    $currentPage = get_query_var("paged");
    if (!empty($newsType)) {
        $args =  array(
            "posts_per_page" => 3,
            'post_type' => 'news',
            "paged" => $currentPage,
            'tax_query' => array(
                array(
                    'taxonomy' => 'newstype',
                    'field'    => 'slug',
                    'terms'    => $newsType,
                ),
            ),
        );
        $newsType = '';
    } else if (!empty($metaValue)) {
        $args =  array(
            "posts_per_page" => 3,
            'post_type' => 'news',
            "paged" => $currentPage,
            'meta_query' => array(
                array(
                    'key'     => 'advanced_options_reporter-name',
                    'value'   => $metaValue,
                    'compare' => '=',
                ),
            ),
        );
        $metaValue = '';
    } else if (!empty($newsType) && !empty($metaValue)) {
        $args =  array(
            "posts_per_page" => 3,
            'post_type' => 'news',
            "paged" => $currentPage,
            'meta_query' => array(
                array(
                    'key'     => 'advanced_options_reporter-name',
                    'value'   => $metaValue,
                    'compare' => '=',
                ),
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'newstype',
                    'field'    => 'slug',
                    'terms'    => $newsType,
                ),
            ),
        );
        $newsType = '';
        $metaValue = '';
    } else if (($sortingType === "ASC") && !empty($sortingType)) {
        $args = array(
            'post_type' => 'news',
            'orderby'   => 'title',
            'order'     => 'ASC',
            "posts_per_page" => 3,
            "paged" => $currentPage,
        );
        $sortingType = '';
    } else if (($sortingType === "DESC") && !empty($sortingType)) {
        $args = array(
            'post_type' => 'news',
            'orderby'   => 'title',
            'order'     => 'DESC',
            "posts_per_page" => 3,
            "paged" => $currentPage,
        );
        $sortingType = '';
    } else if (!empty($keyword)) {
        $args = array(
            'post_type' => 'news',
            "posts_per_page" => 3,
            "paged" => $currentPage,
            's' => $keyword
        );
        $keyword = '';
    } else {
        $args =  array(
            "posts_per_page" => 3,
            "paged" => $currentPage,
            'post_type' => 'news',
        );
    }
    ob_start();
    $customQuery = new  WP_Query($args);
    if ($customQuery->have_posts()) {
        require plugin_dir_path(__FILE__) . "showContent.php";
?>
        <div class="nav-previous alignleft"><?php previous_posts_link('Previous'); ?></div>
        <div class="nav-next alignright"><?php next_posts_link('Next', $customQuery->max_num_pages); ?></div>
    <?php
        $output = ob_get_clean();
        echo $finalResult = wp_json_encode($output);
        exit;
    } else { ?>
        <h2>Sorry your search did not match with any posts</h2>
<?php  }
    return ob_get_clean();
    wp_die();
}
add_action('wp_ajax_ajax_filter_search_cb', 'ajax_filter_search_cb');
add_action('wp_ajax_nopriv_ajax_filter_search_cb', 'ajax_filter_search_cb');
