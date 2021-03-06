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

if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists('ManagnaSarl')) :
  class ManagnaSarl
{


  public function __construct()
  {
			//

    add_action('wp_loaded', function () {

			// Rennomer les étiquettes d'Woocommerce (product) en "Annonce"
      $p_object = get_post_type_object('product');
      if ($p_object) {
				// see get_post_type_labels()
        $p_object->labels->name = 'Annonces';
        $p_object->labels->singular_name = 'Annonce';
        $p_object->labels->add_new = 'Ajouter une annonce';
        $p_object->labels->add_new_item = 'Ajouter une nouvelle annonce';
        $p_object->labels->all_items = 'Tous les annonces';
        $p_object->labels->edit_item = 'Modifier l\'annonce';
        $p_object->labels->name_admin_bar = 'Annonce';
        $p_object->labels->menu_name = 'Annonces';
        $p_object->labels->new_item = 'Nouvelle annonce';
        $p_object->labels->not_found = 'Aucune annonce trouvée';
        $p_object->labels->not_found_in_trash = 'Aucune annonce trouvée dans la corbeille';
        $p_object->labels->search_items = 'Trouver une annonce';
        $p_object->labels->view_item = 'Afficher l\'annonce';
      }
			
			// Modifier le nom de l'article (post) en "Actualité"
      $a_object = get_post_type_object('post');
      if ($a_object) {
        $a_object->labels->name = 'Actualités';
        $a_object->labels->singular_name = 'Actualité';
        $a_object->labels->add_new = 'Ajouter une actualité';
        $a_object->labels->add_new_item = 'Ajouter une nouvelle actualité';
        $a_object->labels->all_items = 'Tous les actualités';
        $a_object->labels->edit_item = 'Modifier l\'actualité';
        $a_object->labels->name_admin_bar = 'Actualité';
        $a_object->labels->menu_name = 'Actualités';
        $a_object->labels->new_item = 'Nouvelle actualité';
        $a_object->labels->not_found = 'Aucune actualité trouvée';
        $a_object->labels->not_found_in_trash = 'Aucune actualité trouvée dans la corbeille';
        $a_object->labels->search_items = 'Trouver une actualité';
        $a_object->labels->view_item = 'Afficher l\'actualité';
      }
      return true;
    }, 20);

			// Save scripts and styles
    add_action('wp_enqueue_scripts', array($this, 'scripts'));

			// Wordpress initialization
    add_action('init', array($this, 'init'));

			// Save widgets
    add_action(
      'widgets_init',
      function () {
        $this->widgets_init();

				// @folder includes/widgets
        register_widget('SearchFilterWidget');
        register_widget('ContactPropertyFormWidget');
      }
    );

    /**
     * @filter manage_posts_columns
     * Remove column in product admin page
     */
    add_filter('manage_edit-product_columns', function ($columns) {
      unset($columns['product_tag']);
      unset($columns['product_type']);
      return $columns;
    }, 10, 1);

			// Remove woocommerce filter in admin page
    add_filter('woocommerce_product_filters', function () {
      return "";
    }, 10);


			// Add class name in body
    add_filter('body_class', array($this, 'body_classes'));

    // Publier une annonce en attente (annonce ajouter par les visiteurs)
    add_action('transition_post_status', function ($newStatus, $oldStatus, $post) {
      global $twig;
      if ($post->post_status != 'product') return;
      if ($oldStatus != 'pending'  &&  $newStatus != 'publish') return;

			// Envoyer l'annonce au abonnée
      $this->send_newsletter($post);

			// Envoyer l'annonce à son propriétaire
      $template = new stdClass();
      $template->link = get_the_permalink($post->ID);
      if (function_exists('get_field')) {
        $template->author = get_field('advertiser_name', $post->ID);
        $template->author_email = get_field('advertiser_email', $post->ID);
      } else {
        $template->author = "Propriétaire";
      }
      $args = [
        'post' => $template,
      ];
      $content = $twig->render('@MAIL/publish.html', $args);
      $subject = "Publication | Managna Immo";
      $to = $template->author_email;
      $headers = [];
      $headers[] = 'Content-Type: text/html; charset=UTF-8';
      $headers[] = 'From: Managna Immo <no-reply@managna-immo.com>';
      
      wp_mail($to, $subject, $content, $headers);
    }, 10, 3);

    // Crée une nouvelle annonce depuis la BO
    add_action('save_post', function ($post_id, $post) {
      global $managnaSarl;
      if ($post->post_type != 'product') return;
			// Modifier les sku apres avoir publier un produit dans la back-office.
      $skuG = $managnaSarl->services->generateSku($post->ID);
      if (is_null($skuG)) return;
      if ($managnaSarl->services->update_post_sku($post, $skuG)) {
        $this->send_newsletter($post);
      }
    }, 10, 2);

			// Change shop post product view per page
    add_filter('loop_shop_per_page', function ($cols) {
      $cols = 6;
      return $cols;
    }, 20);

    /** Supprimer les deux colones (categories, tags) dans product*/
    add_action('admin_init', function () {
      add_filter('manage_product_posts_columns', function ($columns) {
        unset($columns['product_tag']);
        unset($columns['product_cat']);
        return $columns;
      }, 100);
    });

			// Add acf google map api
    add_filter('acf/init', function () {
      acf_update_setting('google_api_key', __google_api__);
    });

			// Sets the text domain used when translating field and field group settings.
			// Defaults to ”. Strings will not be translated if this setting is empty
    add_filter('acf/settings/l10n_textdomain', function () {
      return __SITENAME__;
    });
  }

