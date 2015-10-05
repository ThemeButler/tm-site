<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog tm-post' );
  beans_remove_action( 'beans_post_meta' );
  beans_remove_action( 'beans_post_meta_categories' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article uk-panel uk-panel-box uk-panel-box-secondary' );
  beans_add_attribute( 'beans_comments', 'class', ' uk-panel-box-primary' );
  beans_add_attribute( 'beans_widget_content_recent-posts', 'class', 'tm-list-style1' );
  beans_add_attribute( 'beans_widget_content_categories', 'class', 'tm-list-style1' );
  beans_add_attribute( 'beans_post_meta_tags', 'class', 'tm-tags uk-margin-large-top uk-display-block' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_blog_single' );

function tbr_enque_uikit_blog_single() {

  beans_uikit_enqueue_components( array( 'subnav', 'comment', 'badge', 'list', 'article', 'pagination' ) );

}


// Set the default layout to content only.
beans_add_filter( 'beans_layout', 'c_sp' );



add_action( 'tuxedo_post_body', 'tbr_excerpt', 9 );
​
function canva_child_excerpt() {
​
	// Stop here if excerpt is empty.
	if ( !has_excerpt() )
		return;
​
	echo '<div class="uk-article-lead">';
}

// Load Beans
beans_load_document();
