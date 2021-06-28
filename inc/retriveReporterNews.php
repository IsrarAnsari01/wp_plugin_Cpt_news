<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class retriveReporterNews
{

    public $reporterNews;
    public $reporter_id;
    public $currentPage;
    public $terms;

    /**
     * Constructor function initialize some funtions and register our shortcode
     * @param NULL
     * @return NULL
     */


    function __construct()
    {
        add_action("init", [$this, "getReporterNews"]);
        add_action("init", [$this, "getReporterId"]);
        add_shortcode("Specfic_reporter_news", [$this, "showNewsInSperateFile_cb"]);
    }

    /**
     * Get current user Id
     * @param NULL
     * @return NULL
     */

    function getReporterId()
    {
        $this->reporter_id = get_current_user_id();
    }

    /**
     * Get all news of specific user
     * @param NULL
     * @return NULL
     */

    public function getReporterNews()
    {

        $this->currentPage = get_query_var('paged');
        $args =  array(
            "posts_per_page" => 5,
            "paged" => $this->currentPage,
            'post_type' => 'news',
            "author" => $this->reporter_id,
        );
        $this->reporterNews = new  WP_Query($args);
    }

    /**
     * Call back function that display our custom posts
     * @param NULL
     * @return NULL
     */

    public function showNewsInSperateFile_cb()
    {
        wpia_submitForm();
        if ($this->reporterNews->have_posts()) {
            ob_start();
            require IA_PLUGIN_DIR_ASSET . "/inc/reporterNewsShow.php";
            require IA_PLUGIN_DIR_ASSET . "/assets/html/pagination.html";
        } else {
            echo "<h2> Sorry you don't have any news yet! Go and add some news</h2>";
            echo "<a href='IASITE/submit-your-news/' class='button'>Add new News</a>";
        }
        return ob_get_clean();
        wp_die();
    }
}

new retriveReporterNews();
