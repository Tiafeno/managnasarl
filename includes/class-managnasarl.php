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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ManagnaSarl' ) ) :
	class ManagnaSarl {

		public function __construct() {

			add_action( 'wp_loaded', function() {

				// Rennomer les étiquettes d'Woocommerce (product) en "Annonce"
				$p_object = get_post_type_object( 'product' );
				if ( ! $p_object )
					return false;
				// see get_post_type_labels()
				$p_object->labels->name               = 'Annonces';
				$p_object->labels->singular_name      = 'Annonce';
				$p_object->labels->add_new            = 'Ajouter une annonce';
				$p_object->labels->add_new_item       = 'Ajouter une nouvelle annonce';
				$p_object->labels->all_items          = 'Tous les annonces';
				$p_object->labels->edit_item          = 'Modifier l\'annonce';
				$p_object->labels->name_admin_bar     = 'Annonce';
				$p_object->labels->menu_name          = 'Annonces';
				$p_object->labels->new_item           = 'Nouvelle annonce';
				$p_object->labels->not_found          = 'Aucune annonce trouvée';
				$p_object->labels->not_found_in_trash = 'Aucune annonce trouvée dans la corbeille';
				$p_object->labels->search_items       = 'Trouver une annonce';
				$p_object->labels->view_item          = 'Afficher l\'annonce';

				return true;
			}, 20);

			// Save scripts and styles
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

			// Wordpress initialization
			add_action( 'init', array( $this, 'init' ) );

			// Save widgets
			add_action( 'widgets_init', function () {
				$this->widgets_init();

				// @folder includes/widgets
				register_widget( 'SearchFilterWidget' );
				register_widget( 'ContactPropertyFormWidget' );
			} );

			// Add class name in body
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Change shop post product view per page
			add_filter( 'loop_shop_per_page', 'override_loop_shop_per_page', 20 );
			function override_loop_shop_per_page( $cols ) {
				$cols = 6;
				return $cols;
			}

			// Add acf google map api
			add_filter( 'acf/init', function () {
				acf_update_setting( 'google_api_key', __google_api__ );
			} );

			// Sets the text domain used when translating field and field group settings.
			// Defaults to ”. Strings will not be translated if this setting is empty
			add_filter('acf/settings/l10n_textdomain', function () {
				return __SITENAME__;
			});
		}

		public static function getValue( $name, $def = false ) {
			if ( ! isset( $name ) || empty( $name ) || ! is_string( $name ) ) {
				return $def;
			}
			$returnValue = isset( $_POST[ $name ] ) ? trim( $_POST[ $name ] ) : ( isset( $_GET[ $name ] ) ? trim( $_GET[ $name ] ) : $def );
			$returnValue = urldecode( preg_replace( '/((\%5C0+)|(\%00+))/i', '', urlencode( $returnValue ) ) );

			return ! is_string( $returnValue ) ? $returnValue : stripslashes( $returnValue );
		}

		public function search_filter_query() {
			add_action( 'woocommerce_product_query', function ( $q ) {
				$meta_query = $q->get( 'meta_query' );

				// The default relation for a meta query is AND

				/**
				 * Woocommerce post meta
				 */
				if ( self::getValue( 'price' ) ) {
					$price = self::getValue( 'price' );

					$prices    = explode( '-', $price );
					$min_price = (int) trim( $prices[0] );
					$max_price = (int) trim( $prices[1] );

					$meta_query[] = array(
						'key'     => '_regular_price',
						'value'   => array(
							$min_price,
							$max_price
						),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC'
					);
				}

				/**
				 * ACF post meta
				 * @group basic_information
				 * @field {text} status
				 */
				if ( self::getValue( 'status' ) ) {
					$status       = self::getValue( 'status' );
					$meta_query[] = array(
						'key'     => 'basic_information_status',
						'value'   => $status,
						'compare' => '='
					);
				}

				/**
				 * ACF post meta
				 * @group condition
				 * @field {number} bedroom
				 */
				if ( self::getValue( 'area' ) ) {
					$area         = self::getValue( 'area' );
					$meta_query[] = array(
						'key'     => 'condition_bedroom',
						'value'   => $area,
						'compare' => '='
					);
				}

				/**
				 * ACF post meta
				 * @field {text} property
				 */
				if ( self::getValue( 'property' ) ) {
					$property     = self::getValue( 'property' );
					$meta_query[] = array(
						'key'     => 'property',
						'value'   => $property,
						'compare' => '='
					);
				}

				// Set for global query
				$q->set( 'meta_query', $meta_query );
			} );
		}

		/**
		 * Wordpress initialization function
		 */
		public function init() {
			register_post_type( 'slider', array(
				'label'           => _x( "Slider", 'General name for Slider post type' ),
				'labels'          => array(
					'name'               => _x( "Sliders", "Plural name for slider post type" ),
					'singular_name'      => _x( "Slider", "Singular name for slider post type" ),
					'add_new'            => __( 'Add' ),
					'add_new_item'       => __( "Add New slider" ),
					'edit_item'          => __( 'Edit' ),
					'view_item'          => __( 'View' ),
					'search_items'       => __( "Search sliders" ),
					'not_found'          => __( "No slider found" ),
					'not_found_in_trash' => __( "No slider found in trash" )
				),
				'public'          => true,
				'hierarchical'    => false,
				'menu_position'   => null,
				'show_ui'         => true,
				'rewrite'         => array( 'slug' => 'slider' ),
				'capability_type' => 'post',
				'menu_icon'       => 'dashicons-images-alt2',
				'supports'        => [ 'title', 'custom-fields' ]
			) );
		}

		public function widgets_init() {
			// Element avec le fond orange
			register_sidebar( array(
				'name'          => 'Middle Bottom',
				'id'            => 'middle-bottom',
				'description'   => 'Add widgets here to appear in content bottom.',
				'before_widget' => '<div id="%1$s" class="%2$s uk-text-meta menu-area">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="">',
				'after_title'   => '</div>'
			) );

			register_sidebar( array(
				'name'          => 'Single Property Sidebar',
				'id'            => 'sidebar-shop',
				'description'   => 'Add widgets here to appear in property single page right position.',
				'before_widget' => '<aside id="%1$s" class="%2$s single-side-box">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="aside-title"><h5>',
				'after_title'   => '</h5></div>'
			) );

			register_sidebar( array(
				'name'          => 'Offering Sidebar',
				'id'            => 'sidebar-offering',
				'description'   => 'Add widgets here to appear in offer right position.',
				'before_widget' => '<aside id="%1$s" class="%2$s single-side-box">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="aside-title"><h5>',
				'after_title'   => '</h5></div>'
			) );

			register_sidebar([
				'name' => 'Footer left',
				'id'   => 'footer-left',
			]);

			register_sidebar([
				'name' => 'Footer Middle',
				'id'   => 'footer-middle',
			]);

			register_sidebar([
				'name' => 'Footer Right',
				'id'   => 'footer-right',
			]);
		}

		private function register_scripts( $version ) {
			wp_register_script( 'bluebird', get_template_directory_uri() . '/assets/js/bluebird.min.js', [], $version, true );
			wp_register_script( 'semantic', get_template_directory_uri() . '/assets/js/semantic/semantic.min.js', [ 'jquery' ], $version, true );
			wp_register_script( 'semantic-checkbox', get_template_directory_uri() . '/assets/js/semantic/checkbox.min.js', [ 'jquery' ], $version, true );
			wp_register_script( 'semantic-form', get_template_directory_uri() . '/assets/js/semantic/form.min.js', [ 'jquery' ], $version, true );
			wp_register_script( 'admin-element-search-filter', get_template_directory_uri() . '/assets/js/admin/admin-search-filter.js', [
				'jquery',
				'managnasarl-plugins'
			], $version, true );
			wp_register_script('slick-script', get_template_directory_uri() . '/assets/js/jquery/slick.min.js', ['jquery'], $version, true);
			wp_register_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', '', $version );
			wp_register_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', '', $version );

			wp_register_style( 'lightbox', get_template_directory_uri() . '/assets/css/lightbox.min.css', '', $version );
			wp_register_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.min.js', ['jquery'], $version, true);

			wp_register_style( 'semantic', get_template_directory_uri() . '/assets/css/semantic/semantic.min.css', '', $version );
			wp_register_style( 'semantic-form', get_template_directory_uri() . '/assets/css/semantic/form.min.css', '', $version );
			wp_register_style( 'semantic-button', get_template_directory_uri() . '/assets/css/semantic/button.min.css', '', $version );
			wp_register_style( 'semantic-icon', get_template_directory_uri() . '/assets/css/semantic/icon.css', '', $version );
			wp_register_style( 'semantic-message', get_template_directory_uri() . '/assets/css/semantic/message.min.css', '', $version );
			wp_register_style( 'semantic-checkbox', get_template_directory_uri() . '/assets/css/semantic/checkbox.min.css', '', $version );
			wp_register_style( 'semantic-input', get_template_directory_uri() . '/assets/css/semantic/input.min.css', '', $version );

			wp_register_style( 'Lato', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&subset=latin' );
			wp_register_script('tinyMCE', '//cloud.tinymce.com/stable/tinymce.min.js?apiKey=2grxn9iofnxolcaedqa399sh4ft6c1mg3e1kumgnyq6o0ap1');

		}

		public function scripts() {
			global $managnaSarl;

			/**
			 * Styles
			 */
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', '', $managnaSarl->version );
			wp_enqueue_style( 'core', get_template_directory_uri() . '/assets/css/core.css', '', $managnaSarl->version );
			wp_enqueue_style( 'shortcode', get_template_directory_uri() . '/assets/css/shortcode/shortcodes.css', '', $managnaSarl->version );
			wp_enqueue_style( 'managnasarl-style', get_stylesheet_uri(), array(), $managnaSarl->version );
			wp_enqueue_style( 'managnasarl-override-style', get_template_directory_uri() . '/assets/css/managna-sarl.override.css', '', $managnaSarl->version );
			wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css', '', $managnaSarl->version );
			/** customizer style css */
			wp_enqueue_style( 'customizer', get_template_directory_uri() . '/assets/css/style-customizer.css', '', $managnaSarl->version );
			wp_enqueue_style( 'PT-sans', "//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" );

			/**
			 * Scripts
			 */
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_script( 'underscore' );
			wp_enqueue_script( 'jquery' );

			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'jquery-nivo', get_template_directory_uri() . '/assets/js/jquery/jquery.nivo.slider.pack.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery/jquery.counterup.min.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'jquery-magnific', get_template_directory_uri() . '/assets/js/jquery/jquery.magnific-popup.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'managnasarl-customizer', get_template_directory_uri() . '/assets/js/style-customizer.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'managnasarl-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array( 'jquery' ), $managnaSarl->version, true );
			wp_enqueue_script( 'managnasarl-main', get_template_directory_uri() . '/assets/js/main.js', array(
				'jquery',
				'jquery-nivo',
				'owl-carousel'
			), $managnaSarl, true );
			wp_enqueue_script( 'moment', get_template_directory_uri() . '/assets/js/moment.min.js', array(), $managnaSarl->version, true );
			wp_enqueue_script( 'principal', get_template_directory_uri() . '/assets/js/managna-immo.js', array(
				'jquery',
				'moment'
			), $managnaSarl->version, true );
			wp_localize_script( 'principal', 'jManagna',
				[
					'currency'    => $managnaSarl->services->getCurrencyMGA(),
					'templateUrl' => get_template_directory_uri(),
					'ajax_url'    => admin_url( 'admin-ajax.php' )
				] );

			$this->register_scripts( $managnaSarl->version );
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			$classes[] = 'wide-layout';

			return $classes;
		}
	}
endif;

return new ManagnaSarl();