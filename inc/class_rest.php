<?php
class REST_API
{
    public $user_id;
    function __construct()
    {
        add_action('init', [$this, "getLoggedInUser"]);

        add_action('rest_api_init', function () {
            register_rest_route('news', '/add-new-news', array(
                'methods' => 'POST',
                'callback' => [$this, 'add_new_news'],
            ));
            register_rest_route('news', '/get-all-news', array(
                'methods' => 'GET',
                'callback' => [$this, 'get_all_news'],
            ));
            register_rest_route('news', '/delete-news', array(
                'methods' => 'POST',
                'callback' => [$this, 'delete_news'],
            ));
            register_rest_route('news', '/update-news', array(
                'methods' => 'POST',
                'callback' => [$this, "update_news"],
            ));
        });
    }

    function getLoggedInUser()
    {
        $this->user_id = get_current_user_id();
    }

    function add_new_news(WP_REST_Request $request)
    {
        $newsTitle = sanitize_text_field($_POST['newsTitle']);
        $newsType = sanitize_text_field($_POST['newsType']);
        $reporterName = sanitize_text_field($_POST['reporterName']);
        $reporterCity = sanitize_text_field($_POST['reporterCity']);
        $reporterGender = sanitize_text_field($_POST['reporterGender']);
        $newsContent = sanitize_text_field($_POST['newsContent']);
        $user_id =  $this->user_id;
        $post_arr = array(
            'post_title'   => $newsTitle,
            'post_content' => $newsContent,
            'post_status'  => 'publish',
            'post_author'  => $user_id,
            'post_type' => 'news',
            'tax_input'    => array(
                'newstype'     => $newsType,
            ),
            'meta_input'   => array(
                'advanced_options_reporter-name' => $reporterName,
                'advanced_options_reported-city' => $reporterCity,
                'advanced_options_gender' => $reporterGender,
            ),
        );
        ob_start();
        $post_id = wp_insert_post($post_arr);
        wp_set_object_terms($post_id, (int)$newsType, "newstype");
        echo $finalResult = wp_json_encode($post_id);
        return ob_get_clean();
        wp_die();
    }

    function delete_news(WP_REST_Request $request)
    {
        $postId = $_POST['postId'];
        ob_start();
        $result = wp_delete_post($postId, true);
        echo $finalResult = wp_json_encode($result);
        return ob_get_clean();
        wp_die();
    }
    function update_news(WP_REST_Request $request)
    {
        print_r($param = $request->get_param('dataToBeUpdated'));
        $newsTitle = $_POST['newsTitle'];
        $newsType = $_POST['newsType'];
        $reporterName = $_POST['reporterName'];
        $reporterCity = $_POST['reporterCity'];
        $reporterGender = $_POST['reporterGender'];
        $newsContent = $_POST['newsContent'];
        $postId = $_POST["postId"];
        $user_id =  get_current_user_id();
        $post_arr = array(
            "ID" => $postId,
            'post_title'   => $newsTitle,
            'post_content' => $newsContent,
            'post_status'  => 'publish',
            'post_author'  => $user_id,
            'post_type' => 'news',
            'tax_input'    => array(
                'newstype'     => $newsType,
            ),
            'meta_input'   => array(
                'advanced_options_reporter-name' => $reporterName,
                'advanced_options_reported-city' => $reporterCity,
                'advanced_options_gender' => $reporterGender,
            ),
        );
        ob_start();
        $post_id = wp_update_post($post_arr);
        echo $finalResult = wp_json_encode($post_id);
        return ob_get_clean();
        wp_die();
    }

    function get_all_news()
    {
        $currentPage = $_GET["page"];
        $Limit = $_GET["limit"];
        $args = array(
            'post_type' => 'news',
            "posts_per_page" => $Limit,
            "paged" => $currentPage,

        );
        ob_start();
        $customQuery = new  WP_Query($args);
        echo $getPostsFromDB = wp_json_encode($customQuery);
        return ob_get_clean();
        wp_die();
    }
}
new REST_API();
