<?php

/** Template version: 3.0.0
 *
 * -= 3.0.0 =-
 * - Improve UI for new master-skin
 *
 * -= 1.1.0 =-
 * - Updated markup
 *
 * -= 1.0.0 =-
 * - Initial version
 *
 */ ?>

<?php /** @var string $page_subtitle */ ?>
<?php /** @var string $all_items_url */ ?>
<?php /** @var WP_Query $content_query */ ?>
<?php /** @var string $item_template */ ?>

<?php
$current_addon_slug = 'customer-private-files';
$current_addon_icon = apply_filters('cuar/private-content/view/icon?addon=' . $current_addon_slug, 'fa fa-file');
$current_addon = cuar_addon($current_addon_slug);
$post_type = $current_addon->get_friendly_post_type();
?>

<?php $all_items_url = $current_addon->get_page_url(); ?>

<div class="panel top <?php echo $post_type; ?>">
  <div class="panel-heading">
    <span class="panel-title">
      <?php echo $page_subtitle; ?>
    </span>
    <span class="widget-menu pull-right">
      <a href="<?php echo esc_attr($all_items_url); ?>" class="btn btn-default btn-xs">
        <?php _e('View all', 'cuar'); ?>
      </a>
    </span>
  </div>
  <div class="panel-body pn">

    <div class="table__scroll">
      <table class="investor__files" summary="Investments">
        <thead>
          <tr>
            <th>Date</th>
            <th>Investor</th>
            <th>Investment</th>
            <th>Document Name</th>
            <th>Document Type</th>
            <th>Download</th>
          </tr>
        </thead>
        <tbody>
          <?php
                    while ($content_query->have_posts()) {
                        $content_query->the_post();
                        global $post;

                        include($item_template);
                    }
                    ?>
        </tbody>
      </table>
    </div>



  </div>
</div>