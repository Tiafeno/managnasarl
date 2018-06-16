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
			$this->EUR2MGA = get_option('EUR2MGA', false);
			if ( ! $this->EUR2MGA)
				$this->getCurrency();
			if ($this->EUR2MGA instanceof stdClass) {
				$optionDate = strtotime($this->EUR2MGA->date);
				$today = strtotime(date('Y-m-d'));
				if ($optionDate != $today)
					$this->getCurrency();
			}
		}

		/**
		 * Récuperer l'echange en cours pour EUR en MGA
		 */
		public function getCurrency() {
			echo 'Loading cUrl';
			$fields_string = '';
			$fields = (object)[
					'access_key' => __fixer_io_api__,
					'base' => 'EUR',
					'symbols'   => 'MGA',
			];
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			// Open connection
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, "http://data.fixer.io/api/latest?access_key={$fields->access_key}&base={$fields->base}&symbols={$fields->symbols}");
			curl_setopt_array($ch, [
					CURLOPT_RETURNTRANSFER => 1
			]);
			// Execute!
			$response = curl_exec($ch);
			// Close the connection, release resources used
			curl_close($ch);
			$this->fixerIOData = json_decode($response);
			return $this->updateCurrencyMGA();
		}

		/**
		 * Mettre à jours la valeur de l'echange
		 */
		public function updateCurrencyMGA() {
			update_option('EUR2MGA', $this->fixerIOData);
			return $this->fixerIOData;
		}

		/**
		 * @return int|mixed|void
		 */
		public function getCurrencyMGA() {
			if ($this->EUR2MGA == 0) return $this->getCurrency();
			return $this->EUR2MGA;
		}
	}
endif;

return new msServices();