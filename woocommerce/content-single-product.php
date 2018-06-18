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
	$property          = get_field( 'property', $product->get_id() ); // 0:house, 1:ground
	$basic_information = get_field( 'basic_information', $product->get_id() );
	$location          = $basic_information['location'];
	$status            = $basic_information['status'] ? $basic_information['status'] : false;

	$condition  = get_field( 'condition', $product->get_id() );
	$conditions = (object) $condition;
	$amenities  = get_field( 'amenities', $product->get_id() );
endif;
$main_thumbnail = wp_get_attachment_image_src( $product->get_image_id(), 'large' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.

	return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="single-property-details">
		<div class="property-details-img">
			<?php woocommerce_show_product_sale_flash() ?>
			<img src="<?= $main_thumbnail[0] ?>" alt="">
		</div>

		<div class="property-desc">
			<div class="property-desc-top">
				<h6>
					<?= $product->get_title() ?>
				</h6>
				<h4 class="price euroMoney"><?= $product->get_price() ?></h4>
				<p class="mg-price mgaMoney"></p>
				<div class="property-location">
					<p><img src="<?= get_template_directory_uri() . '/img/icons/icon-5.png' ?>" alt=""><?= $location ?></p>
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
									<span>Area <?= $conditions->surface ? $conditions->surface : 0 ?> sqft</span>
								</li>
								<?php if ( $property != 'ground' ): ?>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-7.png' ?>" alt="">
										<span>Bedroom <?= $conditions->bedroom ? $conditions->bedroom : 0 ?></span>
									</li>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-8.png' ?>" alt="">
										<span>Bathroom <?= $conditions->bathroom ? $conditions->bathroom : 0 ?></span>
									</li>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-9.png' ?>" alt="">
										<span>Garage <?= $conditions->garage ? $conditions->garage : 0 ?></span>
									</li>
									<li>
										<img src="<?= get_template_directory_uri() . '/img/icons/icon-10.png' ?>" alt="">
										<span>Kitchen <?= $conditions->kitchen ? $conditions->kitchen : 0 ?></span>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>

				<?php if ( $property != 'ground' && ! empty( $amenities ) ): ?>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="amenities">
							<div class="amenities-title">
								<h5>Équipements</h5>
							</div>
							<div class="amenities-list">
								<ul>
									<?php
									if ( $amenities ):
										foreach ( $amenities as $amenitie ): ?>
											<li><i class="fa fa-check-circle"></i> <span><?= $amenitie['label'] ?></span></li>
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
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
