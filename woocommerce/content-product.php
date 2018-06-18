<?php
defined( 'ABSPATH' ) || exit;
global $product;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$status_values = [
  'for_sale' => "FOR SALE",
  'for_rent' => "FOR RENT"
];
if (function_exists('get_field')):
  $basic_information = get_field('basic_information', $product->get_id());
  $location = $basic_information['location'];
  $status = $basic_information['status'] ? $basic_information['status'] : false;

  $condition = get_field('condition', $product->get_id());
  $conditions = (object) $condition;
endif;

$limite_str = 30;
$title = strlen($product->get_title()) > $limite_str ?
    substr($product->get_title() , 0, $limite_str) . '...' :
    $product->get_title();

?>

<div class="col-md-4 col-sm-6 col-xs-12">
  <div class="single-property mb-40 fadeInUp wow" data-wow-delay="0.2s">
    <?php if ($status): ?>
      <span><?= $status_values[$status] ?></span>
    <?php endif; ?>
    <div class="property-img">
      <a href="<?= get_the_permalink() ?>">
        <!-- <img src="img/property/7.jpg" alt=""> -->
        <?php echo woocommerce_get_product_thumbnail(); ?>
      </a>
    </div>
    <div class="property-desc">
      <div class="property-desc-top">
        <h6>
          <a href="<?= get_the_permalink() ?>" title="<?= $product->get_title() ?>"><?= $title ?></a>
        </h6>
        <h4 class="price euroMoney"><?= $product->get_price() ?></h4>
        <p class="mg-price mgaMoney"></p>
        <div class="property-location">
          <p><img src="<?= get_template_directory_uri() . '/img/icons/icon-5.png' ?>" alt=""><?= $location ?></p>
        </div>
      </div>
      <div class="property-desc-bottom">
        <?php do_action('action_property_bottom_list', $conditions); ?>
      </div>
    </div>
  </div>
</div>