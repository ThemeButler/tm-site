<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog' );
  beans_remove_action( 'beans_post_meta' );
  beans_remove_action( 'beans_post_meta_categories' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );
  beans_remove_attribute( 'beans_comments', 'class', ' uk-panel-box' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_blog_single' );

function tbr_enque_uikit_blog_single() {

  beans_uikit_enqueue_components( array( 'subnav', 'comment', 'badge' ) );

}


// Set the default layout to content only.
beans_add_filter( 'beans_layout', 'c_sp' );

// Load Beans
beans_load_document();