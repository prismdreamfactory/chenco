<?php

/* Template Name: Contact Page */

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

        <h1><?php the_title(); ?></h1>

        <p><?php the_content(); ?></p>

      </div>

    <?php endwhile; ?>

    <div class="contact">
        <span class="contact-line"></span>
        <div class="contact-people-container">
            <div class="contact-people-item">
                <img class="contact-img" src="https://via.placeholder.com/150"/>
                <div class="contact-people-info">
                    <h3>United States</h3>
                    <p>Andrew Chen</p>
                    <p>+1 702 889-1818</p>
                    <p>#239</p>
                </div>
            </div>
            <div class="contact-people-item">
                <img class="contact-img" src="https://via.placeholder.com/150"/>
                <div class="contact-people-info">
                    <h3>Asia Pacific</h3>
                    <p>Jack Lin</p>
                    <p>+1 886 2-2778-1113</p>
                    <p>#338</p>
                </div>
            </div>
        </div>
        <h2>United States</h2>
        <span class="contact-header-line" ></span>
        <div class="contact-location-container">
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
        </div>
        <h2>Asia Pacific</h2>
        <span class="contact-header-line"></span>
        <div class="contact-location-container">
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
            </div>
            <div class="contact-location-item">
                <h3>Location Location</h3>
                <p>26 Coporate Park,</p>
                <p>Irvine, CA 92606</p>
                <p>+1 949 955-0888</p>
                <p>www.websitehere.com</p>
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
