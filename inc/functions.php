<?php
function custom_minicart_popup() {
  $context = Timber::context();
  Timber::render('minicart-popup.twig', $context);
}

function woo_widget_shopping_cart_button_view_cart() {
  // $wp_button_class = wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '';
  // echo '<li><a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward' . esc_attr( $wp_button_class ) . '">' . esc_html__( 'View cart', 'minicart-popup' ) . '</a></li>';
  echo '<li><a href="' . esc_url( wc_get_cart_url() ) . '" class="uk-button uk-button-default uk-width-1-1 uk-text-capitalize uk-button-small">' . esc_html_x( 'View cart', 'View cart button text', 'minicart-popup' ) . '</a></li>';
}function woo_widget_shopping_cart_proceed_to_checkout() {
  // $wp_button_class = wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '';
  // echo '<li><a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward' . esc_attr( $wp_button_class ) . '">' . esc_html__( 'Checkout', 'minicart-popup' ) . '</a></li>';
  echo '<li><a href="' . esc_url( wc_get_checkout_url() ) . '" class="checkout uk-button uk-button-primary uk-width-1-1 uk-text-capitalize uk-button-small">' . esc_html_x( 'Checkout', 'Checkout button text', 'minicart-popup' ) . '</a></li>';
}