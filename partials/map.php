<?php

/**
 * The template for displaying google map on home page.
 */

?>

<section class="map">

  <div class="map__tabs">
    <div class="map__tab font--alt">Global</div>
    <div class="map__tab font--alt active">U.S. Properties</div>
    <div class="map__tab font--alt">Asia Properties</div>
  </div>

  <div class="map-wrapper">

    <div id="map">

      <?php
      $loop = new WP_Query(
        array(
          'post_type' => 'properties',
          'posts_per_page' => -1,
        )
      );
      while ($loop->have_posts()) : $loop->the_post();
        // $marker = get_sub_field('marker'); 

        ?>

      <?php if (have_rows('location')) : the_row();
            $lat = get_sub_field('latitude');
            $lng = get_sub_field('longitude');
            ?>

      <div class="marker" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>">
        <div class="map__info">
          <h3>test</h3>
        </div>
      </div>

      <?php endif; ?>

      <?php endwhile; ?>

    </div>

    <div class="map__legend">
      <div class="map__legend--main">
        <h3>California</h3>
        <p class="map__legend-row"><span>924,528,127 sq ft.</span><span>Office Properties</span></p>
        <p class="map__legend-row"><span>145 units</span><span>Multi-Family Properties</span></p>
      </div>
      <div class="map__legend--bottom">
        <p class="map__legend--bottom-text">Legend: <span>Office</span> <span>Multi-Family</span></p>
      </div>
    </div>

    <div class="map__switch">
      <div class="map__switch-item mod-active">Current</div>
      <div class="map__switch-item">Historical</div>
    </div>

  </div>

</section>