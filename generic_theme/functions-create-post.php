<?php
// CREATE POST BLOG
//--------------------------------------
add_action('init', 'register_blog_post_type');

function register_blog_post_type()
{
    $labels = [
        'name' => __('Blog'),
        'singular_name' => __('Blog'),
        'add_new' => __('Add new'),
        'add_new_item' => __('Add new'),
        'edit_item' => __('Edit'),
        'new_item' => __('New Post'),
        'all_items' => __('List all'),
        'view_item' => __('View Previous Post'),
        'search_items' => __('search'),
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Add Image'
    ];

    $args = [
        'labels' => $labels,
        'description' => '',
        'public' => true,
        'menu_position' => 30,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'has_archive' => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => 'dashicons-welcome-write-blog'
    ];

    register_post_type('blog', $args);
}

// CREATE TAXONOMY CATEGORY BLOG
//--------------------------------------
function register_new_taxonomy()
{
    register_taxonomy(
        'category_blog',
        'blog',
        [
            'label' => __('Categories'),
            'rewrite' => ['slug' => 'category_blog']
        ]
    );
}

add_action('init', 'register_new_taxonomy', 10);
