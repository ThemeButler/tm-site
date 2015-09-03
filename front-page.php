<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_frontpage_setup' );

function tbr_frontpage_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-home' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_primary' );

}

// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_page' );

function tbr_enque_uikit_page() {

  beans_uikit_enqueue_components( array( 'overlay' ) );

}

// Add the bottom widget area
add_action( 'beans_fixed_wrap_header_append_markup', 'tbr_welcome' );

function tbr_welcome() { ?>

  <div class="tm-welcome uk-block uk-contrast uk-margin-large-top uk-float-left uk-width-1-1">
    <h1 class="uk-article-title uk-text-center">Premium WordPress Goodies - <strong>For Free!</strong></h1>
    <p class="uk-margin-remove uk-h3 uk-text-center">An experiment in ad-supported themes. <a href="/blog/never-say-die/">Learn more</a></p>
  </div>

<? }


// Modify the loop output
beans_modify_action_callback( 'beans_loop_template', 'tbr_home_themes_loop' );

function tbr_home_themes_loop( $query ) {

  $the_query = new WP_Query( array( 'post_type' => 'themes', 'posts_per_page' => '12', 'no_found_rows' => true ) ); ?>

  <div class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2" >
    <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

    global $post;

    $title = get_the_title($post->ID);
    $lowercase_title = strtolower($title);
    $version = get_post_meta( $post->ID, 'version', true );
    $demo_url = get_post_meta( $post->ID, 'demo_url', true );
    $download_url = '/wp-content/downloads/tm-' . $lowercase_title . '-v'. $version . '.zip';
    $demo_url = get_post_meta( $post->ID, 'demo_url', true );
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
    $resized_src = beans_edit_image( $thumb_url_array[0], array(
    'resize' => array( 0, 0, 530, 200, true )
    ) );

    ?>
    <div class="tm-item uk-margin-large-bottom">
      <div class="uk-panel-box-secondary uk-border-rounded uk-text-center">
        <h2 class="uk-margin-bottom"><?php echo the_title(); ?></h2>
        <p class="uk-article-lead uk-text-center"><?php echo the_excerpt(); ?></p>
        <div class="browser-container uk-margin-top">
          <div class="browser">
            <div class="browser__top">
              <div class="browser__button"></div>
              <div class="browser__button"></div>
              <div class="browser__button"></div>
            </div>
            <figure class="browser__img uk-overlay uk-overlay-hover uk-padding-top-remove uk-padding-bottom-remove">
                <img src="<?php echo $resized_src; ?>" class="uk-overlay-scale" width="490" alt="<?php echo the_title(); ?>" />
                <figcaption class="uk-panel uk-panel-box uk-uk-padding-bottom-remove uk-overlay-panel uk-overlay-background">
                  <a href="<?php echo get_permalink(); ?>" class="uk-button uk-button-large uk-display-block uk-margin-bottom">Learn more</a>
                  <a href="<?php echo $demo_url; ?>" class="uk-button uk-button-large uk-display-block uk-margin-bottom uk-button-tertiary" target="_blank" onclick="javascript:_paq.push(['trackEvent', 'Theme', 'Demo' '<?php echo $title; ?>']);">View a demo</a>
                  <a href="<?php echo $download_url; ?>" class="uk-button uk-button-large uk-display-block uk-button-primary" onclick="javascript:_paq.push(['trackEvent', 'Theme', 'Download' '<?php echo $title; ?>']);">Download v<?php echo $version; ?></a>
                </figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; else: ?>
      <div>Sorry, there are no posts to display</div>
    <?php endif; ?>
    </div>
  <?php

  wp_reset_query();

}


// Load Beans
beans_load_document();