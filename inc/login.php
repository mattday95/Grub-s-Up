<?php

function gu_custom_login() { 
    
    
    $login_page = get_field('login_page', 'option');
    $brand_palette = get_field('brand_palette', 'option');
    $logo = get_field('site_logo', 'option') ? "url(".get_field('site_logo', 'option').")" : '';
    
?>

    <style type="text/css">


        body.login {
            background-color: <?= $login_page['login_background_colour'];?>;
        }

        body.login p.message {
            border-left-color: <?= $brand_palette['primary'];?>;
        }

        #login input.button-primary {
            background: <?= $brand_palette['primary'];?>;
            border-color: <?= $brand_palette['primary'];?>;
        }

        #login h1 a, .login h1 a {
            background-image: <?= $logo ;?>;
            height:65px;
            width:320px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }

    </style>

<?php }

add_action( 'login_enqueue_scripts', 'gu_custom_login' );