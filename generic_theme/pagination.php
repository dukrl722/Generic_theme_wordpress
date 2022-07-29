<?php
the_posts_pagination(array(
    'prev_text' => __('Previous page', '<'),
    'next_text' => __('Next page', '>'),
    'screen_reader_text' => __(' '),
    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('', 'cm') . ' </span>',
));
?>
