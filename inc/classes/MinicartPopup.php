<?php
namespace Rmcc;
use Timber\Timber;

class MinicartPopup extends Timber {

  public function __construct() {
    parent::__construct();
    add_filter('timber/twig', array($this, 'add_to_twig'));
    add_filter('timber/context', array($this, 'add_to_context'));
    
    add_action('plugins_loaded', array($this, 'plugin_timber_locations'));
    add_action('plugins_loaded', array($this, 'plugin_text_domain_init')); 
    add_action('wp_enqueue_scripts', array($this, 'plugin_enqueue_assets'));
    
    add_filter('wc_get_template', array($this, 'wc_get_template'), 10, 5); 
    
    add_action('rmcc_after_header', 'custom_minicart_popup', 10);
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
  
  public function plugin_timber_locations() {
    // if timber::locations is empty (another plugin hasn't already added to it), make it an array
    if(!Timber::$locations) Timber::$locations = array();
    // add a new views path to the locations array
    array_push(
      Timber::$locations, 
      MINICART_POPUP_PATH . 'views'
    );
  }
  public function plugin_text_domain_init() {
    load_plugin_textdomain('minicart-popup', false, MINICART_POPUP_BASE. '/languages');
  }
  public function plugin_enqueue_assets() {
    wp_enqueue_style(
      'minicart-popup',
      MINICART_POPUP_URL . 'public/css/minicart-popup.css'
    );
    
    // enqueue wp jquery
    wp_enqueue_script('jquery');
    
    // minicart-popup scripts; uses jquery
    wp_enqueue_script(
      'minicart-popup',
      MINICART_POPUP_URL . 'public/js/minicart-popup.js',
      'jquery',
      '1.0.0',
      true
    );
  }

  public function add_to_twig($twig) { 
    if(!class_exists('Twig_Extension_StringLoader')){
      $twig->addExtension(new Twig_Extension_StringLoader());
    }
    return $twig;
  }
  public function add_to_context($context) {
    return $context;    
  }
}