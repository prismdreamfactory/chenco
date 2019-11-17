<?php

/**
 * The template for displaying google map on home page.
 */

?>

<section class="map">

  <?php if (have_rows('gmaps')) : ?>

    <div class="map__tabs">
      <div class="map__tab">Global</div>
      <div class="map__tab">U.S. Properties</div>
      <div class="map__tab">Asia Properties</div>
    </div>

    <div class="map-wrapper">

      <div id="map">

        <?php while (have_rows('gmaps')) : the_row();
            $marker = get_sub_field('marker'); ?>

          <div class="marker" data-lat="<?php echo $marker['lat']; ?>" data-lng="<?php echo $marker['lng']; ?>">
            <div class="map__info">
              <h3><?php the_sub_field('name'); ?></h3>
            </div>
          </div>

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

  <?php endif; ?>

</section>