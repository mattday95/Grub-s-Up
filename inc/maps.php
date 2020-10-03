<?php

function gu_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyA99pWkEHbin-urBWAEOQNYQ65MP7M02wM');
}
add_action('acf/init', 'gu_acf_init');