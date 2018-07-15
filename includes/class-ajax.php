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


class Ajax
{
	public function __construct()
	{
		add_action('wp_ajax_ajax_taxonomy_content', array($this, 'ajax_taxonomy_content'));
		add_action('wp_ajax_nopriv_ajax_taxonomy_content', array($this, 'ajax_taxonomy_content'));

		add_action('wp_ajax_ajax_upload_media', array($this, 'ajax_upload_media'));
		add_action('wp_ajax_nopriv_ajax_upload_media', array($this, 'ajax_upload_media'));

		add_action('wp_ajax_ajax_upload_medias', array($this, 'ajax_upload_medias'));
		add_action('wp_ajax_nopriv_ajax_upload_medias', array($this, 'ajax_upload_medias'));

		add_action('wp_ajax_ajax_insert_annonce', array($this, 'ajax_insert_annonce'));
		add_action('wp_ajax_nopriv_ajax_insert_annonce', array($this, 'ajax_insert_annonce'));

		add_action('wp_ajax_ajax_update_annonce', array($this, 'ajax_update_annonce'));
		add_action('wp_ajax_nopriv_ajax_update_annonce', array($this, 'ajax_update_annonce'));
	}

	/**
	 * Cette fonction permet de recuperer n'importe qu'elle contenue d'un taxonomy
	 * @return wp_send_json
	 */
	public function ajax_taxonomy_content()
	{
		$taxonomy = ManagnaSarl::getValue('taxonomy');
		$terms = get_terms([
			'taxonomy' => $taxonomy,
			'posts_per_page' => -1,
			'hide_empty' => false
		]);
		wp_send_json($terms);
	}

	/**
	 * Cette fonction permet de crée une annonce pour status "en attent"
	 * et retourne la valeur de l'identification de celui-ci si l'insertion à reussi
	 * @return wp_send_json
	 */
	public function ajax_insert_annonce()
	{
		global $managnaSarl;
		$title = ManagnaSarl::getValue('title');
		$content = ManagnaSarl::getValue('content');
		$property = ManagnaSarl::getValue('property');
		$type = ManagnaSarl::getValue('type');
		$deed = ManagnaSarl::getValue('deed', null);
		$limited = ManagnaSarl::getValue('limited', null);
		$default_rate = ManagnaSarl::getValue('default_rate', false);
		$price_monthly = ManagnaSarl::getValue('price');
		$price_seasonal = ManagnaSarl::getValue('price_seasonal', 0);

		$postargs = [
			'post_title' => esc_html($title),
			'post_content' => $content,
			'post_status' => 'pending', /* https://codex.wordpress.org/Post_Status */
			'post_parent' => '',
			'post_type' => "product",
		];
		$post_id = wp_insert_post($postargs);
		if (!is_numeric($post_id))
			wp_send_json([
				'success' => false,
				'msg' => $post_id->get_error_messages()
			]);
		wp_set_object_terms($post_id, 'simple', 'product_type');

		// Update acf fields
		update_field('prop', $property, $post_id);
		update_field('type', $type, $post_id);
		if ($property === 'ground') {
			update_field('deed', $deed, $post_id);
			update_field('limited', $limited, $post_id);
		}

		// Inserer une categorie a cette annonce
		$product_cat = ManagnaSarl::getValue('product_cat', !1);
		if ($product_cat)
			$managnaSarl->services->set_post_term_cat(json_decode($product_cat), $post_id);

		/**
		 * [V] - Vente
		 * [L] - Louer
		 *
		 * [V]A - [Vente] d'appartement
		 * [V]M - [Vente] de maison
		 * [V]T - [Vente] de terrain
		 *
		 * @ground
		 * + BO - borné
		 * + TTR - Titré
		 */
		$sku = $managnaSarl->services->generateSku($post_id);

		/**
		 * **************************************
		 *  Update post product meta
		 * *************************************
		 */
		update_post_meta($post_id, '_visibility', 'visible');
		update_post_meta($post_id, '_stock_status', 'instock');
		update_post_meta($post_id, 'total_sales', '0');
		update_post_meta($post_id, '_downloadable', 'no');
		update_post_meta($post_id, '_virtual', 'yes');
		update_post_meta($post_id, '_sale_price', '');
		update_post_meta($post_id, '_purchase_note', '');
		update_post_meta($post_id, '_featured', 'no');
		update_post_meta($post_id, '_weight', '');
		update_post_meta($post_id, '_length', '');
		update_post_meta($post_id, '_width', '');
		update_post_meta($post_id, '_height', '');

		/** Reference */
		update_post_meta($post_id, '_sku', $sku);

		update_post_meta($post_id, '_sale_price_dates_from', '');
		update_post_meta($post_id, '_sale_price_dates_to', '');

		$price = $default_rate ? (($default_rate === 'monthly') ? $price_monthly : $price_seasonal) : $price_monthly;
		update_post_meta($post_id, '_regular_price', (int)$price);
		update_post_meta($post_id, '_price', (int)$price);

		update_post_meta($post_id, '_sold_individually', '');
		update_post_meta($post_id, '_manage_stock', 'no');
		update_post_meta($post_id, '_backorders', 'no');
		update_post_meta($post_id, '_stock', '');

		/**
		 * Update acf field <<price_seasonal>>
		 */
		if (function_exists('update_field')) {
			update_field('tarif_price_seasonal', $price_seasonal, $post_id);
			update_field('tarif_paid', $default_rate, $post_id);
		}

		wp_send_json(['success' => true, 'post_id' => $post_id]);
	}

