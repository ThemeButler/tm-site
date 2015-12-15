<?php

//Setup the about page
add_action( 'beans_before_load_document', 'tbr_page_setup' );

function tbr_page_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-about' );

}


// Adjust the grid
add_filter( 'beans_layout_grid_settings', 'tbr_modify_grid_settings' );
function tbr_modify_grid_settings( $args ) {

    return array_merge( $args, array(
        'grid' => 10,
        'sidebar_primary' => 3
    ) );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_page' );

function tbr_enque_uikit_page() {

  beans_uikit_enqueue_components( array( 'article', 'cover' ) );
  beans_uikit_enqueue_components( array( 'progress' ), 'add-ons' );

}


// Load Beans
beans_load_document();
