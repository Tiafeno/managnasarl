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

if ( ! class_exists('WPBakeryShortCode')) die('WPBakery plugins missing!');
if ( ! class_exists( 'vcOurOffersBox' ) ) :
	class vcOurOffersBox extends WPBakeryShortCode {

		public function __construct() {
			add_action( 'init', [ $this, 'vc_mapping' ] );
			add_shortcode( 'vc_offers', array( $this, 'vc_render_html' ) );
		}

		private function get_product_params( &$posts ) {
			array_walk($posts, function (&$post) {
				$post->post_url       = get_the_permalink( $post->ID );
				$post->post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'woocommerce_thumbnail');

				$product     = wc_get_product( $post->ID );
				$post->price = $product->get_price();
				$post->sku = $product->get_sku();
			});
		}

		public function getContents() {
			$posts = new stdClass(); // Lists of object
			$args_sale = [
				'post_type' => 'product',
				'numberposts' => 6,
				'meta_query' => [
					[
						'key' => 'type', // field: basic_information, subfield: status
						'compare' => 'LIKE',
						'value' => 'sale'
					]
				]
			];
			$sales = get_posts($args_sale);
			$this->get_product_params($sales);
			msServices::acfParams( $sales );
			$posts->sales = &$sales;
			wp_reset_postdata();

			$args_rent = [
				'post_type' => 'product',
				'numberposts' => 6,
				'meta_query' => [
					[
						'key' => 'type', // field: basic_information, subfield: status
						'compare' => 'LIKE',
						'value' => 'rent'
					]
				]
			];
			$rents = get_posts($args_rent);
			$this->get_product_params($rents);
			msServices::acfParams( $rents );
			$posts->rents = &$rents;
			wp_reset_postdata();

			return $posts;
		}

		public function vc_mapping() {
			// Stop all if VC is not enabled
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				return;
			}
			// Map the block with vc_map()
			vc_map(
				array(
					'name'        => __( 'VC Offers', __SITENAME__ ),
					'base'        => 'vc_offers',
					'description' => __( 'Afficher les propriétés par categories.', __SITENAME__ ),
					'category'    => __( 'Managna Immo', __SITENAME__ ),
					'params'      => array(
						array(
							'type'        => 'textfield',
							'holder'      => 'h3',
							'class'       => 'title-class',
							'heading'     => __( 'Title', __SITENAME__ ),
							'param_name'  => 'title',
							'value'       => __( 'Default value', __SITENAME__ ),
							'description' => __( 'Box Title', __SITENAME__ ),
							'admin_label' => false,
							'weight'      => 0
						),

					)
				)
			);
		}

		public function vc_render_html( $atts ) {
			global $twig;
			// Params extraction
			extract(
				shortcode_atts(
					array(
						'title' => ''
					),
					$atts
				)
			);

			/** @var string $title */
			try {
				return $twig->render( '@VC/our-offers.html', [
					'get_template_directory_uri' => get_template_directory_uri(),
					'title'                      => $title,
					'posts'                      => $this->getContents()
				] );
			} catch ( Twig_Error_Loader $e ) {
			} catch ( Twig_Error_Runtime $e ) {
			} catch ( Twig_Error_Syntax $e ) {
				echo $e->getRawMessage();
			}
		}
	}
endif;

new vcOurOffersBox();