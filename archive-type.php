<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_frontpage_setup' );

function tbr_frontpage_setup() {

  // beans_remove_attribute( 'beans_body', 'class' );
  // beans_add_attribute( 'beans_body', 'class', 'tm-home' );
  // beans_remove_markup( 'beans_main_grid' );
  // beans_remove_markup( 'beans_primary' );

}


// Load Beans
beans_load_document();