	/**
	 * Cette fonction permet de mettre à jours l'annonce
	 * @return wp_send_json
	 */
	public function ajax_update_annonce()
	{
		$post_id = ManagnaSarl::getValue('post_id', null);
		if (is_null($post_id)) wp_send_json(false);
		$property = ManagnaSarl::getValue('property', false);
		if (!$property) wp_send_json(false);

		/** Update ACF fields */
		$user = json_decode(ManagnaSarl::getValue('user', '[]'));
		if (function_exists('update_field')) {
			$fields = [
				//['field' => 'prop', 'value' => ManagnaSarl::getValue('property'), 'for' => "all"],
				['field' => 'owner_name', 'value' => ManagnaSarl::getValue('owner'), 'for' => 'all'],
				['field' => 'address', 'value' => ManagnaSarl::getValue('address'), 'for' => 'all'],
				['field' => 'city', 'value' => ManagnaSarl::getValue('city'), 'for' => 'all'],
				['field' => 'area_surface', 'value' => ManagnaSarl::getValue('surface', 0), 'for' => 'all'], // group field
				['field' => 'area_unit', 'value' => ManagnaSarl::getValue('unit'), 'for' => 'all'], // group field
				['field' => 'details_bedroom', 'value' => ManagnaSarl::getValue('bedroom', null), 'for' => 'house'], // group field
				['field' => 'details_kitchen', 'value' => ManagnaSarl::getValue('kitchen', null), 'for' => 'house'], // group field
				['field' => 'details_bathroom', 'value' => ManagnaSarl::getValue('bathroom', null), 'for' => 'house'], // group field
				['field' => 'details_garage', 'value' => ManagnaSarl::getValue('garage', null), 'for' => 'house'], // group field

				['field' => 'advertiser_name', 'value' => $user->name, 'for' => 'all'], // group field
				['field' => 'advertiser_email', 'value' => $user->email, 'for' => 'all'], // group field
				['field' => 'advertiser_phone', 'value' => $user->phone, 'for' => 'all'], // group field
			];
			foreach ($fields as $field) {
				update_field($field['field'], $field['value'], $post_id);
			}
		}

		$zipcode = json_decode(ManagnaSarl::getValue('zipcode')); // stringify
		$params = [
			['taxonomy' => 'region', 'value' => ManagnaSarl::getValue('region')],
			['taxonomy' => 'zipcode', 'value' => $zipcode->slug]
		];
		foreach ($params as $param) {
			$term = get_term_by('slug', $param['value'], $param['taxonomy'], OBJECT);
			if (!$term) continue;
			wp_set_post_terms($post_id, $term->term_id, $param['taxonomy']);
		}

		/** Ajouter les équipements */
		$tax = "amenities";
		$ids = [];
		$amenities = ManagnaSarl::getValue('amenities', null);
		if (!is_null($amenities)) {
			$amenities = json_decode($amenities);
			foreach ($amenities as $amenitie) {
				$term = get_term_by('slug', trim($amenitie), $tax, OBJECT);
				if (!$term) continue;
				array_push($ids, $term->term_id);
			}
			wp_set_post_terms($post_id, $ids, $tax);
		}

		// @link https://iconicwp.com/blog/get-woocommerce-page-id-url/
		$shop_url = wc_get_page_permalink( 'shop' );

		// Envoyer un email pour prevenir l'administrateur de cette annonce
		$message = null;
		msServices::sendMessage([
			'post_id' => $post_id
		]);
		$send_result = apply_filters('send_email_annonce', $message);
		wp_send_json([
			'success' => true,
			'msg' => 'Annonce ajouter avec succès',
			'email_msg' => $send_result,
			'redirect' => $shop_url
		]);
	}

	/**
	 * Cette fonction permet d'ajouter des galeries sur l'annonce (product)
	 * @return wp_send_json
	 */
	public function ajax_upload_medias()
	{
		if ($_SERVER['REQUEST_METHOD'] != 'POST') return false;
		$galeries = [];
		$post_id = (int)ManagnaSarl::getValue('post_id');
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		if (empty($_FILES)) return;
		$files = $_FILES["files"];
		foreach ($files['name'] as $key => $value) {
			if ($files['name'][$key]) {

				$filename = $files['name'][$key];
				$file_basename = substr($filename, 0, strripos($filename, '.')); // return file name
				$file_ext = substr($filename, strripos($filename, '.')); // return file extention
				$file = array(
					'name' => md5($file_basename) . '_' . $post_id . $file_ext,
					'type' => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error' => $files['error'][$key],
					'size' => $files['size'][$key]
				);

				$_FILES = array("files" => $file);
				$attachment_id = media_handle_upload("files", $post_id);
				if (is_wp_error($attachment_id)) {
					/** Error occured */
					wp_send_json([
						'success' => false,
						'msg' => $attachment_id->get_error_message()
					]);
				} else {
					array_push($galeries, $attachment_id);
				}
			}
		}
		/**
		 * Add image gallery in this post
		 */
		update_post_meta($post_id, '_product_image_gallery', implode(",", $galeries));
		wp_send_json(['success' => true, 'gallery' => $galeries]);
	}

	/**
	 * Cette fonction permet d'ajouter l'image à la une de l'annonce (product)
	 * @return wp_send_json
	 */
	public function ajax_upload_media()
	{
		$post_id = (int)ManagnaSarl::getValue('post_id');
		if ($_SERVER['REQUEST_METHOD'] != 'POST') return false;
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		if (empty($_FILES)) wp_send_json(['success' => false, 'msg' => 'Files is empty!']);
		$attachment_id = media_handle_upload("file", $post_id);
		if (!is_wp_error($attachment_id)) {
			update_post_meta($post_id, '_thumbnail_id', $attachment_id);
			wp_send_json(['attachment_id' => $attachment_id, 'success' => true]);
		} else {
			wp_send_json([
				'success' => false,
				'msg' => $attachment_id->get_error_message()
			]);
		}
	}

}

return new Ajax();