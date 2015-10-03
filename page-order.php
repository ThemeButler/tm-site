<?php

// Enqueue order form assets
// add_action( 'wp_enqueue_scripts', 'tbr_enqueue_order_form_assets', 5 );
//
// function tbr_enqueue_order_form_assets() {
//
//   wp_register_style('ad_manager_css', '/wp-content/themes/tbr/assets/css/ad-manager.css');
//   wp_enqueue_style('ad_manager_css');
//   wp_register_script('ad_manager_js', '/wp-content/plugins/bsa-pro-scripteo/frontend/js/script.js', array('jquery'));
//   wp_enqueue_script('ad_manager_js');
//
// }
//add_action('wp_enqueue_scripts', 'BSA_PRO_add_custom_stylesheet');
//add_action('wp_enqueue_scripts', 'BSA_PRO_add_stylesheet_and_script');

// Setup the contact page
add_action( 'beans_before_load_document', 'tbr_order_setup' );

function tbr_order_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-order' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );

}


// Load Beans
beans_load_document();
