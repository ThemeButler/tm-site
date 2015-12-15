<?php

// Setup the portfolio single layout
add_action( 'beans_before_load_document', 'tbr_modify_theme_single_markup' );

function tbr_modify_theme_single_markup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-theme' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_action( 'beans_post_image' );
  beans_remove_action( 'beans_post_title' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_markup( 'beans_post_content' );
  beans_replace_attribute( 'beans_post', 'class', 'uk-panel-box', 'tm-theme-single uk-article' );

}

// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_theme_single' );

function tbr_enque_uikit_theme_single() {

  beans_uikit_enqueue_components( array( 'article', 'overlay' ) );
  //beans_uikit_enqueue_components( array( 'tooltip' ), 'add-ons' );

}

// Add the excerpt
add_action( "beans_post_prepend_markup", "tbr_theme_intro" );

function tbr_theme_intro( $excerpt ) {

  global $post;

  $title = get_the_title($post->ID);
  $lowercase_title = strtolower($title);
  $version = get_post_meta( $post->ID, 'version', true );
  $download_child = '/wp-content/downloads/tbr-' . $lowercase_title . '.zip?no_cache=1';
  $download_sketch = '/wp-content/downloads/' . $lowercase_title . '-source.zip?no_cache=1';
  $release_date = get_post_meta( $post->ID, 'release_date', true );
  $terms = get_the_terms($post->ID, 'theme_type');
  $terms_as_text = strip_tags( get_the_term_list( $post->ID, 'resource_type', '', ', ', '' ) );
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
  $resized_src = beans_edit_image( $thumb_url_array[0], array(
    'resize' => array( 750, false )
  ) );

  ?>
  <div class="uk-grid">
    <div class="tm-image uk-width-small-1-1 uk-width-medium-3-5 uk-margin-large-bottom">
      <figure class="uk-thumbnail">
        <img src="<?php echo $resized_src; ?>" width="750" alt="<?php echo $title; ?> Child-Theme for the Beans WordPress Theme" />
      </figure>
    </div>
    <div class="tm-theme-info uk-width-small-1-1 uk-width-medium-2-5">
        <header class="tm-theme-top uk-clearfix uk-float-left">
            <h1 class="uk-margin-remove-top uk-h2"><?php echo $title; ?></h1>
            <p class="uk-article-lead"><?php echo the_excerpt(); ?></p>
        </header>
      <div class="tm-downloads">
          <a class="uk-button uk-button-primary uk-margin-right" href="<?php echo $download_child; ?>" onclick="javascript:_paq.push(['trackEvent', 'Child Theme', 'Download' '<?php echo $title; ?>']);" title="Download tbr-<?php echo $lowercase_title . '-child.zip'; ?>" data-uk-tooltip="{pos:'bottom-left'}">Download</a>
          <a class="tm-text-medium tm-github uk-button uk-margin-right" title="View the <?php echo $title; ?> WordPress theme code on GitHub" href="https://github.com/ThemeButler/tbr-<?php echo $lowercase_title; ?>" target="_blank" data-uk-tooltip="{pos:'bottom-left'}"><i class="uk-icon-github uk-icon-small uk-margin-small-right"></i>View on GitHub</a>
          <?php echo get_simple_likes_button( get_the_ID() ); ?>
      </div>
      <ul class="tm-summary uk-list uk-margin-left-remove uk-clearfix">
        <li>Type: <span><?php echo $terms_as_text; ?></span></li>
        <li>Released: <span><?php the_date('d/m/Y'); ?></span></li>
        <li>Requirements: <span>WordPress 4.0+</span></li>
      </ul>

  </div>
<? }

// Load Beans
beans_load_document();
