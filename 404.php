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

get_header();
?>

	<style type="text/css">
		.error-content h2 {
			color: #b01d36;
		}

		.error-content .go-home {
			background: #b01d36 none repeat scroll 0 0;
		}

		.error-content .go-home:hover {
			background: #606465 none repeat scroll 0 0;
		}
	</style>

	<div class="error-area text-center bg-1 ptb-130">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="error-content ">
						<h2>404</h2>
						<h3>Page non trouvée!</h3>
						<h4>Oops! On dirait que quelque chose ne va pas</h4>
						<p>Nous n'arrivons pas trouver la page que vous cherchez <br>
							assurez-vous que vous avez tapé correctement l'adresse </p>
						<a class="go-home" href="<?= home_url( '/' ) ?>">Aller à la page d'accueil</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();