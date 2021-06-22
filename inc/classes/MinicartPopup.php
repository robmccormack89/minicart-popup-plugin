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
    
    add_action('plugins_loaded', array($this, 'on_plugins_loaded'));
    add_action('rmcc_after_header', 'custom_minicart_popup', 10);
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
    $context['plugin_url'] = MINICART_POPUP_URL;
    return $context;    
  }
  
  public function on_plugins_loaded() {
    // allow plugin's woo templates to override theme's
    add_filter('wc_get_template', array($this, 'wc_get_template'), 10, 5); 
  }
  
  public function wc_get_template($located, $template_name, $args, $template_path, $default_path) {

    if (!$default_path) {
      global $woocommerce;
  		$default_path = $woocommerce->plugin_path() . '/templates/';
  	}
    
    $plugin_path = MINICART_POPUP_PATH.'woocommerce/' . $template_name;
    
    $woo_path = $default_path . $template_name;
    
    $theme_path = get_stylesheet_directory() . '/woocommerce/' . $template_name;
    
    if(@file_exists($theme_path) && @file_exists($plugin_path)){
      $located = $plugin_path;
    } elseif(@file_exists($theme_path) && !@file_exists($plugin_path)) {
      $located = $theme_path;
    } elseif(@file_exists($plugin_path) && !@file_exists($theme_path)) {
      $located = $plugin_path;
    } else {
      $located = $woo_path;
    }
    
    return $located;
    
  }

}