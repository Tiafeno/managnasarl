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
?>
			<footer class="footer">
				<div class="footer-primary">
					<div class="footer-top">
						<div class="container">
							<div class="row">
								<div class="col-md-4 col-sm-6 col-sm-12">
									<div class="footer-container ptb-40">
										<?php
										if ( is_active_sidebar( 'footer-left' ) ) :
											dynamic_sidebar( 'footer-left' );
										endif;
										?>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-sm-12">
									<div class="footer-container ptb-40">
										<?php
										if ( is_active_sidebar( 'footer-middle' ) ) :
											dynamic_sidebar( 'footer-middle' );
										endif;
										?>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-sm-12">
									<div class="footer-container ptb-40">
										<?php
										if ( is_active_sidebar( 'footer-right' ) ) :
											dynamic_sidebar( 'footer-right' );
										endif;
										?>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Footer bottom start-->
					<div class="footer-bottom">
						<div class="container">
							<div class="row">
								<div class="col-md-7 col-sm-12 col-xs-12">
									<?php
									if ( has_nav_menu( "menu-footer" ) ) :
										wp_nav_menu( [
											'menu_class'      => "",
											'theme_location'  => 'menu-footer',
											'container'       => 'div',
											'container_class' => 'footer-menu'
										] );
									endif;
									?>
								</div>
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="copyright">
										<p>Copyright <i class="fa fa-copyright"></i> 2018. All rights reserved.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Footer bottom end-->
				</div>
			</footer>
	<style type="text/css">
		footer.footer .footer-top {
			background-color: #3C3C3C;
		}

		.footer p,
		.footer span,
		.footer {
			color:#dcdcdc;
			line-height: 16px;
		}

		.footer h2.widgettitle {
			font-size: x-large;
			text-transform: uppercase;
			color: #ffffff;
		}

		.footer ul.menu li {
			color: #dcdcdc;
		}

		.footer ul.menu li > a:hover {
			color: #b33c50;
		}

		.footer ul.menu li > a {
			color: #dcdcdc;
			padding-top: 5px;
			padding-bottom: 5px;
			display: block;
		}

		.footer-menu li a {
			font-family: 'PT Sans', sans-serif !important;
		}
		.footer a {
			color: #ddd;
		}
	</style>
	<?php wp_footer(); ?>
		</div>
	</body>
</html>
