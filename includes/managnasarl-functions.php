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

function managna_alert() {
	$messageAlert = null;
	// Return null si la filtre n'est pas ajouter dans le site
	$messageAlert = apply_filters( 'add_message_alert', $messageAlert );
	if ( is_null( $messageAlert ) ) {
		return;
	}

	return '
<div class="pt-50">
	<div class="container">
		<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			' . $messageAlert . '
		</div>
	</div>
</div>';
}

/**
 * @param string $text
 * @param int $limite
 *
 * @return string
 */
function strLimite( $text = '', $limite = 30) {
	if (empty($text)) return $text;
	return strlen($text) > $limite ? substr($text , 0, $limite) . '...' : $text;
}

/**
 * Envoyer un message à l'administrateur pour un message de client
 */
function managna_contact_property() {
	$result = null;
	$inputForm     = ManagnaSarl::getValue( 'form' );
	if ( $inputForm ) {
		if ( $inputForm == 'contact_form' ) {
			$form = [
				'message'   => ManagnaSarl::getValue( 'message-editor' ),
				'firstname' => ManagnaSarl::getValue( 'firstname' ),
				'email'     => ManagnaSarl::getValue( 'email' ),
				'post_id'   => (int) ManagnaSarl::getValue( 'post_id' )
			];
			msServices::sendMessage( $form, 'contact' );
			$result = apply_filters( 'managna_send_email', $result );
			if ( is_null( $result ) ) {
				return;
			}

			echo '<div class="ui info message">
							  <div class="header"> Information </div>
							  <p>' . $result . '</p>
							</div>';
		}
	}
}