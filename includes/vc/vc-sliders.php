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
	Element Description: Sliders
*/

class vcSlidersBox extends WPBakeryShortCode {
	// Element Init
	public function __construct() {
		add_action( 'init', array( $this, 'vc_slider_mapping' ) );
		add_shortcode( 'vc_slider', array( $this, 'vc_slider_html' ) );
	}

	private function getContents() {
		$dropdown = [];
		$args     = [
			'post_type'      => 'slider',
			'post_status'    => 'publish',
			'posts_per_page' => - 1
		];
		$posts    = get_posts( $args );

		if ( $posts ) {
			foreach ( $posts as $post ) {
				$dropdown = array_merge( $dropdown, [ "$post->post_title" => $post->ID ] );
			}
			wp_reset_postdata();
		}

		return $dropdown;
	}

	/**
	 * @param int $post_id
	 *
	 * @return array|null
	 */
	private function getSliders( $post_id ) {
		$sliders = [];
		if ( ! is_int( $post_id ) ) {
			return null;
		}
		if ( have_rows( 'sliders', $post_id ) ) {
			while ( have_rows( 'sliders', $post_id ) ) : the_row();
				$container   = new stdClass();
				$image       = get_sub_field( 'image' );
				$information = get_sub_field( 'information' );

				$description = $information['description'];
				$link        = $information['link'];

				$container->image_url = $image;
				$container->desc      = $description;
				$container->link      = $link ? $link : '';
				$container->layout    = 'caption' . get_row_index();

				array_push( $sliders, $container );
			endwhile;
		}

		return $sliders;
	}

	public function vc_slider_mapping() {
		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map(
			array(
				'name'        => __( 'VC Slider', __SITENAME__ ),
				'base'        => 'vc_slider',
				'description' => __( 'Ajouter une slider.', __SITENAME__ ),
				'category'    => __( 'Managna Immo', __SITENAME__ ),
				'params'      => array(
					array(
						'type'        => 'textfield',
						'holder'      => 'h3',
						'class'       => '',
						'heading'     => __( 'Title', 'text-domain' ),
						'param_name'  => 'title',
						'value'       => __( 'Default value', 'text-domain' ),
						'description' => __( 'Box Title', 'text-domain' ),
						'admin_label' => false,
						'weight'      => 0
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Slider', __SITENAME__ ),
						'param_name'  => 'slider',
						'value'       => $this->getContents(),
						"description" => __( "Slider post type.", __SITENAME__ )
					)

				)
			)
		);
	}

	public function vc_slider_html( $atts ) {
		global $twig, $managnaSarl;

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'title'  => '',
					'slider' => []
				),
				$atts
			)
		);
		wp_enqueue_script( 'admin-slider', get_template_directory_uri() . '/assets/js/admin/admin-slider.js', array(
			'jquery',
			'owl-carousel'
		), $managnaSarl->version, true );
		/** @var int $slider */
		$contents = $this->getSliders( (int) $slider );
		try {
			/** @var string $title */
			return $twig->render( '@VC/slider.html', [
				'sliders' => $contents,
				'title'   => $title
			] );
		} catch ( Twig_Error_Loader $e ) {
		} catch ( Twig_Error_Runtime $e ) {
		} catch ( Twig_Error_Syntax $e ) {
			echo $e->getRawMessage();
		}
	}
}

new vcSlidersBox();