  public static function getValue($name, $def = false)
  {
    if (!isset($name) || empty($name) || !is_string($name)) {
      return $def;
    }
    $returnValue = isset($_POST[$name]) ? trim($_POST[$name]) : (isset($_GET[$name]) ? trim($_GET[$name]) : $def);
    $returnValue = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($returnValue)));

    return !is_string($returnValue) ? $returnValue : stripslashes($returnValue);
  }

  public function send_newsletter($post)
  {
    if (!$post instanceof WP_Post) return;
    $message = null;
    $form = [
      'post_id' => $post->ID
    ];
    msServices::sendMessage($form, 'newsletter');
    $send_result = apply_filters('managna_send_email', $message);
    if (is_null($send_result)) return;
			// TODO: Q&A test
  }

  public function search_filter_query()
  {
    add_action('woocommerce_product_query', function ($q) {
      $meta_query = $q->get('meta_query');

				// The default relation for a meta query is AND

      /**
       * Woocommerce post meta
       */
      if (self::getValue('price')) {
        $price = self::getValue('price');

        $prices = explode('-', $price);
        $min_price = (int)trim($prices[0]);
        $max_price = (int)trim($prices[1]);

        $meta_query[] = array(
          'key' => '_regular_price',
          'value' => array($min_price, $max_price),
          'compare' => 'BETWEEN',
          'type' => 'NUMERIC'
        );
      }

      /**
       * ACF post meta
       * Filter by rent or sale
       * @field {text} Formulaire
       */
      if (self::getValue('status')) {
        $status = self::getValue('status');
        $meta_query[] = array(
          'key' => 'type',
          'value' => $status,
          'compare' => '='
        );
      }

      /**
       * ACF post meta
       * @group details {Détails sur la maison}
       * @field {number} bedroom
       */
      if (self::getValue('area')) {
        $area = self::getValue('area');
        $meta_query[] = array(
          'key' => 'details_bedroom',
          'value' => $area,
          'compare' => '='
        );
      }

      /**
       * ACF post meta
       * @field {text} property
       */
      if (self::getValue('property')) {
        $property = self::getValue('property');
        $meta_query[] = array(
          'key' => 'prop',
          'value' => $property,
          'compare' => '='
        );
      }

				// Set for global query
      $q->set('meta_query', $meta_query);
    });
  }

  /**
   * Wordpress initialization function
   */
  public function init()
  {
			//unregister_taxonomy('product_tag');
			//unregister_taxonomy('product_cat');

    add_filter('manage_taxonomies_for_product_columns', function ($taxonomies) {
      return $taxonomies;
    });

    $amenities = array(
      'name' => _x('Equipements', 'taxonomy general name'),
      'singular_name' => _x('Equipement', 'taxonomy singular name'),
      'search_items' => 'Trouver une équipement',
      'all_items' => 'Trouver des équiments',
      'parent_item' => 'Equipement parent',
      'parent_item_colon' => 'Equipement parent:',
      'edit_item' => 'Modifier l\'équipement',
      'update_item' => 'Mettre à jour l\'équipement',
      'add_new_item' => 'Ajouter une nouvelle équipement',
      'menu_name' => 'Equipements',
    );

			// Now register the taxonomy (Equipement)
    register_taxonomy('amenities', array('product'), [
      'hierarchical' => true,
      'labels' => $amenities,
      'show_ui' => true,
      'show_admin_column' => false,
      'query_var' => true,
      'rewrite' => array('slug' => 'amenitie'),
    ]);

    $region = array(
      'name' => _x('Régions', 'taxonomy general name'),
      'singular_name' => _x('Région', 'taxonomy singular name'),
      'search_items' => 'Trouver une région',
      'all_items' => 'Trouver des régions',
      'parent_item' => 'Parent',
      'parent_item_colon' => 'Région parent:',
      'edit_item' => 'Modifier la région',
      'update_item' => 'Mettre à jour la région',
      'add_new_item' => 'Ajouter une nouvelle région',
      'menu_name' => 'Régions',
    );

			// Now register the taxonomy (Région)
    register_taxonomy('region', array('product'), [
      'hierarchical' => true,
      'labels' => $region,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'region'),
    ]);

    $zipcode = array(
      'name' => _x('Code postal', 'taxonomy general name'),
      'singular_name' => _x('Code postal', 'taxonomy singular name'),
      'search_items' => 'Trouver une code postal',
      'all_items' => 'Trouver des code postal',
      'parent_item' => 'Parent',
      'parent_item_colon' => 'Code postal parent:',
      'edit_item' => 'Modifier le code postal',
      'update_item' => 'Mettre à jour le code postal',
      'add_new_item' => 'Ajouter une nouvelle code postal',
      'menu_name' => 'Zipcode',
    );

			// Now register the taxonomy (Région)
    register_taxonomy('zipcode', array('product'), [
      'hierarchical' => true,
      'labels' => $zipcode,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'zipcode'),
    ]);


  }

  public function widgets_init()
  {
			// Element avec le fond orange
    register_sidebar(array(
      'name' => 'Middle Bottom',
      'id' => 'middle-bottom',
      'description' => 'Add widgets here to appear in content bottom.',
      'before_widget' => '<div id="%1$s" class="%2$s uk-text-meta menu-area">',
      'after_widget' => '</div>',
      'before_title' => '<div class="">',
      'after_title' => '</div>'
    ));

    register_sidebar(array(
      'name' => 'Single Property Sidebar',
      'id' => 'sidebar-shop',
      'description' => 'Add widgets here to appear in property single page right position.',
      'before_widget' => '<aside id="%1$s" class="%2$s single-side-box">',
      'after_widget' => '</aside>',
      'before_title' => '<div class="aside-title"><h5>',
      'after_title' => '</h5></div>'
    ));

    register_sidebar(array(
      'name' => 'Offering Sidebar',
      'id' => 'sidebar-offering',
      'description' => 'Add widgets here to appear in offer right position.',
      'before_widget' => '<aside id="%1$s" class="%2$s single-side-box">',
      'after_widget' => '</aside>',
      'before_title' => '<div class="aside-title"><h5>',
      'after_title' => '</h5></div>'
    ));

    register_sidebar([
      'name' => 'Footer left',
      'id' => 'footer-left',
    ]);

    register_sidebar([
      'name' => 'Footer Middle',
      'id' => 'footer-middle',
    ]);

    register_sidebar([
      'name' => 'Footer Right',
      'id' => 'footer-right',
    ]);
  }

  private function register_angular_link()
  {
    global $managnaSarl;
    $Scripts = [
      [
        'handle' => 'angular',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular/angular.js',
        'addiction' => []
      ],
      [
        'handle' => 'angular-file-upload-shim',
        'src' => get_template_directory_uri() . '/libs/node_modules/ng-file-upload/dist/ng-file-upload-shim.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-file-upload',
        'src' => get_template_directory_uri() . '/libs/node_modules/ng-file-upload/dist/ng-file-upload.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-animate',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-animate/angular-animate.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-aria',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-aria/angular-aria.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-material',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-material/angular-material.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-messages',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-messages/angular-messages.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-route',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-route/angular-route.min.js',
        'addiction' => ['angular']
      ],
      [
        'handle' => 'angular-sanitize',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-sanitize/angular-sanitize.min.js',
        'addiction' => ['angular']
      ],
    ];

    foreach ($Scripts as $script) :
      wp_register_script($script['handle'], $script['src'], $script['addiction'], $managnaSarl->version, true);
    endforeach;

    $Styles = [
      [
        'handle' => 'angular-material',
        'src' => get_template_directory_uri() . '/libs/node_modules/angular-material/angular-material.min.css',
        'addiction' => []
      ]
    ];

    foreach ($Styles as $style) {
      wp_register_style($style['handle'], $style['src'], '', $managnaSarl->version);
    }

  }

  private function register_scripts()
  {
    global $managnaSarl;
    $version = $managnaSarl->version;
    wp_register_script('webticker', get_template_directory_uri() . '/assets/js/jquery/jquery.webticker.min.js', ['jquery'], $version, true);
    wp_register_script('bluebird', get_template_directory_uri() . '/assets/js/bluebird.min.js', [], $version, true);
    wp_register_script('semantic', get_template_directory_uri() . '/libs/semantic/semantic.min.js', ['jquery'], $version, true);
    wp_register_script('semantic-checkbox', get_template_directory_uri() . '/libs/semantic/components/checkbox.min.js', ['jquery'], $version, true);
    wp_register_script('semantic-dropdown', get_template_directory_uri() . '/libs/semantic/components/dropdown.min.js', ['jquery'], $version, true);
    wp_register_script('semantic-transition', get_template_directory_uri() . '/libs/semantic/components/transition.min.js', ['jquery'], $version, true);
    wp_register_script('semantic-form', get_template_directory_uri() . '/libs/semantic/components/form.min.js', ['jquery'], $version, true);
    wp_register_script('admin-element-search-filter', get_template_directory_uri() . '/assets/js/admin/admin-search-filter.js', [
      'jquery',
      'managnasarl-plugins'
    ], $version, true);
    wp_register_script('slick-script', get_template_directory_uri() . '/assets/js/jquery/slick.min.js', ['jquery'], $version, true);
    wp_register_style('slick', get_template_directory_uri() . '/assets/css/slick.css', '', $version);
    wp_register_style('slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', '', $version);

    wp_register_style('lightbox', get_template_directory_uri() . '/assets/css/lightbox/lightbox.min.css', '', $version);
    wp_register_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox/lightbox.min.js', ['jquery'], $version, true);

    wp_register_style('semantic', get_template_directory_uri() . '/libs/semantic/semantic.min.css', '', $version);
    wp_register_style('semantic-form', get_template_directory_uri() . '/libs/semantic/components/form.min.css', '', $version);
    wp_register_style('semantic-button', get_template_directory_uri() . '/libs/semantic/components/button.min.css', '', $version);
    wp_register_style('semantic-image', get_template_directory_uri() . '/libs/semantic/components/image.min.css', '', $version);
    wp_register_style('semantic-icon', get_template_directory_uri() . '/libs/semantic/components/icon.min.css', '', $version);
    wp_register_style('semantic-message', get_template_directory_uri() . '/libs/semantic/components/message.min.css', '', $version);
    wp_register_style('semantic-transition', get_template_directory_uri() . '/libs/semantic/components/transition.min.css', '', $version);
    wp_register_style('semantic-checkbox', get_template_directory_uri() . '/libs/semantic/components/checkbox.min.css', '', $version);
    wp_register_style('semantic-input', get_template_directory_uri() . '/libs/semantic/components/input.min.css', '', $version);
    wp_register_style('semantic-dropdown', get_template_directory_uri() . '/libs/semantic/components/dropdown.min.css', '', $version);

    wp_register_style('Lato', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&subset=latin');
    wp_register_script('tinyMCE', '//cloud.tinymce.com/stable/tinymce.min.js?apiKey=2grxn9iofnxolcaedqa399sh4ft6c1mg3e1kumgnyq6o0ap1');

  }

  public function scripts()
  {
    global $managnaSarl;

    /**
     * Styles
     */
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', '', $managnaSarl->version);
    wp_enqueue_style('core', get_template_directory_uri() . '/assets/css/core.css', '', $managnaSarl->version);
    wp_enqueue_style('shortcode', get_template_directory_uri() . '/assets/css/shortcode/shortcodes.css', '', $managnaSarl->version);
    wp_enqueue_style('managnasarl-style', get_stylesheet_uri(), array(), $managnaSarl->version);
    wp_enqueue_style('managnasarl-override-style', get_template_directory_uri() . '/assets/css/managna-sarl.override.css', '', $managnaSarl->version);
    wp_enqueue_style('responsive', get_template_directory_uri() . '/assets/css/responsive.css', '', $managnaSarl->version);
    /** customizer style css */
    wp_enqueue_style('customizer', get_template_directory_uri() . '/assets/css/style-customizer.css', '', $managnaSarl->version);
    wp_enqueue_style('PT-sans', "//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i");

    /**
     * Scripts
     */
    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
    wp_enqueue_script('underscore');
    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('jquery-nivo', get_template_directory_uri() . '/assets/js/jquery/jquery.nivo.slider.pack.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('jquery-counterup', get_template_directory_uri() . '/assets/js/jquery/jquery.counterup.min.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('jquery-magnific', get_template_directory_uri() . '/assets/js/jquery/jquery.magnific-popup.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('managnasarl-customizer', get_template_directory_uri() . '/assets/js/style-customizer.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('managnasarl-plugins', get_template_directory_uri() . '/assets/js/plugins.js', ['jquery'], $managnaSarl->version, true);
    wp_enqueue_script('managnasarl-main', get_template_directory_uri() . '/assets/js/main.js', array(
      'jquery',
      'jquery-nivo',
      'owl-carousel'
    ), $managnaSarl, true);
    wp_enqueue_script('moment', get_template_directory_uri() . '/assets/js/moment.min.js', [], $managnaSarl->version, true);
    wp_enqueue_script('principal', get_template_directory_uri() . '/assets/js/managna-immo.js', array(
      'jquery',
      'moment'
    ), $managnaSarl->version, true);
    wp_localize_script(
      'principal',
      'jManagna',
      [
        'currency' => $managnaSarl->services->getCurrencyMGA(),
        'templateUrl' => get_template_directory_uri(),
        'ajax_url' => admin_url('admin-ajax.php')
      ]
    );

    $this->register_scripts();
    $this->register_angular_link();
  }

  /**
   * Adds custom classes to the array of body classes.
   *
   * @param array $classes Classes for the body element.
   *
   * @return array
   */
  public function body_classes($classes)
  {
    $classes[] = 'wide-layout';
    return $classes;
  }
}
endif;

return new ManagnaSarl();
