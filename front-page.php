<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */
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

        <div class="front">
            <div class="front-top"></div>
            <div class="front-mid-left">
                <h3>Value-Based Investing</h3>
                <span class="front-line"></span>
                <h1>
                    Over 29 years, we have enhanced our portfolio 
                    value through proven asset management and 
                    operational expertise
                </h1>
                <div>
                    <a href="https://www.google.com">Value-Based Investing</a>
                </div>
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
