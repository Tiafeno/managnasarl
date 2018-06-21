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

if ( ! class_exists( 'ShortcodeProDetailsImage' ) ) :
	class ShortcodeProDetailsImage {
		public function __construct() {
			add_shortcode( 'property-carousel-image', [ $this, 'render_html' ] );
		}

		private function getContent( $attachment_id ) {
			global $product;
			$attachment = new stdClass();
			$attachment->id = $attachment_id;
			// @links https://docs.woocommerce.com/document/image-sizes-theme-developers/
			$attachment->item_url = wp_get_attachment_image_src( (int)$attachment_id, 'woocommerce_thumbnail');
			$attachment->image_url = wp_get_attachment_image_src( (int)$attachment_id, 'large');
			$attachment->title = $product->get_title();
			return $attachment;
		}

		public function render_html( $atts ) {
			global $product, $twig;
			extract(
				shortcode_atts(
					array(
						'title' => ''
					),
					$atts
				)
			);
			/* @var string $title */
			$gallery_ids = $product->get_gallery_image_ids();
			$galleries = array();
			$main_thumbnail = wp_get_attachment_image_src( $product->get_image_id(), 'large' );
			if ( empty($gallery_ids)) return '<img src="'.$main_thumbnail[0] .'" alt="">';

			foreach ($gallery_ids as $gallery_id) {
				$galleries[] = $this->getContent($gallery_id);
			}

			wp_enqueue_style('slick');
			wp_enqueue_style('lightbox');
			wp_enqueue_style('slick-theme');
			wp_enqueue_script('slick-script');
			wp_enqueue_script('lightbox-script');

			try {
				return $twig->render( '@Shortcodes/property-details-gallery.html', [
					'galleries' => $galleries,
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

new ShortcodeProDetailsImage();