<?php
/*
 * Template Name: Formulaire d'annonce
 * Author: Tiafeno Finel
 * Description: Template pour afficher le formulaire d'ajout d'annonce
 * Version: 0.0.1
 */

get_header();

wp_deregister_script('semantic');
wp_deregister_script('semantic-checkbox');
wp_deregister_script('semantic-dropdown');
wp_deregister_script('semantic-transition');
wp_deregister_script('semantic-form');

wp_enqueue_style('semantic');
wp_enqueue_style('semantic-image');
wp_deregister_style('semantic-form');
wp_deregister_style('semantic-buttom');
wp_deregister_style('semantic-icon');
wp_deregister_style('semantic-message');
wp_deregister_style('semantic-transition');
wp_deregister_style('semantic-checkbox');
wp_deregister_style('semantic-input');
wp_deregister_style('semantic-dropdown');

wp_enqueue_style('angular-material');
wp_enqueue_style('Material-Icon', 'https://fonts.googleapis.com/icon?family=Material+Icons');

wp_enqueue_script('bluebird');
wp_enqueue_script('angular');
wp_enqueue_script('angular-animate');
wp_enqueue_script('angular-sanitize');
wp_enqueue_script('angular-route');
wp_enqueue_script('angular-aria');
wp_enqueue_script('angular-material');
wp_enqueue_script('angular-messages');

wp_enqueue_script('annonce-application', get_template_directory_uri() . '/assets/js/app/annonce.js', ['angular', 'angular-file-upload-shim', 'angular-file-upload'], true);
wp_localize_script('annonce-application', 'annonceOptions', [
	'ajax_url' => admin_url('admin-ajax.php'),
	'application_directory_uri' => get_template_directory_uri() . '/assets/js/app'
]);

?>
		<style type="text/css">
			form#new-annonce input[type='checkbox'] {
				height: inherit !important;
				width: inherit !important;
			}
			body, html {
				height: inherit !important;
				font-family: Roboto,Helvetica Neue,sans-serif;
			}
			input[type=search] {
				box-sizing: border-box !important;
				-webkit-box-sizing: border-box !important;
			}

			.hint {
				font-size: 13px;
				font-style: oblique;
				font-family: Roboto;
			}

			.ui.small.images > div {
				display: inline-block;
				margin: 0 .25rem .5rem;
				float: left;
				position: relative;
			}
			
			.ui.small.images .options {
				display: block;
				position: absolute;
				top: 4px;
				right: 6px;
				width: inherit;
				height: inherit;
			}

			.options i.material-icons {
				cursor: pointer;
				background: white;
				padding: 2px;
				border-radius: 20px;
				opacity: 0.7;
			}

			.add-new-picture {
				width: 150px;
				border: 8px solid #bcbec0;
				height: 150px;
				position: relative;
			}

			.add-new-picture i{
				font-size: 68px;
				position: absolute;
				transform-origin: 0;
				right: 25%;
				top: 25%;
				color: #bcbec0;
				cursor: pointer;
			}

			button, html, input, select, textarea {
				font-family: Roboto,Helvetica Neue,sans-serif !important;
			}

			md-input-container .md-input {
				background: rgba(255, 248, 220, 0.47058823529411764);
			}

		</style>
		<div class="container ptb-100" ng-app="annonceModule">
			<div ng-controller="annonceCTRL">
				<div ng-view></div>
			</div>
		</div>
	</div> <!-- .end wrapper white_bg -->
<?php
get_footer();
