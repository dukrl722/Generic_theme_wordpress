<?php
// LOGO TYPE
//--------------------------------------
function Logo()
{
    $out = '';
    if (function_exists('the_custom_logo')) {
        $out .= the_custom_logo();
    }
    return $out;
}


// PAGE TITLE
//--------------------------------------
function PageTitle()
{
    $out = '';

    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } elseif (is_page()) {
        $title = get_the_title('', false);
    } else {
        $title = 'Error returning title';
    }

    // title blog
    if (get_post_type() == 'blog') $title = 'BLOG';

    $out .= '<div class="page-title">';
    $out .= '<h1>' . $title . '</h1>';
    $out .= '</div>';

    return $out;
}

// Base URL
//--------------------------------------
function BaseURL()
{
    $out = '';
    $out .= get_template_directory_uri();
    return $out;
}


// Base image URL
//--------------------------------------
function BaseImageURL()
{
    $out = '';
    $out .= get_template_directory_uri() . '/assets/images';
    return $out;
}


// CLEAR NUMBER PHONE - TEL:number
//--------------------------------------
function ClearPhone($value)
{
    $value = trim($valor);
    $value = str_replace("(", "", $value);
    $value = str_replace(")", "", $value);
    $value = str_replace(" ", "", $value);
    $value = str_replace(".", "", $value);
    $value = str_replace(",", "", $value);
    $value = str_replace("-", "", $value);
    $value = str_replace("/", "", $value);

    return $value;
}


// FORMAT CONTENT POSTS
//--------------------------------------
function ContentFormatting($more_link_text = '(more...)', $stripteaser = 0, $more_file = '')
{
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
