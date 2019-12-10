<?php

/* Template Name: Our Firm Page */

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

    <div class="grid-container">

    </div>

    <?php while (have_posts()) : the_post(); ?>



    <div class="tabs">
      <div class="container">
        <ul class="tabs-nav">
          <li class="tab active" data-tab="1">
            <img src="/wp-content/uploads/2019/12/noun_firm_2274591.png" class="tab__icon" />
            Our Firm
          </li>
          <li class="tab" data-tab="2">
            <img src="/wp-content/uploads/2019/12/noun_performance_1650786.png" class="tab__icon" />
            Our Performance
          </li>
          <li class="tab" data-tab="3">
            <img src="/wp-content/uploads/2019/12/noun_funds_232470.png" class="tab__icon" />
            Our Funds
          </li>
          <li class="tab" data-tab="4">
            <img src="/wp-content/uploads/2019/12/noun_business-to-business_2343503.png" class="tab__icon" />
            Our Business
          </li>
        </ul>
      </div>

      <div class="tab-container">
        <div class="tab-content active" data-content="1">
          <div class="container">
            <section class="firm__section">
              <div class="firm__section--top">
                <div class="">
                  <h1 class="heading">Our Vision</h1>

                  <h2 class="firm__subheading">Excepteur ut fugiat reprehenderit ipsum amet pariatur aliqua irure</h2>
                  <p>Reprehenderit dolore aute id pariatur laborum sint voluptate cupidatat sit elit qui officia. Nisi
                    exercitation deserunt aliqua excepteur nostrud duis dolore eu duis sit est velit dolor. Do
                    incididunt.</p>
                  <a href="#">Meet Our Industry Executives</a>
                </div>
                <img src="/wp-content/uploads/2019/12/OurFirm_Image.jpg" />
              </div>
              <div class="firm__section--bottom">
                <p>Enim consequat amet eu eiusmod tempor elit quis et sint. Non dolor aute nisi anim aliqua dolor aliqua
                  ea.
                  Qui ut irure nulla et commodo duis laboris et qui exercitation in. Ipsum cillum esse incididunt amet
                  anim
                  nisi ad mollit officia excepteur aute nulla et. Velit aliquip dolor pariatur ullamco commodo. Ipsum
                  tempor
                  velit ex velit eiusmod ipsum minim incididunt duis Lorem. Qui ea et sint id fugiat fugiat.</p>
              </div>
            </section>
          </div>
        </div>
        <div class="tab-content" data-content="2">
          <div class="container">
            <section class="performance__section">
              <img src="/wp-content/uploads/2019/12/OurPerformance_Graphic.png" />
              <p>Nostrud ipsum quis cupidatat commodo irure eiusmod nostrud ex fugiat consequat. Voluptate eu
                adipisicing velit deserunt deserunt laboris. Aliqua fugiat aliqua nostrud dolore.</p>
            </section>
          </div>
        </div>
        <div class="tab-content" data-content="3">
          <div class="container">
            <section class="fund__section">
              <img src="/wp-content/uploads/2019/12/OurFirm_Image.jpg" />
              <div class="">
                <p>Our firm has an unparalleled local market presence and deep experience across the U.S. and Asia. Our
                  multi-strategy platform provides investors with a diverse array of funds and products. We also create
                  funding and operational solutions for our investment partners and portfolio companies across the
                  world.</p>
                <p>Pacific Rim Properties Fund Series. This group of funds started in 1992 as a conduit for friends and
                  family to invest in U.S. real estate. Chenco has built co-investment relationships with numerous
                  top-tier institutional investors in the United States. Pacific Rim Properties Funds focus on
                  value-added strategy in commercial real estate, and primarily invest in properties in the west coast
                  and the Sun Belt region.</p>
                <p>Pacific Rim Properties Land Fund Series: The Land Fund Series focuses on residential land
                  development, capitalizing on the opportunity shortage of single-family residential lots in the United
                  States. The strategy is to purchase raw land, acquire development permits, and complete infrastructure
                  prior to disposition.</p>
              </div>
            </section>
          </div>
        </div>
        <div class="tab-content" data-content="4">
          <section class="business__section">
            <div class="container">
              <h1 class="heading alt">Our Businesses</h1>

              <h2 class="firm__subheading">Real Estate Fund Management</h2>
              <p>With over 28 years of industry experience, we have access to nationwide real estate investments
                and financing opportunities. We continue building close relationships with clients in the United
                States and the Greater China Region. We deliver attractive risk-adjusted returns to our clients.</p>

              <h2 class="firm__subheading">Real Estate Venture Capital</h2>
              <p>We have co-founded several successful companies, including The Bascom Group, and Premier
                Workspaces. We continue to actively pursue venture capital investments in the United States and Asia.
              </p>
            </div>
          </section>
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