<?php
namespace Rmcc;
use Timber\Timber;

/**
 * CUSTOM STORE NOTICE
 *
**/

class MinicartPopup extends Timber {

  public function __construct() {
    parent::__construct();
    
    // timber stuff. the usual stuff
    add_filter('timber/twig', array($this, 'add_to_twig'));
    add_filter('timber/context', array($this, 'add_to_context'));
    
    // enqueue plugin assets
    add_action('wp_enqueue_scripts', array($this, 'minicart_popup_assets'));
    
    // add_action('init', array($this, 'minicart_popup_plugins_loaded'));
    add_action('rmcc_after_header', 'custom_minicart_popup', 10);
    
    add_filter('wc_get_template', array($this, 'wc_get_template'), 10, 5); 
  }
  
  public function minicart_popup_assets() {
    wp_enqueue_style(
      'minicart-popup',
      MINICART_POPUP_URL . 'public/css/minicart-popup.css'
    );
  }
  
  public function add_to_twig($twig) { 
    $twig->addExtension(new \Twig_Extension_StringLoader());
    return $twig;
  }

  public function add_to_context($context) {
    return $context;    
  }
  
  public function wc_get_template($located, $template_name, $args, $template_path, $default_path) {
    // if defult path deosnt exists, set it
    if (!$default_path) {
      global $woocommerce;
  		$default_path = $woocommerce->plugin_path() . '/templates/';
  	}

    $plugin_path = MINICART_POPUP_PATH.'woocommerce/'.$template_name;
    
    // if the file exists in current plugin, set located to that
    if(@file_exists($plugin_path)) {
      $located = $plugin_path;
    } elseif(@file_exists($located) && !@file_exists($plugin_path)) {
      $located = $located;
    } elseif(!@file_exists($located) && !@file_exists($plugin_path) && @file_exists($default_path)) {
      $located = $default_path;
    }

    return $located;
  }

}