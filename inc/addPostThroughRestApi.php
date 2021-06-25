<?php
function add_post_through_rest_api()
{
    wpia_submitForm();
    ob_start();
?>
    <div id="addPostUsingRestApi">
        <h2>Add New News</h2>
        <form method="post">
            <label for="#newsTitle"> Enter News Title Here </label>
            <input type="text" name="newsTitle" id="newsTitle" placeholder="Enter News Title here" required>
            <br> <br>
            <label for="newsTypes">Chose Cetagory</label>
            <select name="newsTypes" name="newsType" id="newsTypes" required>
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
                            $term_id = $term->term_id;
                            if ($taxonomyName && $term_id) {
                ?>
                                <option value="<?php echo  $term_id; ?>"><?php echo $taxonomyName; ?></option>
                <?php
                            }
                        }
                    }
                }

                ?>
            </select> <br> <br>
            <label for="reporterName"> Enter Reporter Name
                <input type="text" name="reporterName" id="reporterName" , placeholder="Reporter Name" required>
            </label> <br> <br>
            <label for="reporterCity"> Enter Reported City
                <input type="text" name="reporterCity" id="reporterCity" , placeholder="Reported City" required>
            </label> <br> <br>
            <label for="reporterGender"> Enter Reporter Gender
                <select name="gender" id="reporterGender" name="reporterGender"  required>
                    <option value="#" selected disabled> chose One </option>
                    <option value="male"> Male </option>
                    <option value="female"> Female </option>
                </select>
            </label> <br> <br>
            <input type='file' id="exampleFormControlFile1" name='NewPicture' label="Select Sutable Image for News" required /> <br> <br>
            <textarea name="newsContent" id="newsContent" cols="100" rows="10" placeholder="Enter News Details here" required></textarea> <br> <br>
            <button type="submit">Submit News</button>
        </form>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('Add_Post_using_restApi', 'add_post_through_rest_api');
