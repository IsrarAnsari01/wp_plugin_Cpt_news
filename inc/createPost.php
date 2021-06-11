<?php
function new_post_submit_cb()
{
    $newsTitle = $_POST['newsTitle'];
    $newsType = $_POST['newsType'];
    $reporterName = $_POST['reporterName'];
    $reporterCity = $_POST['reporterCity'];
    $reporterGender = $_POST['reporterGender'];
    $newsContent = $_POST['newsContent'];
    $user_id =  get_current_user_id();
    $post_arr = array(
        'post_title'   => $newsTitle,
        'post_content' => $newsContent,
        'post_status'  => 'publish',
        'post_author'  => $user_id,
        'post_type' => 'news',
        'tax_input'    => array(
            'hierarchical_tax'     => $newsType,
            // 'non_hierarchical_tax' => $non_hierarchical_terms,
        ),
        'meta_input'   => array(
            'advanced_options_reporter-name' => $reporterName,
            'advanced_options_reported-city' => $reporterCity,
            'advanced_options_gender' => $reporterGender,
        ),
    );
    ob_start();
    $post_id = wp_insert_post($post_arr);
    echo $finalResult = wp_json_encode($$post_id);
    return ob_get_clean();
    wp_die();
}
add_action('wp_ajax_new_post_submit_cb', 'new_post_submit_cb');
add_action('wp_ajax_nopriv_new_post_submit_cb', 'new_post_submit_cb');

function resgister_routes_for_news()
{
    register_rest_route('test', '/add-new-news', array(
        'methods' => 'POST',
        'callback' => 'add_new_news',
    ));
}
add_action('rest_api_init', "resgister_routes_for_news");
function add_new_news(WP_REST_Request $request)
{
    print_r($param = $request->get_param('data'));
    new_post_submit_cb();
}
