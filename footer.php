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
		<footer class="footer wow fadeIn" data-wow-duration="1.3s" data-wow-delay="0.5s">
			<div class="footer-top">
				<div class="footer-top">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-sm-6 col-sm-12">
								<div class="footer-services">

								</div>
							</div>
							<div class="col-md-4 col-sm-6 col-sm-12"></div>
							<div class="col-md-4 col-sm-6 col-sm-12"></div>
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
										'container_id' => 'dropdown'
									] );
								endif;
								?>
							</div>
							<div class="col-md-5 col-sm-12 col-xs-12">
								<div class="copyright">
									<p>Copyright <i class="fa fa-copyright"></i> 2018 <a href="#falicrea">Falicrea</a>. All rights reserved.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Footer bottom end-->
			</div>
		</footer>
  <?php wp_footer(); ?>
	</body>
</html>
