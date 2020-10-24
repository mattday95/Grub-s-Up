<?php

$pages = get_field('page_list', 'option');
$cuisines = get_field('cuisine_list', 'option');
$locations = get_field('location_list', 'option');

?>

<footer class="o-site-footer">
    <div class="grid-container">
        <div class="grid-x grid-margin-x grid-padding-y o-site-footer__upper">
            <div class="cell medium-3">
                <h3>Customer Service</h3>
                <?php if($pages):?>
                <ul class="o-site-footer__upper__list">
                    <?php foreach($pages as $page):?>
                        <li><a href="<?= get_the_permalink($page->ID);?>"><?= $page->post_title;?></a></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div>    
            <div class="cell medium-3">
                <h3>Top Cuisines</h3>
                <?php if($cuisines):?>
                <ul class="o-site-footer__upper__list">
                    <?php foreach($cuisines as $cuisine):?>
                        <li><a href=""><?= $cuisine->name;?></a></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div> 
            <div class="cell medium-3">
                <h3>Locations</h3>
                <?php if($locations):?>
                <ul class="o-site-footer__upper__list">
                    <?php foreach($locations as $location):?>
                        <li><a href=""><?= $location->name;?></a></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </div> 
            <div class="cell medium-3">
              
            </div> 
        </div>
    </div>
    <div class="o-site-footer__lower">
        <div class="grid-container fluid">
        </div>
    </div>
</footer>

<?php wp_footer();?>
</body>
</html>