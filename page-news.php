<?php

/* Template Name: News Page */

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

      <div class="grid-container">

        <!-- <h1><?php the_title(); ?></h1> -->

        <p><?php the_content(); ?></p>

      </div>

    <?php endwhile; ?>

    <div class="news container">
        <?php
        $loop = new WP_Query(
            array(
                'post_type' => '',
                'posts_per_page' => 8,
            )
        );
            while ($loop->have_posts()) : $loop->the_post(); ?>

            <div class="news-item">
                <h5><?php the_date(); ?></h5>
                <span class="front-line"></span>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <a class="btn">Read More</a>
            </div>

    <?php endwhile; ?>
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
