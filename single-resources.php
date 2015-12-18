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
  $github_slug = get_post_meta( $post->ID, 'github_slug', true );
  $download_name = get_post_meta( $post->ID, 'download_name', true );
  $download_path = '/wp-content/downloads/' . $download_name . '?no_cache=1';
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
          <a class="uk-button uk-button-primary uk-margin-right" href="<?php echo $download_path; ?>" onclick="javascript:_paq.push(['trackEvent', 'Resource', 'Download' '<?php echo $title; ?>']);" title="Download <?php echo $title; ?>" data-uk-tooltip="{pos:'bottom-left'}">Download</a>
          <?php if ( $github_slug != '' ) : ?>
              <a class="tm-text-medium tm-github uk-button uk-margin-right" title="View the <?php echo $title; ?> code on GitHub" href="https://github.com/ThemeButler/<?php echo $github_slug; ?>" target="_blank" data-uk-tooltip="{pos:'bottom-left'}"><i class="uk-icon-github uk-icon-small uk-margin-small-right"></i>View on GitHub</a>
          <?php endif; ?>
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
