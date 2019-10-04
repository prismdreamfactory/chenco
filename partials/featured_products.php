<?php

/**
 * The template for displaying featured products on home page.
 */
$post_objects = get_field('featured_products');
if ($post_objects) : ?>

<section class="featured">
  <div class="grid-container">

    <div class="featured__text">
      <h2>Share the passion</h2>
      <p>Support the movement by wearing the toughest gear in the wild.<br>
        Represent the chapter and yourself in the latest selected gear.</p>
      <a href="#">Browse our shop</a>
    </div>

    <div class="featured__images">
      <?php foreach ($post_objects as $post) : ?>

      <?php setup_postdata($post);
          $product = wc_get_product(get_the_ID());
          ?>

      <div class="featured__image">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail(); ?>

          <div class="featured__description">
            <div class="featured__description-text">
              <p><?php the_title(); ?></p>
              <p><?= $product->get_price(); ?></p>
            </div>
            <a href="<?= $product->add_to_cart_url(); ?>" data-quantity="1" data-product_id="<?= get_the_ID(); ?>" class="btn add_to_cart_button ajax_add_to_cart"><span>Buy Now</span></a>
          </div>
        </a>
      </div>
      <?php endforeach; ?>
    </div>

  </div>

</section>

<?php wp_reset_postdata();
endif;
