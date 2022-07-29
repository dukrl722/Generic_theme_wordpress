<?php get_header(); ?>

    <?php if (is_post_type_archive('POST_NAME')): ?>
        <!-- content -->
    <?php endif; ?>

    <?php if (is_taxonomy('TAXONOMY_NAME') && !is_post_type_archive()): ?>
        <!-- content -->
    <?php endif; ?>

    <h2>Archive</h2>

<?php get_footer(); ?>
