<?php

/**
 * The template for displaying google map on home page.
 */

?>

<section class="map">
  <h2>Come stop by</h2>

  <?php if (have_rows('gmaps')) : ?>

  <div id="map">

    <?php while (have_rows('gmaps')) : the_row();
        $marker = get_sub_field('marker'); ?>

    <div class="marker" data-lat="<?php echo $marker['lat']; ?>" data-lng="<?php echo $marker['lng']; ?>">
      <div class="map__info">
        <h3><?php the_sub_field('name'); ?></h3>
        <p><?php the_sub_field('address'); ?>
        </p>

        <?php if (have_rows('hours')) : ?>
        <table class="hours">
          <?php while (have_rows('hours')) : the_row(); ?>
          <tr>
            <td><?php the_sub_field('days'); ?></td>
            <td><?php the_sub_field('open_time'); ?> - <?php the_sub_field('close_time'); ?></td>
          </tr>
          <?php endwhile; ?>
        </table>
        <?php endif; ?>

        <?php $images = get_sub_field('gallery');

            if ($images) : ?>

        <div class="map__thumbs">
          <?php foreach ($images as $image) : ?>
          <a href="<?= $image['url']; ?>" data-fancybox="gallery" class="map__thumb">
            <img class="map__thumb-image" src="<?= $image['url']; ?>" />
            <?php if ($image == 3) : ?><span>12 more</span><?php endif; ?>
          </a>
          <?php endforeach; ?>
        </div>

        <?php endif; ?>

      </div>
    </div>

    <?php endwhile; ?>

  </div>

  <?php endif; ?>

</section>