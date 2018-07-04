<?php
/*
 * Template Name: Formulaire d'annonce
 * Author: Tiafeno Finel
 * Description: Template pour afficher le formulaire d'ajout d'annonce
 * Version: 0.0.1
 */

acf_form_head();
get_header();

?>
<div class="container ptb-100">
	<?php acf_form('new-annonce'); ?>
</div>
	</div> <!-- .end wrapper white_bg -->
<?php
get_footer();