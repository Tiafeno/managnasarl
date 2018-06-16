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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="single-property-details">
		<div class="property-details-img">
			<?php  woocommerce_show_product_sale_flash() ?>
			<img src="https://devitems.com/html/haven-preview/haven/img/property/single-property.jpg" alt="">
		</div>
		<div class="single-property-description">
			<div class="desc-title">
				<h5>Description</h5>
			</div>
			<div class="description-inner">
				<p class="text-1"> <span>Haven</span> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lore magna iqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut quipx ea codo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolo</p>
				<p class="text-2">haven is the Best  should be the consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore lore gna iqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex eacm emod tempor nt ut labore lore magna iqua. Ut enim ad minim veniamco laboris nisi ut aliqu</p>
				<p class="text-3">
					Haven is the Best  should be the consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore lore gna iqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex eacm
				</p>
			</div>
		</div>
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
									<img src="img/property/icon-6.png" alt="">
									<span>Area 450 sqft</span>
								</li>
								<li>
									<img src="img/property/icon-7.png" alt="">
									<span>Bedroom 5</span>
								</li>
								<li>
									<img src="img/property/icon-8.png" alt="">
									<span>Bedroom 5</span>
								</li>
								<li>
									<img src="img/property/icon-9.png" alt="">
									<span>Garage 2</span>
								</li>
								<li>
									<img src="img/property/icon-10.png" alt="">
									<span>Kitchaen 2</span>
								</li>
							</ul>
							<div class="property-location">
								<p><img src="img/property/icon-5.png" alt=""> 568 E 1st Ave, Miami</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="amenities">
						<div class="amenities-title">
							<h5>Amenities</h5>
						</div>
						<div class="amenities-list">
							<ul>
								<li><i class="fa fa-check-square-o"></i> <span>Air Conditioning</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Bedding</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Balcony</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Cable TV</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Internet</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Parking</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>lift</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Pool</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Dishwasher</span></li>
								<li><i class="fa fa-check-square-o"></i> <span>Toaster</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="planning">
			<div class="row">
				<div class="col-md-5 col-sm-6 col-xs-12">
					<div class="plan-title">
						<h5>Floor Plan</h5>
					</div>
					<div class="plan-map">
						<img src="img/property/plan-map.png" alt="">
					</div>
				</div>
				<div class="col-md-7  col-sm-6 col-xs-12">
					<div class="plan-title">
						<h5>Video Presentation</h5>
					</div>
					<div class="vimeo-video">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe src="https://player.vimeo.com/video/12690053"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="feedback">
			<div class="feedback-title">
				<h5>3 Feedback</h5>
			</div>
			<div class="single-feedback mb-35 fix">
				<div class="feedback-img">
					<img src="img/feedback/1.png" alt="">
				</div>
				<div class="feedback-desc">
					<div class="feedback-title">
						<h6>Albert Smith</h6>
					</div>
					<p class="feedback-post">
						6 hour ago
					</p>
					<p class="review-desc">There are some business lorem ipsum dolor sit amet, consectetur adipiscing elit, sed domod empor inc ididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudt </p>
				</div>
			</div>
			<div class="single-feedback mb-35 fix">
				<div class="feedback-img">
					<img src="img/feedback/2.png" alt="">
				</div>
				<div class="feedback-desc">
					<div class="feedback-title">
						<h6>Albert Smith</h6>
						<p class="feedback-post">
							6 hour ago
						</p>
						<p class="review-desc">There are some business lorem ipsum dolor sit amet, consectetur adipiscing elit, sed domod empor inc ididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudt </p>
					</div>
				</div>
			</div>
			<div class="single-feedback fix">
				<div class="feedback-img">
					<img src="img/feedback/3.png" alt="">
				</div>
				<div class="feedback-desc">
					<div class="feedback-title">
						<h6>Albert Smith</h6>
						<p class="feedback-post">
							6 hour ago
						</p>
						<p class="review-desc">There are some business lorem ipsum dolor sit amet, consectetur adipiscing elit, sed domod empor inc ididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudt </p>
					</div>
				</div>
			</div>
		</div>
		<div class="leave-review">
			<div class="review-title">
				<h5>Leave a Review</h5>
			</div>
			<div class="review-inner">
				<form action="#">
					<div class="form-top">
						<div class="input-filed">
							<input type="text" placeholder="Your name">
						</div>
						<div class="input-filed">
							<input type="text" placeholder="Your Email">
						</div>
					</div>
					<div class="form-bottom">
						<div class="input-field">
							<input type="text" placeholder="Subject">
						</div>
						<textarea placeholder="Write here"></textarea>
					</div>
					<div class="submit-form">
						<button type="submit">SUBMIT REVIEW</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
