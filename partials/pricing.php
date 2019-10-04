<?php

/**
 * The template for displaying pricing table on home page.
 */

?>

<section class="pricing">
  <div class="grid-container">

    <h2 class="pricing__heading">Find the right plan</h2>

    <?php if (have_rows('pricing')) : ?>

    <div class="pricing-container">

      <?php while (have_rows('pricing')) : the_row(); ?>

      <div class="pricing__group">

        <div class="pricing__main">
          <h3><?php the_sub_field('title'); ?></h3>

          <?php if (have_rows('features')) : ?>

          <ul class="pricing__list">
            <?php while (have_rows('features')) : the_row(); ?>
            <li class="pricing__list-item"><?php the_sub_field('text'); ?></li>
            <?php endwhile; ?>
          </ul>

          <?php endif; ?>

        </div>

        <a href="#" class="btn pricing__cta"><span><?php the_sub_field('cta_text') ?></span></a>

      </div>

      <?php endwhile; ?>

    </div>

    <?php endif; ?>

  </div>
</section>