<?php

// Setup the contact page
add_action( 'beans_before_load_document', 'tbr_contact_setup' );

function tbr_contact_setup() {

  beans_remove_action( 'beans_post_title' );
  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-contact' );
  beans_remove_markup( 'beans_main_grid' );

}


// Include contact form
function tbr_contact_form() {

  include( get_stylesheet_directory() . '/inc/contact-form.php' );

}


// Output contact form
beans_modify_action_callback( 'beans_loop_template', 'tbr_view_content' );

function tbr_view_content() {

  tbr_contact_form();

}


// Load Beans
beans_load_document();
