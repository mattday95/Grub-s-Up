<?php

function gu_acf_init() {
    acf_update_setting('google_api_key', get_field('google_api_key', 'option'));
}

add_action('acf/init', 'gu_acf_init');