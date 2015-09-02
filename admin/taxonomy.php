<?php

// Register theme type taxonomy
add_action( 'init', 'tbr_theme_type_taxonomy' );

function tbr_theme_type_taxonomy() {
  register_taxonomy(
    'theme_type',
    'themes',
    array(
      'label' => 'Types',
      'rewrite' => array( 'slug' => 'type' ),
      'hierarchical' => true,
    )
  );
}


// Register designers taxonomy
add_action( 'init', 'tbr_designers_taxonomy' );

function tbr_designers_taxonomy() {
  register_taxonomy(
    'designers',
    'themes',
    array(
      'label' => 'Designers',
      'rewrite' => array( 'slug' => 'designer' ),
      'hierarchical' => false,
    )
  );
}


// Register tags taxonomy
add_action( 'init', 'tbr_theme_tags_taxonomy' );

function tbr_theme_tags_taxonomy() {
  register_taxonomy(
    'theme_tags',
    'themes',
    array(
      'label' => 'Tags',
      'rewrite' => array( 'slug' => 'tag' ),
      'hierarchical' => false,
    )
  );
}