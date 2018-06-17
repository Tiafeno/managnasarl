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
<!DOCTYPE html>
<!-- saved from url=(0056)https://devitems.com/html/haven-preview/haven/index.html -->
<html class="no-js" <?= language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<!-- Place favicon.ico in the root directory -->

	<!-- All css files are included here. -->
	<?php wp_head(); ?>
	<?php do_action( 'action_embed_style_header' ); ?>
</head>
<body <?php body_class(); ?> >
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
	your browser</a> to improve your experience.</p>
<![endif]-->

<!--Preloader start-->
<div id="fakeLoader"></div>
<!--Preloader end-->

<div class="wrapper white_bg">
	<!--Header section start-->
	<header class="header header-2">
		<div class="header-top-1">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 hidden-xs">
						<div class="haven-call">
							<p><!-- +012 345 678 102 --></p>
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="header-1-top-inner">

							<?php
							if ( has_nav_menu( "menu-top" ) ) :
								wp_nav_menu( [
									'menu_class'      => "",
									'theme_location'  => 'menu-top',
									'container_class' => 'header-topbar-menu',
								] );
							endif;
							?>

							<div class="header-search">
								<div class="search-icon">
									<a href="#">Mon compte</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="header-top sticky-header">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="logo">
							<a href="<?= home_url('/') ?>"><img src="<?= get_template_directory_uri() . '/img/logo.png' ?>" alt=""></a>
						</div>
					</div>
					<div class="col-md-10 hidden-sm hidden-xs">
						<div class="mgea-full-width">
							<div class="header-menu">
								<?php
								if ( has_nav_menu( "primary" ) ) :
									wp_nav_menu( [
										'menu_class'      => "",
										'theme_location'  => 'primary',
										'container'       => 'nav',
										'container_class' => '',
										'walker'          => new Primary_Walker
									] );
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Mobile menu start -->
			<div class="mobile-menu-area hidden-lg hidden-md">
				<div class="container">
					<div class="col-md-12">

						<?php
						if ( has_nav_menu( "primary" ) ) :
							wp_nav_menu( [
								'menu_class'      => "",
								'theme_location'  => 'primary',
								'container'       => 'nav',
								'container_id' => 'dropdown'
							] );
						endif;
						?>
					</div>
				</div>
			</div>
			<!-- Mobile menu end -->
		</div>
		<!--Search box inner start-->
		<div class="search-box-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="search-form">
							<div class="search-form-inner">
								<form action="#">
									<input type="text" placeholder="Search..">
									<button type="submit"><i class="icofont icofont-search-alt-1"></i></button>
								</form>
							</div>
							<div class="search-close-btn">
								<a href="#"><i class="zmdi zmdi-close"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Search box inner end-->
	</header>
	<!--Header section end-->

	<!-- Alert -->
		<?= managna_alert() ?>
	<!-- Alert end-->