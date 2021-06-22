<?php
function custom_minicart_popup() {
  
  // if timber::locations is empty (another plugin hasn't already added to it), make it an array
  if(!Timber::$locations) Timber::$locations = array();

  // add a new views path to the locations array
  array_push(
    Timber::$locations, 
    MINICART_POPUP_PATH . 'views'
  );
  
  $context = Timber::context();
  
  Timber::render('minicart-popup.twig', $context);
}