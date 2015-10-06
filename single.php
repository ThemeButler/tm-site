<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog tm-post' );
  beans_remove_action( 'beans_post_meta' );
  //beans_remove_action( 'beans_post_meta_categories' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article uk-panel uk-panel-box uk-panel-box-secondary' );
  beans_add_attribute( 'beans_comments', 'class', ' uk-panel-box-primary' );
  beans_add_attribute( 'beans_widget_content_recent-posts', 'class', 'tm-list-style1' );
  beans_add_attribute( 'beans_widget_content_categories', 'class', 'tm-list-style1' );
  beans_replace_attribute( 'beans_post_meta_tags', 'class', 'uk-text-muted', 'tm-tags uk-margin-large-top uk-display-block' );
  beans_modify_action_hook( 'beans_post_meta_date', 'beans_post_header_prepend_markup' );
  beans_modify_action_hook( 'beans_post_meta_categories', 'beans_post_header_prepend_markup' );
  beans_replace_attribute( 'beans_post_meta_categories', 'class', 'uk-text-small uk-text-muted uk-clearfix', 'tm-topic uk-button uk-button-tertiary uk-button-mini' );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-small-top' );
  beans_remove_markup( 'beans_post_body' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_blog_single' );

function tbr_enque_uikit_blog_single() {

  beans_uikit_enqueue_components( array( 'subnav', 'comment', 'badge', 'list', 'article', 'pagination' ) );

}


// Remove categories prefix
add_action( 'beans_post_meta_tags_prefix_output', 'tbr_tags_prefix' );

function tbr_tags_prefix() {

  return;

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

// Modify the "Previous" post navigation text.
add_filter( 'beans_previous_text_post_navigation_output', 'beans_child_previous_text_post_navigation' );

function beans_child_previous_text_post_navigation() {

	if ( $post = get_previous_post() )
		$text = $post->post_title;

	return '<strong class="uk-display-block">Previous post </strong>' . $text;

}

// Modify the "Next" post navigation text.
add_filter( 'beans_next_text_post_navigation_output', 'beans_child_next_text_post_navigation' );

function beans_child_next_text_post_navigation( $text ) {

	if ( $post = get_next_post() )
		$text = $post->post_title;

        return '<strong class="uk-display-block">Next post </strong>' . $text;

}


// Set the default layout to content only.
beans_add_filter( 'beans_layout', 'c_sp' );


// Load Beans
beans_load_document();
