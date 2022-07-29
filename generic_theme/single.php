<?php get_header(); ?>

<div class="wrapper-content">
    <?php
    if (is_single() && get_queried_object()->post_type === 'product') :
        get_template_part('pages/products', 'detail');
    endif;
    ?>
</div>

<?php get_footer(); ?>
