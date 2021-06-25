<?php
if (!defined('ABSPATH')) exit;
function reporter_role() {
    add_role(
        'reporter', //  System name of the role.
        __( 'Reporter'  ), // Display name of the role.
        array(
            'read'  => true,
        )
        );
}
add_action('init', "reporter_role");