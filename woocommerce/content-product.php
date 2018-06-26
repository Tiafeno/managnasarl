<?php
defined( 'ABSPATH' ) || exit;
global $product;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$status_values = [
	'for_sale' => __( "For sale", __SITENAME__ ),
	'for_rent' => __( "For rent", __SITENAME__ )
];
if ( function_exists( 'get_field' ) ):
	msServices::setACFFields( $product );
endif;

?>

<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="single-property mb-40 fadeInUp wow" data-wow-delay="0.2s">
		<?php if ( $product->status ): ?>
			<span class="<?= $product->status ?>"><?= $status_values[ $product->status ] ?></span>
		<?php endif; ?>
		<div class="property-img">
			<a href="<?= get_the_permalink() ?>">
				<!-- <img src="img/property/7.jpg" alt=""> -->
				<?= woocommerce_get_product_thumbnail(); ?>
			</a>
		</div>
		<div class="property-desc">
			<div class="property-desc-top">
				<h6>
					<a href="<?= get_the_permalink() ?>"
					   title="<?= $product->get_title() ?>"><?= strLimite( $product->get_title(), 30 ) ?></a>
				</h6>
				<h4 class="price ariary"><?= $product->get_price() ?></h4>
				<!--        <p class="mg-price mgaMoney"></p>-->
				<div class="property-location">
					<p>
						<img src="<?= get_template_directory_uri() . '/img/icons/icon-5.png' ?>" alt="">
						<?= strLimite( $product->location, 40 ) ?>
					</p>
				</div>
			</div>
			<div class="property-desc-bottom">
				<?php do_action( 'action_property_bottom_list', $product ); ?>
			</div>
		</div>
	</div>
</div>
