<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.3.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * custom mini-cart template rendered with timber/twig. 
 * this template overwrites woocommerce/templates/cart/mini-cart.php
 *
**/

// if timber::locations is empty (another plugin hasn't already added to it), make it an array
if(!Timber::$locations) Timber::$locations = array();

// add a new views path to the locations array
array_push(
  Timber::$locations, 
  MINICART_POPUP_PATH . 'views'
);

$context = Timber::context();

// get the cart object
$context['cart'] = WC()->cart;

Timber::render('minicart.twig', $context);