<?php
// die;
function ajax_filter_search_shortcode()
{
    wpajax_plugin_scripts();
    ob_start();
    $currentPage = get_query_var("paged");
    $args =  array(
        "posts_per_page" => 3,
        'post_type' => 'news',
        "paged" => $currentPage,
    );
    $customQuery = new WP_Query($args);
?>
    <!-- FORM CODE WILL GOES HERE -->
    <div id="filterFormDiv">
        <form method="post" class="form-inline">
            <label for="newsTypes">Filter news</label>
            <select name="newsTypes_02" id="newsTypes">
                <option selected value="!@#$%"> Chose one</option>
                <hr>
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
            <input type="text" placeholder="Enter reporter here" name="meta_value_02" id="metaValue" />
            <button type="submit">Find now</button>
        </form>
    </div>
    <div id="sortingByTitle">
        <form method="post">
            <label for="#sortingDropDown"> Sort our new</label>
            <select name="sortingDropDown" id="sortingDropDown">
                <option selected value='!@$^%'>Chose one</option>
                <option value="ASC">[a-z]</option>
                <option value="DESC">[z-a]</option>
            </select>
            <button type="submit"> Sort Now </button>
        </form>
    </div>
    <div id="keywordSearch">
        <form method="post">
            <input type="text" placeholder="Search by keywords" id="keyword">
            <button type="submit">Search now</button>
        </form>
    </div>
    <div id="totalNews">
        <?php if ($customQuery->have_posts()) :
            require plugin_dir_path(__FILE__) . "showContent.php";
        ?>
            <div class="nav-previous alignleft"><?php previous_posts_link('Previous'); ?></div>
            <div class="nav-next alignright"><?php next_posts_link('Next', $customQuery->max_num_pages); ?></div>
        <?php else :  ?>
            <h2>Sorry we dont have any posts yet!</h2>
        <?php endif ?>
    </div>

<?php

    return ob_get_clean();
}

add_shortcode('Ajax-Filter', 'ajax_filter_search_shortcode');
// add_shortcode('ajaxFilter', 'my_ajax_filter_search_shortcode');
