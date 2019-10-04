<?php

/**
 * The template for displaying gallery on home page.
 */

$images = get_field('gallery');
if ($images) : ?>

<section class="home-slick">
  <?php foreach ($images as $image) : ?>
  <div class="slick__container">
    <div class="slick__heading">
      <h2>We got you. Seriously</h2>
      <p>Team of our first class rockstar trainers, got you covered.<br>
        Health plans, strength training... you name it.</p>
    </div>

    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" />

    <div class="slick__body">
      <p class="slick__title"><?= $image['title']; ?></p>
      <p class="slick__caption"><?= $image['caption']; ?></p>
      <a href="#">Meet all our coaches</a>
    </div>

  </div>
  <?php endforeach; ?>
</section>

<?php endif; ?>