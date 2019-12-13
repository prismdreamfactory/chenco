<?php

/* Template Name: Bascom Operators Page */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" <?php generate_do_element_classes('content'); ?>>
  <main id="main" <?php generate_do_element_classes('main'); ?>>
    <?php
    /**
     * generate_before_main_content hook.
     *
     * @since 0.1
     */
    do_action('generate_before_main_content'); ?>

    <?php while (have_posts()) : the_post(); ?>

      <div class="grid-container"></div>

    <?php endwhile; ?>
    
    <div class="bascom container">
        <div class="team-header">
            <h1><?php the_title(); ?></h1>
            <span class="front-line"></span>
            <p><?php the_content(); ?></p>
            <div class="bascom-filter-container">
              <p>Filter by</p>
              <input placeholder="Sector: All" >
              <input  placeholder="Option" >
              <input  placeholder="Option" >
            </div>
        </div>
        <div class="bascom-container">
          <?php
          $loop = new WP_Query(
            array(
              'posts_per_page' => 8,
            )
          );
          while ($loop->have_posts()) : $loop->the_post(); ?>

            <div class="bascom__item">
                <img src="https://via.placeholder.com/80" alt="img"/>
                <h3>Company Name LLC</h3>
                <div class="bascom__item__description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="bascom-info">
                        <p>12345 Address Goes Here, 205</p>
                        <p>City, State 12345</p>
                        <p>+1 234-567-8901</p>
                        <p>www.website.com</p>
                    </div>
                </div>
            </div>

          <?php endwhile; ?>
        </div>
    </div>

    <?php
    /**
     * generate_after_main_content hook.
     *
     * @since 0.1
     */
    do_action('generate_after_main_content');
    ?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
/**
 * generate_after_primary_content_area hook.
 *
 * @since 2.0
 */
do_action('generate_after_primary_content_area');

generate_construct_sidebars();

get_footer();
