<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog tm-post' );
  beans_remove_action( 'beans_post_meta' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article uk-panel uk-panel-box uk-panel-box-secondary' );
  beans_remove_attribute( 'beans_comments', 'class', ' uk-panel-box' );
  beans_add_attribute( 'beans_widget_content_recent-posts', 'class', 'tm-list-style1' );
  beans_add_attribute( 'beans_widget_content_categories', 'class', 'tm-list-style1' );
  beans_replace_attribute( 'beans_post_meta_tags', 'class', 'uk-text-muted', 'tm-tags uk-margin-medium-top uk-display-block' );
  beans_modify_action_hook( 'beans_post_meta_date', 'beans_post_header_prepend_markup' );
  beans_modify_action_hook( 'beans_post_meta_categories', 'beans_post_header_prepend_markup' );
  beans_replace_attribute( 'beans_post_meta_categories', 'class', 'uk-text-small uk-text-muted uk-clearfix', 'tm-topic uk-button uk-button-tertiary uk-button-mini' );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-small-top' );
  beans_remove_markup( 'beans_post_body' );
  beans_add_attribute( 'beans_next_link_post_navigation', 'class', 'uk-text-right uk-h3' );
  beans_add_attribute( 'beans_previous_link_post_navigation', 'class', 'uk-text-left uk-h3' );
  beans_add_attribute( 'beans_embed_oembed', 'class', 'tm-cover-article' );
  beans_modify_markup( 'beans_no_comment', 'h3' );
  beans_add_attribute( 'beans_comment_form_legend', 'class', 'uk-hidden' );
  beans_add_attribute( 'beans_comment_form_field_name', 'placeholder', 'Name' );
  beans_add_attribute( 'beans_comment_form_field_email', 'placeholder', 'Email' );
  beans_add_attribute( 'beans_comment_form_field_url', 'placeholder', 'Website' );
  beans_add_attribute( 'beans_comment_form_field_comment', 'autofocus', '' );
  beans_add_attribute( 'beans_comment_form_wrap', 'class', 'uk-panel-box' );
  beans_replace_attribute( 'beans_primary', 'class', 'uk-width-medium-3-4', 'uk-width-medium-2-3' );
  beans_replace_attribute( 'beans_sidebar_primary', 'class', 'uk-width-medium-1-4', 'uk-width-medium-1-3' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_blog_single' );

function tbr_enque_uikit_blog_single() {

  beans_uikit_enqueue_components( array( 'animation', 'subnav', 'comment', 'badge', 'list', 'article', 'pagination', 'modal', 'icon', 'overlay', 'close' ) );
  beans_uikit_enqueue_components( array( 'lightbox', 'slidenav' ), 'add-ons' );

}


// Add the bottom newsletter signup
add_action( 'beans_post_append_markup', 'tbr_subscribe_to_blog' );

function tbr_subscribe_to_blog() { ?>
    <div id="mc_embed_signup" class="tm-blog-signup">
        <h3>Subscribe to the blog:</h3>
        <form action="//themebutler.us7.list-manage.com/subscribe/post?u=bdf3d2258eff9f6988b1e329f&amp;id=63b510af57" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate tm-flex-form uk-position-relative" target="_blank" novalidate>
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bdf3d2258eff9f6988b1e329f_63b510af57" tabindex="-1" value=""></div>
            <input type="email" value="" name="EMAIL" class="required email uk-border-rounded" id="mce-EMAIL" placeholder="Enter a valid email address">
            <button name="subscribe" id="mc-embedded-subscribe" class="uk-button uk-button-secondary">Subscribe</button>
        </form>
    </div>
<?php }


// Remove categories prefix
add_action( 'beans_post_meta_tags_prefix_output', 'tbr_tags_prefix' );

function tbr_tags_prefix() {

  return;

}


// Remove categories prefix
add_action( 'beans_moderator_text_output', 'tbr_moderator_badge' );

function tbr_moderator_badge() {

  return 'Head Butler';

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
