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

/*
Element Description: Property Recently Added
*/

// Element Class
class vcPropertyRecentlyBox extends WPBakeryShortCode {

	// Element Init
	public function __construct() {
		add_action( 'init', array( $this, 'vc_propertyrecently_mapping' ) );
		add_shortcode( 'vc_property_recently', array( $this, 'vc_propertyrecent_html' ) );
	}

	/**
	 * @return array - List of posts
	 */
	private function getContents() {
		// TODO: Ne pas afficher l'annonce que le visiteur vois à l'instant
		$args  = [
			'post_type'   => 'product',
			'post_status' => 'publish',
			'numberposts' => 10
		];
		$posts = get_posts( $args );
		array_walk( $posts, function ( &$value, $key ) {
			$value->post_url = get_the_permalink( $value->ID );

			// @links https://docs.woocommerce.com/document/image-sizes-theme-developers/
			$value->post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), 'woocommerce_thumbnail' );

			$product      = wc_get_product( $value->ID );
			$value->price = $product->get_price();
			$value->sku = $product->get_sku();
		} );

		return msServices::acfParams( $posts );
	}

	// Element Mapping
	public function vc_propertyrecently_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
		// Map the block with vc_map()
		vc_map(
			array(
				'name'        => __( 'VC Recently Added', __SITENAME__ ),
				'base'        => 'vc_property_recently',
				'description' => __( 'Affiche les nouvelles propriétés récemment ajouter.', __SITENAME__ ),
				'category'    => __( 'Managna Immo', __SITENAME__ ),
				/*'front_enqueue_js' => array(
						get_template_directory_uri().'/assets/js/main-admin.js'
				),
				*/
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

	// Element HTML
	public function vc_propertyrecent_html( $atts ) {
		global $twig, $managnaSarl;

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'title' => ''
				),
				$atts
			)
		);
		wp_enqueue_script( 'admin-element-owlCarousel', get_template_directory_uri() . '/assets/js/admin/admin-element-owlCarousel.js', array(
			'jquery',
			'owl-carousel'
		), $managnaSarl->version, true );
		$contents = $this->getContents();

		/** @var string $title */
		try {
			return $twig->render( '@VC/property-recently.html', [
				'posts'                      => $contents,
				'get_template_directory_uri' => get_template_directory_uri(),
				'title'                      => $title
			] );
		} catch ( Twig_Error_Loader $e ) {
		} catch ( Twig_Error_Runtime $e ) {
		} catch ( Twig_Error_Syntax $e ) {
			echo $e->getRawMessage();
		}

	}

} // End Element Class

// Element Class Init
new vcPropertyRecentlyBox();