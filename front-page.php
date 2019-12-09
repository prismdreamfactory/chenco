<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package GeneratePress
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

        <!-- <section class="mission">
            <div class="grid-container">

                <div class="mission__heading">
                    <h2><?php the_field('heading'); ?></h2>
                </div>

                <div class="mission__description"><?php the_field('text'); ?></div>

            </div>
        </section> -->

        <?php get_template_part('partials/map'); ?>

        <!-- <section class="newsletter">
            <div class="grid-container">
                <?= do_shortcode('[mc4wp_form id="49"]'); ?>
            </div>
        </section> -->


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
