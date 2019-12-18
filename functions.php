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
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Domine:400,700|Maven+Pro:400,500,700&display=swap', false);
  wp_enqueue_style('select2-style', '//cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css', '4.0.12', false);
  wp_enqueue_style('slick-style', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', '1.8.1', false);
  wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', '1.8.1', false);
  // wp_enqueue_style('fancybox-style', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', '3.5.7', 'all');
  wp_enqueue_style('modal-style', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', '0.9.1', false);
  wp_enqueue_style('generatepress-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('chenco-style', get_stylesheet_directory_uri() . '/style.css', 'all', true);


  // wp_enqueue_script('google-maps-clusterer', '//developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', array(), false, false);
  wp_enqueue_script('google-maps', '//maps.googleapis.com/maps/api/js?key=' . getenv('GOOGLE_API_KEY'), array(), false, false);
  wp_enqueue_script('select2', '//cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js', array('jquery'), false, false);
  wp_enqueue_script('slick', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js', array('jquery'), false, false);
  wp_enqueue_script('countto', '//cdnjs.cloudflare.com/ajax/libs/jquery-countto/1.2.0/jquery.countTo.min.js', array('jquery'), false, false);
  // wp_enqueue_script('fancybox', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), false, false);
  wp_enqueue_script('modal', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js', array(), false, false);
  wp_enqueue_script('chenco-js', get_stylesheet_directory_uri() . '/script.js', array('countto', 'google-maps', 'slick', 'modal'));
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
  return '20';
});

add_filter('generate_footer_widget_2_width', function () {
  return '80';
});

/**
 * Load Google Maps API for ACF
 */
add_action('acf/init', 'chenco_acf_init');
function chenco_acf_init()
{
  acf_update_setting('google_api_key', getenv('GOOGLE_API_KEY'));
}

add_theme_support('customer-area.stylesheet');
// add_theme_support('customer-area.navigation-menu');
add_theme_support('customer-area.contextual-toolbar');
add_theme_support('customer-area.library.jquery.select2', array('files', 'markup'));
add_theme_support('customer-area.library.bootstrap.dropdown');
add_theme_support('customer-area.library.bootstrap.transition');
add_theme_support('customer-area.library.bootstrap.collapse');

/**
 * WP All Import hook to geocode provided address into lat and lng
 */
add_action('pmxi_saved_post', 'save_custom_field_address', 10, 3);
// add_action('save_post', 'save_custom_field_address', 10, 3);
function save_custom_field_address($post_id, $xml_data, $is_update)
{
  $address_custom_field = 'location_address'; // The custom field you imported the address into
  $api_key = getenv('GOOGLE_API_KEY');
  $lat_cf = 'location_latitude'; // The custom field you want the latitude imported into
  $lng_cf = 'location_longitude'; // The custom field you want the longitude imported into


  if ($address = get_post_meta($post_id, $address_custom_field, true)) {
    $google_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($address) . '&key=' . $api_key;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $google_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $json = curl_exec($curl);
    curl_close($curl);

    if (!empty($json)) {
      $details = json_decode($json, true);
      $lat = $details['results'][0]['geometry']['location']['lat'];
      $lng = $details['results'][0]['geometry']['location']['lng'];

      update_post_meta($post_id, $lat_cf, $lat);
      update_post_meta($post_id, $lng_cf, $lng);
    }
  }
}

/**
 * Custom navigation menu description
 */
add_filter('walker_nav_menu_start_el', 'chenco_menu_item_description', 10, 4);
function chenco_menu_item_description($item_output, $item, $depth, $args)
{
  if ('primary' == $args->theme_location || 'secondary' == $args->theme_location || 'slideout' == $args->theme_location) {
    $item_output = str_replace($args->link_after . '</a>', $args->link_after . '</span><span class="description">' . $item->description . '</span></a>', $item_output);
  }

  return $item_output;
}

function custom_rewrite_basic()
{
  // add_rewrite_rule('investor-portal/(.*)/', 'customer-area/$matches[1]/index.php', 'top');
  // add_rewrite_rule('customer-area/(.*)', 'investor-portal/$matches[1]/index.php', 'top');
  add_rewrite_rule('investor-portal/files/my-files/', 'customer-area/files/my-files/index.php', 'top');
}
add_action('init', 'custom_rewrite_basic');