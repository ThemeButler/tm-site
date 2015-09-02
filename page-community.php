<?php

// Setup the about page
add_action( 'beans_before_load_document', 'tbr_community_setup' );

function tbr_community_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-community' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_post' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_markup( 'beans_post_primary' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_content' );
  beans_remove_action( 'beans_post_title' );


}


// Load Beans
beans_load_document();