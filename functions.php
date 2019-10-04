<?php

/**
 * Chenco Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chenco
 */

add_action('wp_enqueue_scripts', 'generatepress_parent_theme_enqueue_styles');

/**
 * Enqueue scripts and styles.
 * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 */
function generatepress_parent_theme_enqueue_styles()
{
  wp_enqueue_style('slick-style', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', '1.8.1', 'all');
  wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', '1.8.1', 'all');
  wp_enqueue_style('fancybox-style', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', '3.5.7', 'all');
  wp_enqueue_style('generatepress-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style(
    'chenco-style',
    get_stylesheet_directory_uri() . '/style.css',
    'all'
  );

  wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=AIzaSyBMZLXZwNLw2ipOCmrNmQlJIoT4tfr_Hkg', array(), false, false);
  wp_enqueue_script('slick', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js');
  wp_enqueue_script('fancybox', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js');
  wp_enqueue_script('chenco-js', get_stylesheet_directory_uri() . '/script.js', array('google-maps', 'slick', 'fancybox'));
}

/**
 * Remove bottom footer bar & copyright
 */
// add_action('after_setup_theme', 'chenco_remove_footer_area');
// function chenco_remove_footer_area()
// {
//   remove_action('generate_footer', 'generate_construct_footer');
// }

/**
 * Load Google Maps API for ACF
 */
add_action('acf/init', 'chenco_acf_init');
function chenco_acf_init()
{
  // acf_update_setting('google_api_key', 'AIzaSyBMZLXZwNLw2ipOCmrNmQlJIoT4tfr_Hkg');
}
