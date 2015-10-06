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
  //$download_parent = 'https://github.com/ThemeButler/tm-' . $lowercase_title . '/releases/download/'. $version . '/tm-' . $lowercase_title . '-v'. $version . '.zip?no_cache=1';
  $download_child = '/wp-content/downloads/tbr-' . $lowercase_title . '.zip?no_cache=1';
  $download_sketch = '/wp-content/downloads/' . $lowercase_title . '-source.zip?no_cache=1';
  $release_date = get_post_meta( $post->ID, 'release_date', true );
  $demo_url = 'http://demo.themebutler.com/' . $lowercase_title . '/';
  $terms = get_the_terms($post->ID, 'theme_type');
  $terms_as_text = strip_tags( get_the_term_list( $post->ID, 'theme_type', '', ', ', '' ) );
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
  $resized_src = beans_edit_image( $thumb_url_array[0], array(
    'resize' => array( 750, false )
  ) );

  ?>
  <div class="uk-grid">
    <div class="tm-image uk-width-small-1-1 uk-width-medium-3-5 uk-margin-large-bottom">
      <figure class="uk-overlay uk-overlay-hover uk-thumbnail">
        <img src="<?php echo $resized_src; ?>" width="750" alt="<?php echo $title; ?> Child-Theme for the Beans WordPress Theme" />
        <figcaption class="uk-overlay-panel uk-flex uk-flex-center uk-flex-middle uk-text-center uk-overlay-background uk-overlay-fade"><span class="uk-button uk-button-large">View Demo</span></figcaption>
        <a href="<?php echo $demo_url; ?>" class="uk-position-cover" target="_blank"></a>
      </figure>
    </div>
    <div class="tm-theme-info uk-width-small-1-1 uk-width-medium-2-5">
      <header class="tm-theme-top uk-clearfix">
        <h1 class="uk-margin-remove-top uk-float-left"><?php echo $title; ?></h1>
        <div class="tm-theme-nav uk-float-right">
          <a href="<?php echo $demo_url; ?>" class="uk-button uk-button-primary uk-float-right uk-margin-left tm-demo-link" target="_blank">View Demo</a>
          <div class="tm-post-nav uk-float-right">
            <div class="tm-prev uk-float-left uk-text-left">
              <?php
                $prev_post = get_previous_post();
                if($prev_post) {
                   $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                   echo '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class="uk-button">&#9756;</a>';
                }
              ?>
            </div>
            <div class="tm-next uk-float-right uk-text-right">
              <?
                $next_post = get_next_post();
                if($next_post) {
                   $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                   echo '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class="uk-button uk-margin-small-left">&#9758;</a>';
                }
              ?>
            </div>
          </div>
        </div>
      </header>
      <p class="uk-article-lead"><?php echo the_excerpt(); ?></p>
      <ul class="tm-summary uk-list uk-margin-left-remove uk-clearfix">
        <li>Type: <span><?php echo $terms_as_text; ?></span></li>
        <li>Released: <span><?php echo $release_date; ?></span></li>
        <li>Requirements: <span>WordPress 4.0+</span></li>
      </ul>
      <div class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2">
        <div class="tm-resources">
          <h3 class="uk-margin-top-remove tm-list-style1">Resources</h3>
          <ul class="uk-list tm-list-style1">
            <li><a href="/features/">General Theme Features</a></li>
            <li><a href="/docs/theme-setup-guide">General Setup Guide</a></li>
            <li><a href="/topic/tutorials/">Beans Tutorials</a></li>
            <li><a href="http://www.getbeans.io/documentation/">Beans Documentation <i class="uk-icon-external-link uk-text-small uk-margin-small-left"></i></a></li>
            <li><a href="http://www.getbeans.io/code-snippets/" target="_blank">Useful Code Snippets <i class="uk-icon-external-link uk-text-small uk-margin-small-left"></i></a></li>
          </ul>
        </div>
        <div class="tm-downloads">
            <h3 class="uk-margin-top-remove uk-margin-small-bottom">Downloads</h3>
            <ul class="uk-list uk-margin-small-top">
              <li><a href="<?php echo $download_child; ?>" onclick="javascript:_paq.push(['trackEvent', 'Child Theme', 'Download' '<?php echo $title; ?>']);" title="Download tbr-<?php echo $lowercase_title . '-child.zip'; ?>" data-uk-tooltip="{pos:'bottom-left'}"><?php echo $title; ?> Child-Theme</a></li>
              <li class="tm-divider"><a href="<?php echo $download_sketch; ?>" onclick="javascript:_paq.push(['trackEvent', 'Sketch Source', 'Download' '<?php echo $title; ?>']);" data-uk-tooltip="{pos:'bottom-left'}" title="Download <?php echo $lowercase_title . '-sketch.zip'; ?>"><?php echo $title; ?> Sketch Source</a></li>
              <li class="uk-margin-top"><a class="tm-text-medium tm-github uk-button" title="View the <?php echo $title; ?> WordPress theme code on GitHub" href="https://github.com/ThemeButler/tbr-<?php echo $lowercase_title; ?>" target="_blank" data-uk-tooltip="{pos:'bottom-left'}"><i class="uk-icon-github uk-icon-small uk-margin-small-right"></i>View on GitHub</a></li>
            </ul>
        </div>
      </div>
      <div class="tm-support">
        <h3 class="uk-margin-top-remove">Support</h3>
        <p>Since all our child-themes are free, support is not provided. There is a community forum and paid help available from Codeable.</p>
        <p class="tm-buttons-wrap"><a href="http://community.themebutler.com/t/<?php echo $lowercase_title; ?>" class="uk-margin-right uk-button uk-button-secondary" target="_blank">Post on the Community Forum <i class="uk-icon-external-link uk-text-small"></i></a> or
          <a href="https://api.referoo.co/s/0gFdE" class="uk-margin-left uk-button uk-button-secondary" target="_blank">Get expert help on <span>Codeable</span> <i class="uk-icon-external-link uk-text-small"></i></a></p>
      </div>
    </div>
  </div>
<? }

// Load Beans
beans_load_document();
