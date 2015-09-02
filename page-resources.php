<?php

// Setup the about page
add_action( 'beans_before_load_document', 'tbr_page_setup' );

function tbr_page_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-resources' );
  beans_remove_markup( 'beans_post_body');
  beans_remove_markup( 'beans_post_content');
  beans_remove_markup( 'beans_main_grid');
  beans_remove_markup( 'beans_post');
  beans_remove_markup( 'beans_post_header');
  beans_remove_attribute( 'beans_primary', 'class', ' uk-width-medium-4-4' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );
  beans_remove_action( 'beans_post_title' );
  beans_wrap_markup( 'tuxedo_post_image', 'themebutler_post_image', 'a', array( 'href' => get_permalink() ) );

}


// Load Beans
beans_load_document();