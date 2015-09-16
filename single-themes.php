<?php

// Setup the portfolio single layout
add_action( 'beans_before_load_document', 'tbr_modify_theme_single_markup' );

function tbr_modify_theme_single_markup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-theme' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_fixed_wrap_main' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_post' );
  beans_remove_attribute( 'beans_post', 'id' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_modify_action_hook( 'beans_post_title', 'beans_primary_menu_after_markup' );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-text-center uk-margin-large-top' );
  beans_remove_action( 'beans_post_image' );
  beans_add_attribute( 'beans_header', 'class', 'uk-padding-bottom-remove' );
  beans_remove_attribute( 'beans_main', 'class', ' uk-block-large' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_theme_single' );

function tbr_enque_uikit_theme_single() {

  beans_uikit_enqueue_components( array( 'animation', 'contrast', 'close', 'subnav', 'icon', 'switcher', 'modal' ) );

}


// Add the excerpt
add_action( "beans_post_title_after_markup", "tbr_theme_intro" );

function tbr_theme_intro( $excerpt ) {

  global $post;

  $title = get_the_title($post->ID);
  $lowercase_title = strtolower($title);
  $release_date = get_post_meta( $post->ID, 'release_date', true );
  $version = get_post_meta( $post->ID, 'version', true );
  $demo_url = 'http://demo.themebutler.com/?name=' . $lowercase_title;
  $download_url = '/wp-content/downloads/tm-' . $lowercase_title . '-v'. $version . '.zip';
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
  $resized_src = beans_edit_image( $thumb_url_array[0], array(
    'resize' => array( 904, false )
  ) );

  ?>

  <p class="uk-article-lead uk-text-center"><?php echo the_excerpt(); ?></p>
  <div class="uk-text-center">
    <a href="<?php echo $download_url; ?>" class="uk-button uk-button-large uk-button-primary uk-margin-right" target="_blank" onclick="javascript:_paq.push(['trackEvent', 'Theme', 'Download' '<?php echo $title; ?>']);">Download for <strong>Free</strong>!</a>
    <a href="<?php echo $demo_url; ?>" class="uk-button uk-button-tertiary uk-button-large" target="_blank" onclick="javascript:_paq.push(['trackEvent', 'Theme', 'Demo' '<?php echo $title; ?>']);">View the demo</a>
    <div class="tm-post-nav uk-grid uk-grid-small uk-grid-width-1-2 uk-position-relative">
      <div class="tm-prev uk-text-left">
        <?php
          $prev_post = get_previous_post();
          if($prev_post) {
             $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
             echo '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class="uk-icon-button uk-icon-hand-o-left uk-animation-hover uk-animation-fade"></a>';
          }
        ?>
      </div>
      <div class="tm-next uk-text-right">
        <?
          $next_post = get_next_post();
          if($next_post) {
             $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
             echo '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class="uk-icon-button uk-icon-hand-o-right uk-animation-hover uk-animation-fade"></a>';
          }
        ?>
      </div>
    </div>
    <div class="browser-container">
      <div class="browser">
        <div class="browser__top">
          <div class="browser__button"></div>
          <div class="browser__button"></div>
          <div class="browser__button"></div>
        </div>
        <img class="browser__img" src="<?php echo $resized_src; ?>" width="1180" height="400" alt="" />
      </div>
    </div>
  </div>
<? }


// Add the theme summary
add_action( 'beans_main_prepend_markup', 'tbr_add_theme_top' );

function tbr_add_theme_top() {

  global $post;

  $title = get_the_title($post->ID);
  $lowercase_title = strtolower($title);
  $version = get_post_meta( $post->ID, 'version', true );
  $release_date = get_post_meta( $post->ID, 'release_date', true );
  $release_notes = get_post_meta( $post->ID, 'release_notes', true );
  $designers = get_terms("designers");
  $designers_count = count($designers);
  $terms = get_the_terms($post->ID, 'theme_type');
  $terms_as_text = strip_tags( get_the_term_list( $post->ID, 'theme_type', '', ', ', '' ) );

  require_once( get_stylesheet_directory() . '/inc/theme-top.php' );

}


// Add the tabs to the theme single layout
add_action( 'beans_post_prepend_markup', 'tbr_add_theme_tabs' );

function tbr_add_theme_tabs() {

  global $post;

  $title = get_the_title($post->ID);
  $lowercase_title = strtolower($title);
  $version = get_post_meta( $post->ID, 'version', true );
  $download_parent = '/wp-content/downloads/tm-' . $lowercase_title . '-v'. $version . '.zip';
  $download_child = '/wp-content/downloads/tm-' . $lowercase_title . '-child.zip';
  $download_sketch = '/wp-content/downloads/' . $lowercase_title . '-source.zip';

  require_once( get_stylesheet_directory() . '/inc/theme-menu.php' );
  require_once( get_stylesheet_directory() . '/inc/theme-content.php' );

}

// Load Beans
beans_load_document();
