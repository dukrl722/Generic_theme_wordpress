<?php
// List Post Blog
add_action('wp_ajax_nopriv_more_post_blog_ajax', 'ListPostBlog');
add_action('wp_ajax_more_post_blog_ajax', 'ListPostBlog');
function ListPostBlog()
{
    global $post;
    $out = '';

    if (is_home()) {
        $ppp = 3;
        $page = 0;
    } else {
        $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 9;
        $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    }

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'blog',
        'posts_per_page' => $ppp,
        'paged' => $page,
        'orderby' => 'id',
        'order' => 'DESC',
        'post_status' => 'publish'
    );

    $blogHome = new WP_Query($args);

    if ($blogHome->have_posts()) :
        $out .= '<nav>';
        while ($blogHome->have_posts()) : $blogHome->the_post();
            $title = get_the_title();
            $description = get_field('short_description', get_the_ID());
            $image = get_the_post_thumbnail_url(get_the_ID(), 'blog-thumb');
            $url = get_permalink();

            // categories
            $taxonomy = 'categoria_blog';
            $terms = wp_get_object_terms(get_the_ID(), $taxonomy);

            $out .= '<li>';

            $out .= '<div class="category">';
            foreach ($terms as $term) {
                $out .= '<a href="/' . $taxonomy . '/' . $term->slug . '">' . $term->name . '</a>';
            }
            $out .= '</div>';

            $out .= '</li>';
        endwhile;
        $out .= '</nav>';
    else:
        return false;
    endif;

    wp_reset_postdata();
    echo $out;
}


// List Last Post - Sidebar
function BlogListLastPosts()
{
    global $post;
    $out = '';

    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => 5,
        'orderby' => 'id',
        'order' => 'DESC',
        'post_status' => 'publish'
    );

    $blogListLast = new WP_Query($args);

    if ($blogListLast->have_posts()) :
        $out .= '<ul class="list-recents">';
        while ($blogListLast->have_posts()) : $blogListLast->the_post();
            $title = get_the_title();
            $date_post = get_the_date('j \d\e F \d\e Y');
            $url = get_permalink();

            $out .= '<li>';
            $out .= '<a href="' . $url . '" title="' . $title . '">';
            $out .= '<h5>' . $title . '</h5>';
            $out .= '<span>' . $date_post . '</span>';
            $out .= '</a>';
            $out .= '</li>';

        endwhile;
        $out .= '</ul>';
    else:
        $out .= '<div class="msg-box is-info">No Results found!</div>';
    endif;

    wp_reset_postdata();
    echo $out;
}


// Search Blog Results
function ResultSearch()
{
    global $post;
    $out = '';

    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => -1,
        'orderby' => 'id',
        'order' => 'DESC',
        'post_status' => 'publish',
        's' => $_GET['s'],
    );

    $results_search_blog = new WP_Query($args);

    if ($results_search_blog->have_posts()) :
        $out .= '<nav>';
        while ($results_search_blog->have_posts()) : $results_search_blog->the_post();
            $title = get_the_title();
            $description = get_the_content();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'blog-thumb');
            $url = get_permalink();

            // categories
            $taxonomy = 'category_blog';
            $terms = wp_get_object_terms(get_the_ID(), $taxonomy);

            $out .= '<li>';
            $out .= '<div class="category">';
            foreach ($terms as $term) {
                $out .= '<a href="/' . $taxonomy . '/' . $term->slug . '">' . $term->name . '</a>';
            }
            $out .= '</div>';
            $out .= '</li>';
        endwhile;
        $out .= '<nav>';
    else:
        $out .= '<div class="msg-box is-info">No Results found!</div>';
    endif;

    wp_reset_postdata();
    return $out;
}


// List Taxonomy category Blog
function ListTaxonomyCategoryBlog()
{
    global $post;
    $out = '';

    $terms = get_terms(
        array(
            'post_type' => 'blog',
            'taxonomy' => 'category_blog',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
        )
    );

    if (!empty($terms) && is_array($terms)) {
        $out .= '<ul class="list-category-blog">';
        foreach ($terms as $term) {
            $title = $term->name;
            $out .= '<li><a href="/category_blog/' . $term->slug . '" data-name="' . $term->slug . '" title="' . $title . '">' . $title . '</a></li>';
        }
        $out .= '</ul>';
    }

    wp_reset_postdata();
    return $out;
}


// List Post Blog in Taxonomy
function ListPostTaxonomy()
{
    global $post;
    $out = '';

    $taxonomy = 'category_blog';
    $cat_id = get_queried_object()->term_id;

    $tax_post_args = array(
        'post_type' => 'blog',
        'posts_per_page' => -1,
        'orderby' => 'name',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'id',
                'terms' => $cat_id
            )
        )
    );

    $post_cat_blog = new WP_Query($tax_post_args);

    if ($post_cat_blog->have_posts()) :
        $out .= '<nav>';
        while ($post_cat_blog->have_posts()) : $post_cat_blog->the_post();
            $title = get_the_title();
            $description = get_the_content();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'blog-thumb');
            $url = get_permalink();

            // categories
            $terms = wp_get_object_terms(get_the_ID(), $taxonomy);

            $out .= '<li>';
            $out .= '<div class="category">';
            foreach ($terms as $term) {
                $out .= '<a href="/' . $taxonomy . '/' . $term->slug . '">' . $term->name . '</a>';
            }
            $out .= '</div>';
            $out .= '</li>';
        endwhile;
        $out .= '<nav>';
    else:
        $out .= '<div class="msg-box is-info">No Results found!</div>';
    endif;

    wp_reset_postdata();
    return $out;
}
