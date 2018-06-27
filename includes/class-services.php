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

if ( ! class_exists( 'msServices' ) ) :
	final Class msServices {
		private $EUR2MGA = 0;
		private $fixerIOData = null;

		public function __construct() {
			$this->EUR2MGA = get_option( 'EUR2MGA', false );
			if ( ! $this->EUR2MGA ) {
				$this->getCurrency();
			}
			if ( $this->EUR2MGA instanceof stdClass ) {
				$optionDate = strtotime( $this->EUR2MGA->date );
				$today      = strtotime( date( 'Y-m-d' ) );
				if ( $optionDate != $today ) {
					$this->getCurrency();
				}
			}
		}

		/**
		 * Ajouter les
		 * @param $product
		 */
		public static function setACFFields( &$product ) {
			$id = $product instanceof WC_Product_Simple ? $product->get_id() : $product->ID;
			$property = get_field('property', $id );
			$product->property = $property;
			// Get condition ACF fields
			$conditions      = get_field( 'condition', $id );
			$product->surface  = $conditions['surface'] ? $conditions['surface'] : 0;
			$product->bedroom  = $conditions['bedroom'] ? $conditions['bedroom'] : 0;
			$product->bathroom = $conditions['bathroom'] ? $conditions['bathroom'] : 0;
			$product->garage   = $conditions['garage'] ? $conditions['garage'] : 0;

			// Get basic informations ACF fields
			$basic_information = get_field( 'basic_information', $id  );
			$product->location   = $basic_information['location'];
			$product->status     = $basic_information['status'];

			// Get Amenities field
			$product->amenities = get_field( 'amenities', $id  );
		}

		/**
		 * @param array $posts Liste d'objet WP_Post
		 *
		 * @return array
		 */
		public static function acfParams( $products ) {
			array_walk( $products, function ( &$product ) {
				self::setACFFields( $product );
			} );

			return $products;
		}

		public static function sendMessage( $form ) {
			if ( ! is_array( $form ) ) {
				return;
			}
			add_filter( 'send_contact_property', function ( $contact_alert ) use ( $form ) {
				global $twig;
				if ( empty( $form['post_id'] ) ) {
					return null;
				}
				$post_id = &$form['post_id'];
				$product = wc_get_product( $post_id );
				$product_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'woocommerce_thumbnail');

				$content = $twig->render( '@MAIL/index.html', [
					'firstname' => $form['firstname'],
					'content'   => esc_html($form['message']),
					'template_directory_uri' => get_template_directory_uri(),
					'home_url' => home_url('/'),

					'product_title'       => $product->get_title(),
					'product_description' => $product->get_description(),
					'product_price'       => $product->get_price(),
					'product_thumbnail_url' => $product_thumbnail[0],
					'product_url'         => get_the_permalink( $product->get_id() )

				] );

				$users = get_users();
				/* Prepare to send mail */
				$subject   = "Contact - " . $product->get_title();

				/* TODO: Justifier le mail exacte pour envoyer la demande */
				$to        = 'contact@falicrea.com';
				$body      = &$content;
				$headers[] = 'Content-Type: text/html; charset=UTF-8';
				$headers[] = 'From: ' . esc_html( $form['firstname'] ) . ' <' . $form['email'] . '>';
				foreach ($users as $user)
					$headers[] = 'Cc: ' . $user->user_email;

				if ( wp_mail( $to, $subject, $body, $headers ) ) :
					$contact_alert .= 'Votre message a étés bien envoyer';

				// TODO: Ajouter son adresse email dans les registres des abonnée s'il a crocher sur "abonné"

				else:
					$contact_alert .= 'Une erreur est survenue lors de l\'envoi';
				endif;

				return $contact_alert;
			}, 10, 1 );
		}

		/**
		 * Récuperer l'echange en cours pour EUR en MGA
		 */
		public function getCurrency() {
			$fields_string = '';
			$fields        = (object) [
				'access_key' => __fixer_io_api__,
				'base'       => 'EUR',
				'symbols'    => 'MGA',
			];
			foreach ( $fields as $key => $value ) {
				$fields_string .= $key . '=' . $value . '&';
			}
			rtrim( $fields_string, '&' );
			// Open connection
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, "http://data.fixer.io/api/latest?access_key={$fields->access_key}&base={$fields->base}&symbols={$fields->symbols}" );
			curl_setopt_array( $ch, [
				CURLOPT_RETURNTRANSFER => 1
			] );
			// Execute!
			$response = curl_exec( $ch );
			// Close the connection, release resources used
			curl_close( $ch );
			$this->fixerIOData = json_decode( $response );
			$rates             = $this->fixerIOData->rates;

			add_filter( 'add_message_alert', function ( $messageAlert ) use ( $rates ) {
				if ( is_null( $messageAlert ) ) {
					$messageAlert = "Initialisation de la cours d'echange pour un Euro: " . $rates->MGA . "Ar";
				}

				return $messageAlert;
			}, 10, 1 );

			return $this->updateCurrencyMGA();
		}

		/**
		 * Mettre à jours la valeur de l'echange
		 */
		public function updateCurrencyMGA() {
			update_option( 'EUR2MGA', $this->fixerIOData );

			return $this->fixerIOData;
		}

		/**
		 * @return mixed
		 */
		public function getCurrencyMGA() {
			if ( ! $this->EUR2MGA instanceof stdClass ) {
				return $this->getCurrency();
			}

			return $this->EUR2MGA;
		}
	}
endif;

return new msServices();