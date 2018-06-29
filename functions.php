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

/**
 * https://codex.wordpress.org/Global_Variables
 */

define( '__fixer_io_api__', '28ad6224266d9afb599d399476fe0aed' );
/**
 * Google API (ref: Web API)
 */
define( '__google_api__', base64_decode('QUl6YVN5Qng3LVJKbGlwbWU0YzMtTGFWUk5oRnhiV19xWG5DUXhj'));
define( '__SITENAME__', 'ManagnaImmo' );
define( 'TWIG_TEMPLATE_PATH', get_template_directory() . '/includes/templates/twig' );

$theme = wp_get_theme( 'managnasarl' );

// Widgets files
require 'includes/widgets/widget-contact-form.php';
require 'includes/widgets/widget-search-form.php';

require 'includes/shortcode/property-details-image.php';

$managnaSarl = (object) array(
	'version'  => $theme->get( 'Version' ),
	'main'     => require 'includes/class-managnasarl.php',
	'services' => require 'includes/class-services.php',
);

$managnaSarl->main->search_filter_query();

require 'includes/managnasarl-functions.php';
require 'includes/walker-menu.php';
require 'includes/acf.php'; // ACF
require 'includes/actions/managnasarl-actions.php';
require 'includes/vc/vc-function-managnasarl.php';

// $managnaSarl->services->getCurrency();
/** Twig Engine */
require 'vendor/autoload.php';
try {

	$loader = new Twig_Loader_Filesystem();
	$loader->addPath( TWIG_TEMPLATE_PATH . '/admin', 'admin' );
	$loader->addPath( TWIG_TEMPLATE_PATH . '/widgets/front', 'WIDGETS_FRONT' );
	$loader->addPath( TWIG_TEMPLATE_PATH . '/widgets/back', 'WIDGETS_BACK' );
	$loader->addPath( TWIG_TEMPLATE_PATH . '/mail', 'MAIL' );
	$loader->addPath( TWIG_TEMPLATE_PATH . '/vc', 'VC' );
	$loader->addPath( TWIG_TEMPLATE_PATH . '/shortcodes', 'Shortcodes' );

	/** @var Filter $thumbnailFilter */
	$thumbnailFilter = new Twig_SimpleFilter( 'thumbnail', function ( $id ) {
		$product = wc_get_product((int) $id);
		$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
		return $product ? $product->get_image( $image_size ) : '';
	} );

	/** @var Object $twig */
	$twig = new Twig_Environment( $loader, array(
		'debug'       => WP_DEBUG,
		'cache'       => TWIG_TEMPLATE_PATH . '/template_cache',
		'auto_reload' => true
	) );

	$twig->addFilter( $thumbnailFilter );
} catch ( Twig_Error_Loader $e ) {
	die($e->getRawMessage());
}

// Custom action
add_action( 'action_property_bottom_list', 'set_property_bottom_list', 10, 1 );
add_action( 'action_embed_style_header', 'embed_style_header' );

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'twentyfifteen' );
	load_theme_textdomain( __SITENAME__, get_template_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	// Render this template compatible with woocommerce
	// @link
	add_theme_support( 'woocommerce', [
		'thumbnail_image_width' => 360,
		'gallery_thumbnail_image_width' => 100,
		'single_image_width' => 600,
	] );

	/** Register menu location */
	register_nav_menus( array(
		'primary'     => __( 'Primary Menu', 'twentyfifteen' ),
		'menu-top'    => __( 'Top Menu', __SITENAME__ ),
		'menu-footer' => __( 'Footer Menu', __SITENAME__ ),
	) );
} );

if ( function_exists( 'acf_add_options_page' ) ) {
	// Premier menu d'options
	acf_add_options_page( array(
		'page_title' => 'Managna Immo Options',
		'menu_title' => 'Managna Immo',
		'menu_slug'  => 'options-managna-immo',
		'capability' => 'edit_posts',
		'redirect'   => true
	) );
}


