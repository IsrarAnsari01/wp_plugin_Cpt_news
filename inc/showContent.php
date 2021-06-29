<?php
wpia_submitForm();
while ($customQuery->have_posts()) {
    $customQuery->the_post();
    $postId = get_the_ID();
    $Reporter_Name = get_post_meta($postId, 'advanced_options_reporter-name', true);
    $Reported_City = get_post_meta($postId, 'advanced_options_reported-city', true);
?>
    <div>
        <h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>
        <span>
            <p> Posted Date : <b><?php the_time('d'); ?> - <?php the_time('M') ?> - <?php the_time('y') ?></b> <br>
                Reporter Name : <?php echo $Reporter_Name;  ?> <br> Reported City <?php echo $Reported_City; ?>
            </p>
            <p>News Type: <b> <?php $terms = get_the_terms($postId, 'newstype');
                                if ($terms) {
                                    foreach ($terms as $term) {
                                        echo $term->name, "<br>";
                                    }
                                } ?></b></p>
        </span>
        <?php
        if (has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
        <?php } ?>
        <p><?php the_excerpt(); ?></p>
        <div id="deletePost">
            <form method="post">
                <button type="submit" id="submit" name="submit" postId=<?php echo $postId; ?>> Delete Now</button>
            </form>
        </div> <br>
        <div id="updatePost">
            <form method="post">
                <button type="submit" id="submit" name="submit" postId=<?php echo $postId; ?>> Update Now</button>
            </form>
        </div> <br>
    </div>
<?php }
