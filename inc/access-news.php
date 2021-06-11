<?php

function get_all_news_from_our_custom_cpt($attr)
{   /*Template Name: News*/
    $flag = false;
    $newsType_value = $_POST["newsTypes"];
    $meta_Value = $_POST["field_for_text"];
    if (!empty($newsType_value) && !empty($meta_Value)) {
        $args =  array(
            "posts_per_page" => -1,
            'post_type' => 'news',
            'meta_query' => array(
                array(
                    'key'     => 'advanced_options_reporter-name',
                    'value'   => $meta_Value,
                    'compare' => '=',
                ),
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'newstype',
                    'field'    => 'slug',
                    'terms'    => $newsType_value,
                ),
            ),
        );
        $newsType_value = '';
        $meta_Value = '';
        $flag = true;
    } else {
        $args =  array(
            "posts_per_page" => -1,
            'post_type' => 'news',
        );
    }
    if (!empty($_POST["reset"])) {
        $args =  array(
            "posts_per_page" => -1,
            'post_type' => 'news',
        );
        $flag = false;
    }
    $customQuery = new WP_Query($args);
?>
    <?php
    ob_start();
    ?>
    <h2>Filter Our News</h2>
    <form method="post" class="form-inline">
        <label for="newsTypes">Chose one</label>
        <select name="newsTypes" id="newsTypes">
            <?php
            $args = array(
                'public'   => true,
                '_builtin' => false

            );
            $output = 'names'; // or objects
            $operator = 'and'; // 'and' or 'or'
            $taxonomies = get_taxonomies($args, $output, $operator);
            if ($taxonomies) {
                foreach ($taxonomies  as $taxonomy) {
                    $terms = get_terms([
                        'taxonomy' => $taxonomy,
                        'hide_empty' => false,
                    ]);
                    foreach ($terms as $term) {
                        $taxonomyName = $term->name;
            ?>
                        <option value="<?php echo $taxonomyName; ?>"><?php echo $taxonomyName; ?></option>
            <?php
                    }
                }
            }

            ?>
        </select>
        <input type="text" placeholder="Enter reporter here" name="field_for_text" />
        <button type="submit">Find now</button>
    </form>
    <?php
    if ($flag) { ?>
        <form method="post">
            <button type="submit" name="reset">Reset Now</button>
        </form>
        <!-- <input type="submit" name="button1" class="button" value="Reset Now" /> -->
    <?php }
    ?>
    <?php if ($customQuery->have_posts()) :
        while ($customQuery->have_posts()) {
            $customQuery->the_post();
            $post_id = get_the_ID();
            $Reporter_Name = get_post_meta($post_id, 'advanced_options_reporter-name', true);
            $Reported_City = get_post_meta($post_id, 'advanced_options_reported-city', true);
            // $Gender = get_post_meta($post_id, 'advanced_options_gender', true);
    ?>
            <div>
                <h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>
                <span>
                    Posted Date : <b><?php the_time('d'); ?> - <?php the_time('M') ?> - <?php the_time('y') ?></b> <br>
                    Reporter Name : <?php echo $Reporter_Name;  ?> <br> Reported City <?php echo $Reported_City; ?>
                    </p>
                    <p>News Type: <b> <?php $terms = get_the_terms($post_id, 'newstype');
                                        if ($terms) {
                                            foreach ($terms as $term) {
                                                echo $term->name, "<br>";
                                            }
                                        } ?></b></p>
                </span>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                <p><?php the_excerpt(); ?></p>
            </div>
        <?php }
        ?>
    <?php else :  ?>
        <h2>Sorry we dont have any posts yet!</h2>
    <?php endif ?>
<?php
}
add_shortcode('all_news', 'get_all_news_from_our_custom_cpt');
