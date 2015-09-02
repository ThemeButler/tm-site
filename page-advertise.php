<?php

// Setup the about page
add_action( 'beans_before_load_document', 'tbr_page_setup' );

function tbr_page_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-advertise' );
  beans_remove_markup( 'beans_main_grid' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_content' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-text-center uk-margin-bottom' );
  beans_modify_markup( 'beans_post_title', 'h2' );
}


// Add the excerpt
add_action( "beans_header_append_markup", "tbr_advertising_intro" );

function tbr_advertising_intro() {

  ?>
  <div class="uk-text-center uk-margin-large-top">
    <h1>An experiment in ad-supported themes</h1>
    <p>Promote your WordPress product or service, while at the same time supporting my efforts to provide premium WordPress themes for free.</p>
  </div>
<? }


// Add the specialized packages page
add_action( "beans_main_after_markup", "tbr_add_specialized_ad_packages", 1 );

function tbr_add_specialized_ad_packages(){ ?>
    <section class="tm-special-packages uk-block-large">
      <div class="uk-container uk-container-center">
          <h2 class="uk-article-title uk-text-center uk-margin-large-bottom"><?php echo get_post( 16 )->post_title; ?></h2>
          <?php echo get_post( 16 )->post_content; ?>
      </div>
    </section>
<?php }


// Load Beans
beans_load_document();