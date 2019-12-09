<?php

/**
 * Chenco Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chenco
 */

/* Enqueue scripts/styles */
add_action('wp_enqueue_scripts', 'generatepress_parent_theme_enqueue_styles');

/**
 * Enqueue scripts and styles.
 * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 */
function generatepress_parent_theme_enqueue_styles()
{
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Domine:400,700|Maven+Pro:400,700&display=swap', false);
  wp_enqueue_style('slick-style', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', '1.8.1', 'all');
  wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', '1.8.1', 'all');
  // wp_enqueue_style('fancybox-style', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', '3.5.7', 'all');
  wp_enqueue_style('modal-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', '0.9.1', 'all');
  wp_enqueue_style('generatepress-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('chenco-style', get_stylesheet_directory_uri() . '/style.css', 'all');

  wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyBMZLXZwNLw2ipOCmrNmQlJIoT4tfr_Hkg', array(), false, false);
  wp_enqueue_script('slick', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js', array('jquery'), false, false);
  // wp_enqueue_script('fancybox', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), false, false);
  wp_enqueue_script('modal', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js', array(), false, false);
  wp_enqueue_script('chenco-js', get_stylesheet_directory_uri() . '/script.js', array('google-maps', 'slick', 'modal'));
}

/**
 * Remove bottom footer bar & copyright
 */
// add_action('after_setup_theme', 'chenco_remove_footer_area');
// function chenco_remove_footer_area()
// {
//   remove_action('generate_footer', 'generate_construct_footer');
// }
add_filter('generate_copyright', 'chenco_custom_copyright');
function chenco_custom_copyright()
{
  ?>
  © 2019 Chenco Holdings. All Rights Reserved.
<?php
}

add_filter('generate_footer_widget_1_width', function () {
  return '25';
});

add_filter('generate_footer_widget_2_width', function () {
  return '75';
});

/**
 * Load Google Maps API for ACF
 */
add_action('acf/init', 'chenco_acf_init');
function chenco_acf_init()
{
  acf_update_setting('google_api_key', 'AIzaSyBMZLXZwNLw2ipOCmrNmQlJIoT4tfr_Hkg');
}

add_theme_support('customer-area.stylesheet');

/**
 * Custom navigation menu
 */

class Chenco_Walker extends Walker_Page
{
  function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0)
  {
    $css_class = array('page_item', 'page-item-' . $page->ID);
    $button = '';

    if (isset($args['pages_with_children'][$page->ID])) {
      $css_class[] = 'menu-item-has-children';
      $icon = generate_get_svg_icon('arrow');
      $button = '<span role="presentation" class="dropdown-menu-toggle">' . $icon . '</span>';
    }

    if (!empty($current_page)) {
      $_current_page = get_post($current_page);
      if ($_current_page && in_array($page->ID, $_current_page->ancestors)) {
        $css_class[] = 'current-menu-ancestor';
      }
      if ($page->ID == $current_page) {
        $css_class[] = 'current-menu-item';
      } elseif ($_current_page && $page->ID == $_current_page->post_parent) {
        $css_class[] = 'current-menu-parent';
      }
    } elseif ($page->ID == get_option('page_for_posts')) {
      $css_class[] = 'current-menu-parent';
    }

    $css_classes = implode(' ', apply_filters('page_css_class', $css_class, $page, $depth, $args, $current_page));

    $args['link_before'] = empty($args['link_before']) ? '' : $args['link_before'];
    $args['link_after'] = empty($args['link_after']) ? '' : $args['link_after'];

    $output .= sprintf(
      '<li class="%s"><a href="%s">%s%s%s%s</a>',
      $css_classes,
      get_permalink($page->ID),
      $args['link_before'],
      apply_filters('the_title', $page->post_title, $page->ID),
      $args['link_after'],
      $button
    );
  }
}


// add_filter('wp_nav_menu_args', function ($args) {
//   if ('primary' === $args['theme_location'] && class_exists('Chenco_Walker')) {
//     $args['walker'] = new Chenco_Walker();
//   }

//   return $args;
// });
