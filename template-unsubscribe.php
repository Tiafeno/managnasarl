<?php
/*
 * Template Name: Newsletters
 * Author: Tiafeno Finel
 * Description: Template pour afficher le formulaire d'ajout d'annonce
 * Version: 1.1.42
 */

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

if (empty($_GET)) exit('Bad link');
$email_params = ManagnaSarl::getValue('email', false);
if (!$email_params) {
	exit('Bad params url');
} else {
	$email = base64_decode($email_params);
	if (!class_exists('vcNewsletterBox')) exit("Une erreur s'est produite");
	if (vcNewsletterBox::isRegister($email)) {
		vcNewsletterBox::remove_newsletter($email);
	} else {
		exit('Vous n\'est pas un abonnée');
	}
}

get_header();

?>

	<div class="content-property pt-100">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ptb-100">
					<h4 class="text-center">Vous êtes désabonné(e)!</h4>
					<p class="text-center">Vous ne recevrez plus nos newsletters.</p>
				</div>
			</div>
		</div>
	</div>
</div> <!-- .end wrapper white_bg -->
<?php get_footer(); ?>