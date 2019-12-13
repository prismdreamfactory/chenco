<?php

/**
 * The template for displaying google map on home page.
 */

?>

<section class="map">

  <div class="map__tabs">
    <div class="map__tab font--alt" data-center="global">Global</div>
    <div class="map__tab font--alt mod--active" data-center="usa">U.S. Properties</div>
    <div class="map__tab font--alt" data-center="asia">Asia Properties</div>
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
      while ($loop->have_posts()) : $loop->the_post(); ?>

      <?php if (have_rows('location')) : the_row();
            $lat = get_sub_field('latitude');
            $lng = get_sub_field('longitude');
            $type = get_field('asset_type');
            $current = get_field('current_property', false, false);

            if ($type['value'] == 'O') {
              $officeSqft = get_field('sqft');
              $indSqft = '';
            } elseif ($type['value'] == 'Ind') {
              $officeSqft = '';
              $indSqft = get_field('sqft');
            } else {
              $officeSqft = '';
              $indSqft = '';
            }

            $stats = $officeSqft . "," . get_field('units') . "," . get_field('acres') . "," . $indSqft;
            ?>

      <div class="marker" style="display: none;" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>"
        data-type="<?= $type['label'] ?>" data-current="<?= $current; ?>" data-stats="<?= $stats ?>">
        <div class="map__info">
          <h3 class="map__info__heading"><?php echo $type['label']; ?>
          </h3>
          <p class="map__info__item">-
            <?php if (get_field('units')) : ?>
            <span class="units"><?php the_field('units') ?> Units</span>
            <?php endif; ?>
            <?php if (get_field('sqft')) : ?>
            <span class="sqft"><?php the_field('sqft'); ?> Sq. Ft.</span>
            <?php endif; ?>
            <?php if (get_field('acres')) : ?>
            <span class="acres"><?php the_field('acres') ?> Acres</span>
            <?php endif; ?>
          </p>

          <a href="javascript:" class="map__info__button">View Property</a>
        </div>
      </div>

      <?php endif; ?>

      <?php endwhile; ?>

    </div>

    <div class="map__legend">
      <div class="map__legend--main">
        <h3>California</h3>
        <p class="map__legend-row mod--office"><span><i>5,900,033</i> Sq. Ft.</span><span>Commercial Properties</span>
        </p>
        <p class="map__legend-row mod--multifamily"><span><i>24,719</i> Units</span><span>Multifamily Properties</span>
        </p>
        <p class="map__legend-row mod--land"><span><i>4,284</i> Acres</span><span>Land Acres</span></p>
        <p class="map__legend-row mod--industrial"><span><i>3,545,166</i> Sq. Ft.</span><span>Industrial
            Properties</span>
        </p>
      </div>
      <div class="map__legend--bottom">
        <label class="legend__label">Legend:</label>
        <ul class="legend__list">
          <li class="legend__list-item mod--office">Office (SF)</li>
          <li class="legend__list-item mod--multifamily">Multifamily (Units)</li>
          <li class="legend__list-item mod--land">Land (Acres)</li>
          <li class="legend__list-item mod--industrial">Industrial (SF)</li>
        </ul>
      </div>
    </div>

    <div class="map__switch">
      <div class="map__switch-item mod--active" data-current="true"><i></i>Current</div>
      <div class="map__switch-item" data-current="false"><i></i>Historical</div>
    </div>

  </div>

</section>