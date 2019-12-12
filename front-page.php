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
      <div class="front-hero">
        <div class="front-hero-content">
          <h1>Proven Real Estate <br /> Expertise.</h1>
          <h3>We've built a strong track record of value <br />creation for our investors</h3>
          <a class="btn">Learn More</a>
        </div>
      </div>
      <div class="front-summary">
        <div class="front-summary-text">
          <h4 class="heading alt">Value-Based Investing</h4>
          <h1>
            Over 29 years, we have enhanced our portfolio
            value through proven asset management and
            operational expertise
          </h1>
          <div class="front-summary-link">
            <div class="link">
              <a href="https://www.google.com">Value-Based Investing</a>
            </div>
            <div class="link">
              <a href="https://www.google.com">Reliabe Partners</a>
            </div>
            <div class="link">
              <a href="https://www.google.com">Investment Portfolio</a>
            </div>
            <div class="link">
              <a href="https://www.google.com">A Balanced Team</a>
            </div>
          </div>
        </div>
      </div>

      <div class="front-news">
        <h4 class="heading">Corporate Releases</h4>
        <div class="front-news-item">
          <p>March 22, 2019</p>
          <a href="https://www.google.com">Chenco Holdings Expands Into Korea Through Formation of CHK Partners Co.,
            Ltd.</a>
        </div>
        <span></span>
        <div class="front-news-item">
          <p>March 22, 2019</p>
          <a href="https://www.google.com">Chenco Holdings Commences Fundraising For Pacific Rim Properties XVIII</a>
        </div>
        <span></span>
        <h4>Recent News</h4>
        <span class="front-line"></span>
        <div class="front-news-item">
          <p>March 22, 2019</p>
          <a href="https://www.google.com">Chenco Holdings Commences Fundraising For Pacific Rim Properties XVIII</a>
        </div>
        <span></span>
        <div class="front-news-item">
          <p>March 22, 2019</p>
          <a href="https://www.google.com">Chenco Holdings Commences Fundraising For Pacific Rim Properties XVIII</a>
        </div>
      </div>

      <div class="front-project-image"></div>
      <div class="front-project">
        <h4 class="heading">Project Profile</h4>
        <h1>Reno Daybreak: Addressing the "Missing Middle" With A New, Inspired, And Attainable Master Planned
          Community.</h1>
        <a class="btn" href="https://www.google.com">Learn More</a>
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