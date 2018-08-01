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

if ( ! class_exists( 'vcNewsletterBox' ) ):
	class vcNewsletterBox extends WPBakeryShortCode {
		public function __construct() {
			add_action( 'init', [ $this, 'vc_newsletter_mapping' ] );
			add_shortcode( 'vc_newsletter', [ $this, 'vc_newsletter_html' ] );

			add_action( 'wp_ajax_ajax_action_added_newsletter', [ $this, 'ajax_action_added_newsletter' ] );
			add_action( 'wp_ajax_nopriv_ajax_action_added_newsletter', [ $this, 'ajax_action_added_newsletter' ] );
		}

		/**
		 * @return array
		 */
		public static function create_newsletter() {
			return update_option( "managna_newsletter", [] );
		}

		/**
		 * Récupere la liste des abonnées
		 * @return array|false
		 */
		public static function get_subscribers_email() {
			$emails      = [];
			$newsletters = get_option( 'managna_newsletter', [] );
			if ( empty( $newsletter ) ) {
				return false;
			}
			foreach ( $newsletters as $newsletter ) {
				if ($newsletter instanceof stdClass)
					array_push( $emails, $newsletter->mail );
			}
			return $emails;
		}

		/**
		 * Vérifier si l'adresse email existe déja dans la base de donnée
		 *
		 * @param $mail
		 * @return bool
		 */
		public static function isRegister( $mail ) {
			$newsletters = get_option( "managna_newsletter", [] );
			if ( empty( $newsletters ) ) {
				return false;
			}
			// return array_search( $mail, array_column($newsletters, 'mail'), true ); // PHP 7
			$filter = array_filter( $newsletters, function ( $value, $key ) use ( $mail ) {
				return $value->mail === $mail;
			}, ARRAY_FILTER_USE_BOTH );

			return ! empty( $filter );
		}

		/**
		 * Effacer une resultat ou adresse email d'un abonnée
		 *
		 * @param $mail
		 * @return bool
		 */
		public static function remove_newsletter( $mail ) {
			$newsletters = get_option( "managna_newsletter", [] );
			if ( empty( $newsletters ) ) {
				return false;
			}

			$new_newsletters = array_filter( $newsletters, function ( $value, $key ) use ( $mail ) {
				return $value->mail != $mail;
			}, ARRAY_FILTER_USE_BOTH );

			update_option('managna_newsletter', $new_newsletters);
		}

		/**
		 * Ajouter un abonnée dans la base de donnée
		 *
		 * @param $mail
		 * @return bool
		 */
		public static function added_newsletter( $mail ) {
			if ( empty( $mail ) ) {
				return false;
			}
			$subscriber       = new stdClass();
			$subscriber->mail = $mail;
			$newsletters      = get_option( "managna_newsletter", [] );
			array_push( $newsletters, $subscriber );

			update_option( 'managna_newsletter', $newsletters );

			return true;
		}

		/**
		 * Cette fonction est de type AJAX.
		 * Il consiste à actionner le mechanisme de l'enregistrement d'un abonnée dans la base de donnée.
		 */
		public function ajax_action_added_newsletter() {
			/**
			 * @func wp_doing_ajax
			 * (bool) True if it's a WordPress Ajax request, false otherwise.
			 */
			if ( ! wp_doing_ajax() ) {
				return;
			}

			if ( ! get_option( 'managna_newsletter', false ) ) {
				self::create_newsletter();
			}
			$mail = ManagnaSarl::getValue( 'mail' );

			// @link http://php.net/manual/fr/filter.examples.validation.php
			if ( ! filter_var( $mail, FILTER_VALIDATE_EMAIL ) ) {
				wp_send_json( [
					'success' => false,
					'msg'     => 'Error! Please verify your email address'
				] );
			}

			if ( ! self::isRegister( $mail ) ) {
				if ( ! self::added_newsletter( $mail ) ) {
					wp_send_json( [
						'success' => false,
						'msg'     => 'Error! Please verify your email address'
					] );
				} else {
					wp_send_json( [
						'success' => true,
						'msg'     => 'Your email address has been successfully added with success'
					] );
				}
			} else {
				wp_send_json( [
					'success' => true,
					'msg'     => 'The email address already exists'
				] );
			}

		}

		public function vc_newsletter_mapping() {
			// Stop all if VC is not enabled
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				return;
			}

			// Map the block with vc_map()
			vc_map(
				array(
					'name'        => __( 'VC Newsletter', __SITENAME__ ),
					'base'        => 'vc_newsletter',
					'description' => __( 'The software works the way you do so you can focus on creating newsletters and giving your website the necessary exposure!', __SITENAME__ ),
					'category'    => __( 'Managna Immo', __SITENAME__ ),
					'params'      => array(
						array(
							'type'        => 'textfield',
							'holder'      => 'h3',
							'class'       => 'title-class',
							'heading'     => __( 'Title', __SITENAME__ ),
							'param_name'  => 'title',
							'value'       => '',
							'description' => __( 'Ajouter une titre', __SITENAME__ ),
							'admin_label' => false,
							'weight'      => 0
						),

					)
				)
			);
		}

		public function vc_newsletter_html( $atts ) {
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

			wp_enqueue_style( 'semantic-button' );
			wp_enqueue_style( 'semantic-message' );
			wp_enqueue_style( 'semantic-input' );
			wp_enqueue_style( 'semantic-icon' );
			wp_enqueue_style( 'semantic-form' );

			wp_enqueue_script( 'bluebird' );
			wp_enqueue_script( 'semantic-form' );
			// wp_enqueue_script('semantic');
			// print_r(get_option('managna_newsletter'));
			/** @var string $title */
			try {
				return $twig->render( '@VC/newsletter.html', [
					'template_directory_uri' => get_template_directory_uri(),
					'title'                  => $title
				] );
			} catch ( Twig_Error_Loader $e ) {
			} catch ( Twig_Error_Runtime $e ) {
			} catch ( Twig_Error_Syntax $e ) {
				echo $e->getRawMessage();
			}
		}
	}
endif;

new vcNewsletterBox();