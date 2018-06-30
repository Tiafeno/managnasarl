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

if ( ! class_exists( 'SearchFilterWidget' ) ):
	class SearchFilterWidget extends WP_Widget {
		public function __construct() {
			parent::__construct( 'wc_search_filter', 'WC Search Filter', [
				'description' => 'Woocommerce Search Filter Custom'
			] );
		}

		// @front-end
		public function widget( $args, $instance ) {
			global $twig, $managnaSarl;
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			$options = $managnaSarl->services->getManagnaOptions();
			wp_enqueue_script('admin-element-search-filter');
			wp_localize_script('admin-element-search-filter', 'vc_search_filter', [
				'slider' => $options->search_filters
			]);

			try {
				echo $twig->render( '@WIDGETS_FRONT/search-filter-form.html', [
					'search' => [
						'action'       => esc_url( home_url( '/' ) ),
						'search_query' => get_search_query()
					],
					'title'  => $title
				] );
			} catch ( Twig_Error_Loader $e ) {
			} catch ( Twig_Error_Runtime $e ) {
			} catch ( Twig_Error_Syntax $e ) {
				echo $e->getRawMessage();
			}

			echo $args['after_widget'];
		}

		// @back-end
		public function form( $instance ) {
			if ( isset( $instance['title'] ) ) {
				$title = $instance['title'];
			} else {
				$title = "Recherche une propriété";
			}
			?>
			<p>
			  <label for="<?= $this->get_field_id('title') ?>">Titre</label>
			  <input class="widefat" id="<?= $this->get_field_id( 'title' ) ?>" name="<?= $this->get_field_name( 'title' ) ?>" type="text" value="<?= esc_attr( $title ); ?>" />
			</p>
			<?php
		}

		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance          = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

			return $instance;
		}
	}
endif;
