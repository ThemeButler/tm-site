<?php

// Register taxonomies
require_once( get_stylesheet_directory() . '/admin/taxonomy.php' );


// Register portfolio post type
add_action( 'init', 'tbr_theme_post_type' );

function tbr_theme_post_type() {

    $args = array(
      'public' => true,
      'supports' => array( 'title', 'excerpt', 'thumbnail' ),
      'menu_icon' => 'dashicons-align-left',
      'label'  => 'Themes',
      'rewrite' => array(
        'with_front'=> true
      )
    );
    register_post_type( 'themes', $args );

}


// Register portfolio meta
add_action( 'admin_init', 'tbr_theme_post_meta' );

function tbr_theme_post_meta() {

  $fields = array(
    array(
      'id' => 'version',
      'label' => 'Version',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'release_date',
      'label' => 'Release date',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'release_notes',
      'label' => 'Release notes',
      'type' => 'textarea',
      'default' => ''
    )
  );
  beans_register_post_meta( $fields, array( 'themes' ), 'beans', array( 'title' => 'Theme Info' ) );

}


// Register partners meta
add_action( 'admin_init', 'tbr_designers_meta' );

function tbr_designers_meta() {

  $option = array(
    array(
      'id' => 'designer_url',
      'label' => 'Website',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'designer_location',
      'label' => 'Location',
      'type' => 'text',
      'default' => ''
    ),
    array(
      'id' => 'designer_image',
      'label' => 'Photo',
      'type' => 'image',
      'default' => '',
      'multiple' => false
    )
  );

  beans_register_term_meta( $option, array( 'designers' ), 'beans' );

}