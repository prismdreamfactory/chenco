<?php

/* Template Name: Partners Page */

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

    <div class="partners">
      <div class="container">
        <h1 class="heading blue">Partners</h1>

        <p>We have a group of exceptional, multi-lingual and multi-cultural professionals who can handle diverse
          activities in our areas of endeavor. They provide full-spectrum investment and asset management services to
          our clients, delivering attractive investment returns.</p>
      </div>

      <div class="tabs tabs--alt">
        <div class="container">
          <ul class="tabs-nav">
            <li class="tab tab--1 active" data-tab="1">
              <div class="tab__image-wrap"><img src="/wp-content/uploads/2019/12/Bascom1.png"
                  class="tab__logo tab__logo-1" /></div>
            </li>
            <li class="tab tab--2" data-tab="2">
              <div class="tab__image-wrap"><img src="/wp-content/uploads/2019/12/Premier.png"
                  class="tab__logo tab__logo-2" /></div>
            </li>
            <li class="tab tab--3" data-tab="3">
              <div class="tab__image-wrap"><img src="/wp-content/uploads/2019/12/Steelwave.png"
                  class="tab__logo tab__logo-3" /></div>
            </li>
            <li class="tab tab--4" data-tab="4">
              <div class="tab__image-wrap"><img src="/wp-content/uploads/2019/12/Newport.png"
                  class="tab__logo tab__logo-4" /></div>
            </li>
          </ul>
        </div>

        <div class="tab-container">
          <div class="tab-content active" data-content="1">
            <div class="container">
              <section class="partners__section">
                <div class="partners__section--top">
                  <div>
                    <p class="highlight">The Bascom Group is a private equity firm specializing in value-added
                      multifamily,
                      commercial,
                      and non-performing loans and real estate related investments and operating companies.</p>
                    <p>Based in Irvine, California, the firm is involved principally in the acquisition of multi-family
                      housing that can increase in value via remodeling, repositioning and improved management. The
                      Bascom Group is a nationally recognized manager of distressed multi-family properties. The Bascom
                      Group
                      is ranked #1 in 2014 Multi-family Executive's (MFE) Top 25 Renovators List. Under the leadership
                      of
                      Jerry Fink and Dave Kim, the company has purchased over 63,000 apartment units since inception.
                    </p>
                  </div>
                  <div class="partners__contact">
                    <h4>Team Lead</h4>
                    <p>Name Goes Here</p>

                    <div class="partners__address">
                      <address>26 Corporate Park, Irvine, CA 92606 <br> +1 949 955-0888</address>
                      <a href="javascript:">www.websitehere.com</a>
                    </div>
                  </div>
                </div>

                <div class="partners__section--bottom">
                  <h2>Bascom Operators</h2>
                  <div class="slick operators">
                    <img src="/wp-content/uploads/2019/12/BascomNW.png" />
                    <img src="/wp-content/uploads/2019/12/Spirit_B.png" />
                    <img src="/wp-content/uploads/2019/12/REDA.png" />
                    <img src="/wp-content/uploads/2019/12/Milestone.png" />
                    <img src="/wp-content/uploads/2019/12/realm-logo-B.png" />
                  </div>

                  <a href="#" class="btn">Learn More</a>
                </div>
              </section>
            </div>
          </div>
          <div class=" tab-content" data-content="2">
            <div class="container">
              <section class="partners__section">
                <div class="partners__section--top">
                  <div>
                    <p>The Bascom Group is a private eequity firm specializing in value-added multifamily, commercial,
                      and non-performing loans and real estate related investments and operating companies.</p>
                    <p>Based in Irvine, California, the firm is involved principally in the acquisition of multi-family
                      housing that can increase in value via remodeling, repositioning and improved management. The
                      Bascom Group is a nationally recognized manager of distressed multi-family properties. The Bascom
                      Group is ranked #1 in 2014 Multi-family Executive's (MFE) Top 25 Renovators List. Under the
                      leadership of Jerry Fink and Dave Kim, the company has purchased over 63,000 apartment units since
                      inception.
                    </p>
                  </div>
                  <div>
                    <h4>Team Lead</h4>
                    <p>Name Goes Here</p>

                    <address>26 Corporate Park, Irvine, CA 92606 <br> +1 949 955-0888 <br> www.websitehere.com</address>
                  </div>
                </div>
              </section>
            </div>
          </div>
          <div class="tab-content" data-content="3">
            <div class="container">
              <section class="partners__section"></section>
            </div>
          </div>
          <div class="tab-content" data-content="4">
            <div class="container">
              <section class="partners__section"></section>
            </div>
          </div>
        </div>
      </div>

    </div>

    <?php endwhile;

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