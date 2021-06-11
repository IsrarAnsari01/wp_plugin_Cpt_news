<?php
// First we create a function
function list_terms_custom_taxonomy_for_weather_news($atts)
{

    // Inside the function we extract custom taxonomy parameter of our shortcode

    extract(shortcode_atts(array(
        'custom_taxonomy' => 'newstype',
    ), $atts));

    // arguments for function wp_list_categories
    $args = array(
        "taxonomy" => "newstype",
        "title_li" => 'News Cetagory'
    );

    // We wrap it in unordered list 
    // $content = "<div>";
    $content .=  '<ul>';
    $content .= wp_list_categories($args);
    $content .= '</ul>';
    // $content = <<<'EOD'
    // <div>
    // <ul>
    // <li>
    // {wp_list_categories($args)}
    // </li>
    // </ul>
    // </div>
    // EOD;
    echo $content;
}

// Add a shortcode that executes our function
add_shortcode('ct_terms', 'list_terms_custom_taxonomy_for_weather_news');

//Allow Text widgets to execute shortcodes

add_filter('widget_text', 'do_shortcode');
