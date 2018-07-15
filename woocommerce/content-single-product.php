<?php
/**
 * Copyright (c) 2018 Tiafeno Finel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files, to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

defined( 'ABSPATH' ) || exit;
global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( function_exists( 'get_field' ) ):

	// View acf.php file
	$acfField = new stdClass();
	$acfField->product_id = $product->get_id();
	msServices::setACFFields( $acfField );
endif;

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.

	return;
}
// TODO: Travailler sur la responsive
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="single-property-details">
		<div class="property-details-img">
			<?php woocommerce_show_product_sale_flash() ?>
			<?= do_shortcode('[property-carousel-image]') ?>
		</div>

		<div class="property-desc">
			<div class="property-desc-top">
					<div class="property-spec">
						<div class="row pl-20 pr-20">
							<div class="col-6">
								<h6>
										<?= $product->get_title() ?>
								</h6>
							</div>
							<div class="col-6">
								<h4 class="price ariary text-right" style="font-size: 25px">
									<?= $product->get_price() ?>
								</h4>
							</div>
						</div>

						<div class="row pl-20 pr-20">
							<div class="col-6">
								<h6 class="float-left">Réf: <?= $product->get_sku() ?></h6>
							</div>
							<div class="col-6">
								<h6 data-convert="<?= $product->get_price() ?>" data-convert-to="EUR" class="text-right"></h6>
							</div>
						</div>
					</div>
				<div class="property-location">
					<p><img src="<?= get_template_directory_uri() . '/img/icons/icon-5.png' ?>" alt=""><?= $acfField->location ?></p>
				</div>
			</div>
		</div>

		<!-- Condition & Amenities -->
		<div class="condition-amenities">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="property-condition">
						<div class="condtion-title">
							<h5>Condition</h5>
						</div>
						<div class="property-condition-list">
							<ul>
								<li>
									<img src="<?= get_template_directory_uri() . '/img/icons/icon-6.png' ?>" alt="">
									<span><?= __('Area', __SITENAME__) ?> <?= $acfField->surface ?> <?= convertUnit($acfField->unit) ?></span>
								</li>
								<?php if ( $acfField->property != 'ground' ): ?>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-7.png' ?>" alt="">
										<span><?= __('Bedroom', __SITENAME__) ?> <?= $acfField->bedroom ?></span>
									</li>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-8.png' ?>" alt="">
										<span><?= __('Bathroom', __SITENAME__) ?> <?= $acfField->bathroom ?></span>
									</li>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-9.png' ?>" alt="">
										<span><?= __('Garage', __SITENAME__)?>  <?= $acfField->garage ?></span>
									</li>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-10.png' ?>" alt="">
										<span><?= __('Kitchen', __SITENAME__) ?> <?= $acfField->kitchen ?></span>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>

				<?php if ( $acfField->property != 'ground' && ! empty( $acfField->amenities ) ): ?>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="amenities">
							<div class="amenities-title">
								<h5>Équipements</h5>
							</div>
							<div class="amenities-list">
								<ul>
									<?php
									if ($acfField->amenities):
										foreach ( $acfField->amenities as $amenitie ): ?>
											<li><i class="fa fa-check-circle"></i> <span><?= __($amenitie, __SITENAME__) ?></span></li>
										<?php
										endforeach;
									endif;
									?>
								</ul>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- Condition & Amenities end-->

		<!-- Description -->
		<?php
		$description = $product->get_description();
		if ( ! empty( $description ) ) :
			?>
			<div class="single-property-description">
				<div class="desc-title">
					<h5>Description</h5>
				</div>
				<div class="description-inner">
					<p>
						<?= $description ?>
					</p>
				</div>
			</div>
		<?php endif; ?>
		<!-- Description .end -->

		<div class="planning">
			<div class="row">
				<div class="col-md-12">
					<?php
					if ( ! empty( $location ) ):
						$location = get_field( 'map', $product->get_id() );
						?>
						<div class="google-map">
							<div class="google-map-title">
								<h5>Sur la carte</h5>
							</div>
							<div class="google-map-content">
								<div class="acf-map">
									<div class="marker" data-lat="<?= $location['lat']; ?>"
									     data-lng="<?= $location['lng']; ?>"></div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?= do_shortcode('[vc_property_recently title="Propriété ajoutée récemment"]') ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
