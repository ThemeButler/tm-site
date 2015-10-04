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

// Show loaded UIkit components
// add_action( 'wp_enqueue_scripts', 'dfh_print_uikit_array' );
// function dfh_print_uikit_array() {
//   global $_beans_uikit_enqueued_items;
//
//   print '<pre>';
//   print_r( $_beans_uikit_enqueued_items );
//   print '</pre>';
//
// }

// Modify the loop output
beans_modify_action_callback( 'beans_loop_template', 'tbr_home_themes_loop' );

function tbr_home_themes_loop( $query ) {

  $the_query = new WP_Query( array( 'post_type' => 'themes', 'posts_per_page' => '3', 'no_found_rows' => true ) ); ?>

  <div class="tm-home uk-text-center">
    <h2 class="uk-margin-remove-top">Looking for a child-theme for Beans?</h2>
    <p class="uk-article-lead tm-excerpt">Browse our growing collection of free child-themes for Beans. They don’t have any complicated configuration options, are heavily optimized for performance and are easy to customize. </p>
    <div class="tm-themes uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-margin-large-top" >

    <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

    global $post;

    $title = get_the_title($post->ID);
    $lowercase_title = strtolower($title);
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
    $resized_src = beans_edit_image( $thumb_url_array[0], array(
      'resize' => array( 340, 259, false )
    ) );

    ?>
      <div class="tm-item uk-margin-medium-bottom">
        <figure class="uk-overlay uk-overlay-hover">
          <img src="<?php echo $resized_src; ?>" class="uk-thumbnail" width="400">
          <figcaption class="uk-overlay-panel uk-flex uk-flex-center uk-flex-middle uk-text-center uk-overlay-background uk-overlay-fade"><?php echo the_title(); ?></figcaption>
          <a class="uk-position-cover" href="<?php echo get_permalink(); ?>"></a>
      </figure>

      </div>
    <?php endwhile; else: ?>
      <div>Sorry, there are no posts to display</div>
    <?php endif; ?>
    </div>
  </div>
  <?php

  wp_reset_query();

}


// Load Beans
beans_load_document();
