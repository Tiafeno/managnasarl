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
if ( ! class_exists( 'vcSearchFilterBox' ) ) :
	class vcSearchFilterBox extends WPBakeryShortCode {
		public function __construct() {
			add_action('init', [$this, 'vc_search_mapping']);
			add_shortcode('vc_search_filter', [$this, 'vc_search_html']);
		}

		public function vc_search_mapping() {
			// Stop all if VC is not enabled
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				return;
			}
			// Map the block with vc_map()
			vc_map(
				array(
					'name'        => __( 'VC Search Filter', __SITENAME__ ),
					'base'        => 'vc_search_filter',
					'description' => __( 'Search filter for property', __SITENAME__ ),
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

		public function vc_search_html( $attrs ) {
			global $twig, $managnaSarl;
			// Params extraction
			extract(
				shortcode_atts(
					array(
						'title' => ''
					),
					$attrs
				)
			);

			$options = $managnaSarl->services->getManagnaOptions();
			wp_enqueue_script('admin-element-search-filter');
			if ($options instanceof stdClass)
				wp_localize_script('admin-element-search-filter', 'vc_search_filter', [
					'slider' => $options->search_filters
				]);


			/** @var string $title */
			try {
				return $twig->render( '@VC/search-filter.html', [
					'search' => [
						'action' => esc_url( home_url( '/' ) ),
						'search_query' => get_search_query()
					],
					'title'                      => $title
				] );
			} catch ( Twig_Error_Loader $e ) {
			} catch ( Twig_Error_Runtime $e ) {
			} catch ( Twig_Error_Syntax $e ) {
				echo $e->getRawMessage();
			}
		}
	}
endif;

new vcSearchFilterBox();