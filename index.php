<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog' );
  beans_remove_action( 'beans_post_meta' );
  beans_remove_action( 'beans_post_meta_tags' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );
  beans_modify_action( 'beans_post_meta_date', 'tm-item-inner_prepend_markup' );
  beans_modify_action( 'beans_post_meta_categories', 'tm_item_inner_prepend_markup', null, 7 );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_content' );
  beans_remove_markup( 'beans_post_title_link' );
  beans_replace_attribute( 'beans_post', 'class', 'uk-article', 'tm-item"' );
  beans_add_attribute( 'beans_main_grid', 'class', 'uk-grid-width-small-1-1 uk-grid-width-medium-1-4' );
  beans_add_attribute( 'beans_main_grid', 'data-uk-grid-match', "{target:'.uk-panel'}" );
  beans_modify_markup( 'beans_post', 'div' );
  beans_wrap_inner_markup( 'beans_post', 'tm_item_inner', 'div', array( 'class' => 'uk-panel uk-panel-box uk-panel-box-secondary' ) );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-small-top' );
  beans_add_attribute( 'beans_post_more_link', 'class', 'uk-button uk-button-primary' );
  beans_replace_attribute( 'beans_next_icon_more_link', 'class', 'uk-icon-angle-double-right', 'uk-icon-arrow-circle-o-right' );
  beans_replace_attribute( 'beans_post_meta_categories', 'class', 'uk-text-small uk-text-muted uk-clearfix', 'tm-topic uk-button uk-button-tertiary uk-button-mini' );
  beans_add_attribute( 'beans_widget_content_sidebar_primary_recent-posts', 'class', 'tm-list-style1' );
  beans_add_attribute( 'beans_widget_content_categories', 'class', 'tm-list-style1' );

}

// Add the post date
add_action( 'beans_post_meta_categories_after_markup', 'tbr_post_date' );

function tbr_post_date() {

  return the_date('d M, Y', '<span class="uk-text-muted uk-text-small uk-margin-left">', '</span>');

}

// Remove categories prefix
add_action( 'beans_post_meta_categories_prefix_output', 'tbr_categories_prefix' );

function tbr_categories_prefix() {

  return;

}

// Load Beans
beans_load_document();
