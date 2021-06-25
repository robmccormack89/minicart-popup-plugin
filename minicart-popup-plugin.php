<?php
/*
Plugin Name: Minicart Popup for Woocommerce by RMcC
Plugin URI: #
Description: A custom woocommerce minicart with a uikit popup modal. Toggle the modal via #MiniCartModal.
Version: 1.0.0
Author: robmccormack89
Author URI: #
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: minicart-popup
Domain Path: /languages/
*/

// don't run if someone access this file directly
defined('ABSPATH') || exit;

// define some constants
if (!defined('MINICART_POPUP_PATH')) define('MINICART_POPUP_PATH', plugin_dir_path( __FILE__ ));
if (!defined('MINICART_POPUP_URL')) define('MINICART_POPUP_URL', plugin_dir_url( __FILE__ ));
if (!defined('MINICART_POPUP_BASE')) define('MINICART_POPUP_BASE', dirname(plugin_basename( __FILE__ )));

// require the composer autoloader
if (file_exists($composer_autoload = __DIR__.'/vendor/autoload.php')) require_once $composer_autoload;

// then require the main plugin class. this class extends Timber/Timber which is required via composer
new Rmcc\MinicartPopup;

// require action functions 
require_once('inc/functions.php');