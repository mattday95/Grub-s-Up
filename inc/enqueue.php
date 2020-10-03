<?php

function gu_scripts() {
    wp_enqueue_script( 'gu-google-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap', array (), 1.1, true);
    wp_enqueue_script( 'gu-app', get_template_directory_uri() . '/dist/index_bundle.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'gu_scripts' );