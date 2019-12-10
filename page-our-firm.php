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

    <div class="container">

      <div class="tabs">
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

        <div class="tab-container">
          <div class="tab-content active" data-content="1">
            <div>
              <div>
                <h1>Our Vision</h1>

                <h2>Excepteur ut fugiat reprehenderit ipsum amet pariatur aliqua irure</h2>
                <p>Reprehenderit dolore aute id pariatur laborum sint voluptate cupidatat sit elit qui officia. Nisi
                  exercitation deserunt aliqua excepteur nostrud duis dolore eu duis sit est velit dolor. Do incididunt
                  aliquip aliquip deserunt nulla laborum non incididunt sit adipisicing do ullamco quis. Ex id sit
                  cillum
                  quis
                  eu voluptate ut est est pariatur Lorem amet duis labore.</p>
                <a href="#">Meet Our Industry Executives</a>
              </div>
              <img src="" />
            </div>
            <p>Enim consequat amet eu eiusmod tempor elit quis et sint. Non dolor aute nisi anim aliqua dolor aliqua ea.
              Qui ut irure nulla et commodo duis laboris et qui exercitation in. Ipsum cillum esse incididunt amet anim
              nisi ad mollit officia excepteur aute nulla et. Velit aliquip dolor pariatur ullamco commodo. Ipsum tempor
              velit ex velit eiusmod ipsum minim incididunt duis Lorem. Qui ea et sint id fugiat fugiat.</p>

          </div>
          <div class="tab-content" data-content="2">
            Tab 2 content
          </div>
          <div class="tab-content" data-content="3">
            Tab 3 content
          </div>
          <div class="tab-content" data-content="4">
            Tab 4 content
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