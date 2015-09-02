<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog' );
  beans_remove_action( 'beans_post_meta' );
  beans_remove_action( 'beans_post_meta_categories' );
  beans_remove_action( 'beans_post_meta_tags' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );

}

// Set the default layout to content only.
beans_add_filter( 'beans_layout', 'c_sp' );

// Load Beans
beans_load_document();