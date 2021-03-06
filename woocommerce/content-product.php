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
	$acfFields = new stdClass();
	$acfFields->product_id = $product->get_id();
	msServices::setACFFields( $acfFields );
endif;

?>

<div class="col-md-6 col-sm-6 col-xs-12">
	<div class="single-property mb-40 fadeInUp wow" data-wow-delay="0.2s">
		<?php if ( $acfFields->status ): ?>
			<span class="<?= $acfFields->status ?>"><?= $status_values[ $acfFields->status ] ?></span>
		<?php endif; ?>
		<div class="property-img">
			<a href="<?= get_the_permalink() ?>">
				<!-- <img src="img/property/7.jpg" alt=""> -->
				<?= woocommerce_get_product_thumbnail(); ?>
			</a>
		</div>
		<div class="property-desc">
			<div class="property-desc-top">
				<div class="property-spec">
					<div class="row">
						<div class="col-md-12">
							<h6 class="property-title">
								<a href="<?= get_permalink($product->get_id()) ?>" title="<?= $product->get_title() ?>">
									<?= strLimite($product->get_title(), 39) ?>
								</a>
							</h6>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h6 class="text-left property-sku"><i class="fa fa-bookmark"></i> <?= $product->get_sku() ?></h6>
						</div>
					</div>
				</div>
				<div class="property-location">
					<p>
						<i class="fa fa-map-marker"></i>
						<?= strLimite( $acfFields->location, 40 ) ?>
					</p>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<h4 class="price ariary text-left"><?= $product->get_price() ?></h4>
					</div>
					<div class="col-xs-6">
						<h6 data-convert="<?= $product->get_price() ?>" data-convert-to="EUR" class="text-right price-convert"></h6>
					</div>
				</div>
			</div>
			<div class="property-desc-bottom">
				<?php do_action( 'action_property_bottom_list', $acfFields ); ?>
			</div>
		</div>
	</div>
</div>
