<?php
function custom_minicart_popup() {
  
  $context = Timber::context();
  
  Timber::render('minicart-popup.twig', $context);
}