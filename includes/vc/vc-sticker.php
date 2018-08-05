<?php
if ( ! class_exists('WPBakeryShortCode')) die('WPBakery plugins missing!');
class vcStickerBox extends WPBakeryShortCode {
  public function __construct() {
    add_action( 'init', [ $this, 'vc_sticker_mapping' ] );
    add_shortcode( 'vc_sticker', [ $this, 'vc_sticker_html' ] );
  }

  public function getContents() {
    $dropdown_value = [];
    $categories = msServices::getTaxonomyContents('category');
    foreach ($categories as $categorie) {
      $dropdown_value = array_merge($dropdown_value, ["$categorie->slug" => ucfirst($categorie->name)]);
    }
    return $dropdown_value;
  }

  public function vc_sticker_mapping() {
    // Stop all if VC is not enabled
    if ( ! defined( 'WPB_VC_VERSION' ) ) {
      return;
    }
    
    // Map the block with vc_map()
    vc_map(
      array(
        'name'        => __( 'VC Sticker', __SITENAME__ ),
        'base'        => 'vc_sticker',
        'description' => 'Affiche une bar de deffilement des actualités dans le site',
        'category'    => __( 'Managna Immo', __SITENAME__ ),
        'params'      => array(
          array(
            'type'        => 'textfield',
            'holder'      => 'h3',
            'class'       => 'title-class',
            'heading'     => __( 'Title', __SITENAME__ ),
            'param_name'  => 'title',
            'value'       => 'Actualités',
            'description' => __( 'Ajouter une titre', __SITENAME__ ),
            'admin_label' => false,
            'weight'      => 0
          ),
          array(
            'type'        => 'dropdown',
            'class'       => 'category',
            'heading'     => __( 'Categorie', __SITENAME__ ),
            'param_name'  => 'title',
            'value'       => $this->getContents(),
            'description' => __( 'Ajouter une titre', __SITENAME__ ),
            'admin_label' => true,
            'weight'      => 0
          )

        )
      )
    );
  }

  public function vc_sticker_html($attrs) {
    global $twig;
    // Params extraction
    extract(
      shortcode_atts(
        array(
          'title' => '',
          'category' => ''
        ),
        $attrs
      )
    );
    wp_enqueue_script( 'webticker' );
    /** @var string $title */
    /** @var string $category */
    try {
      return $twig->render( '@VC/sticker.html', [
        'category' => $category,
        'title'    => $title
      ] );
    } catch ( Twig_Error_Loader $e ) {
    } catch ( Twig_Error_Runtime $e ) {
    } catch ( Twig_Error_Syntax $e ) {
      echo $e->getRawMessage();
    }
  }
}

new vcStickerBox();