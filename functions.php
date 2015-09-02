<?php

// Include Beans
require_once( get_template_directory() . '/lib/init.php' );


// Enqueue child theme assets
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enqueue_uikit_assets', 5 );

function tbr_enqueue_uikit_assets() {

	$less_dir = get_stylesheet_directory() . '/assets/less/';

	// Include uikit overwrite folder
	beans_uikit_enqueue_theme( 'tbr', $less_dir . 'uikit' );

	// Add the theme style as a uikit fragment to have access to all the variables
  beans_compiler_add_fragment( 'uikit', $less_dir . 'style.less', 'less' );

  // Add the theme js as a uikit fragment
  beans_compiler_add_fragment( 'api', get_stylesheet_directory() . '/assets/js/api.min.js', 'js' );
  beans_compiler_add_fragment( 'theme', get_stylesheet_directory() . '/assets/js/theme.js', 'js' );

}


// Cleanup AdsPro
remove_action('wp_enqueue_scripts', 'BSA_PRO_add_custom_stylesheet');
remove_action('wp_enqueue_scripts', 'BSA_PRO_add_stylesheet_and_script');
remove_action('wp_enqueue_scripts', 'muut_before_scripts_enqueued');


// Remove unnecessary classes
add_filter( 'nav_menu_css_class', '__return_false' );


// Dequeue unnecessary uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_home_remove_uikit_components' );

function tbr_home_remove_uikit_components() {

  $components = array(
    'alert',
    'breadcrumb',
    'badge',
    'comment',
    'dropdown',
    'pagination',
    'table',
    'subnav',
    'nav'
  );
  beans_uikit_dequeue_components( $components );

}


// Setup theme
add_action( 'beans_before_load_document', 'tbr_setup_theme' );

function tbr_setup_theme() {

  // beans_replace_attribute( 'beans_favicon', 'href', 'http://themebutler.com/favicon.ico' );
  beans_remove_action( 'beans_comments' );
  beans_remove_action( 'beans_replace_nojs_class' );
  beans_remove_action( 'beans_site_title_tag' );
  beans_remove_action( 'beans_breadcrumb' );
  beans_remove_markup( 'beans_site' );
  beans_remove_markup( 'beans_site_branding' );
  beans_remove_markup( 'beans_content' );
  beans_add_attribute( 'beans_site', 'class', 'uk-container uk-container-center' );
  beans_add_attribute( 'beans_primary', 'role', 'main' );
  beans_add_attribute( 'beans_site_title_link', 'class', 'tm-logo uk-align-center' );
  beans_replace_attribute( 'beans_main', 'class', ' uk-block', ' uk-block-large' );
  beans_remove_attribute( 'beans_menu_navbar_primary', 'id' );
  beans_remove_attribute( 'beans_post', 'id' );
  beans_modify_action_hook( 'beans_footer', 'beans_main_after_markup' );
  beans_replace_attribute( 'beans_menu_navbar_primary', 'class', 'uk-visible-large', 'uk-hidden-small' );
  beans_replace_attribute( 'beans_primary_menu_offcanvas_button', 'class', 'uk-hidden-large', 'uk-visible-small uk-button-primary uk-float-right uk-margin-top' );

}

// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_global' );

function tbr_enque_uikit_global() {

  beans_uikit_enqueue_components( array( 'modal' ) );

}


// Set the default layout to content only.
beans_add_filter( 'beans_default_layout', 'c' );


// Add the top ad section
add_action( 'beans_header_after_markup', 'tbr_top_ads' );

function tbr_top_ads() {

    if( !is_page( array( 'advertise', 'contact' ) ) ) {
    if( !is_singular( 'themes' ) ) {

    ?>

  <div class="tm-top tm-media-block uk-block">
    <div class="uk-container uk-container-center">
      <?php echo bsa_pro_ad_space('1'); ?>
    </div>
  </div>

<? }
}
}

// Add the bottom ad section
add_action( 'beans_main_after_markup', 'tbr_bottom_ads' );

function tbr_bottom_ads() {

    if( !is_page( array( 'advertise', 'contact' ) ) ) {

    ?>

  <div class="tm-bottom tm-media-block uk-block">
    <div class="uk-container uk-container-center">
      <?php echo bsa_pro_ad_space('2'); ?>
    </div>
  </div>

<? }

}

// Add the bottom newsletter signup
add_action( 'beans_footer_before_markup', 'tbr_newsletter' );

function tbr_newsletter() { ?>

  <div class="tm-newsletter uk-contrast uk-block-large">
    <div class="uk-container uk-container-center">
      <h2 class="uk-article-title uk-text-center">Want to be notified when new themes are released?</h2>
      <p class="uk-margin-remove uk-h3 uk-text-center">Signup for our free newsletter and you’ll be the first to know!</p>
      <form action="#tm-footer" method="post" data-tm-subscribe>
        <input class="tm-input uk-margin-remove" type="email" name="tb_email" placeholder="Email address" value="" autocomplete="off">
        <input type="hidden" name="action" value="themebutler_subscribe">
        <input type="hidden" name="tb_subscribe" value="1">
        <button class="uk-button uk-button-secondary uk-button-small tm-field-button" name="tb_verify_coupon">Signup, it’s <strong>free</strong>!</button>
      </form>
    </div>
  </div>

<? }


// Add footer content
beans_modify_action_callback( 'beans_footer_content', 'tbr_footer' );

function tbr_footer() { ?>

  <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2 uk-margin-top uk-margin-large-bottom uk-text-muted">
    <div class="tm-copyright">&#169; ThemeButler <?php echo date('Y'); ?>. All rights reserved. A <a href="http://webmonkeys.co.za" target="_blank">Web Monkeys</a> Production.</div>
    <div class="tm-credits uk-text-right">Built with <a href="https://getbeans.io" target="_blank" title="Build Smarter with Beans.">Beans</a>. Powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.</div>
  </div>
  <!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.themebutler.com"]);
  _paq.push(["setDomains", ["*.themebutler.com"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//stats.themebutler.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//stats.themebutler.com/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

<? }


// Set the content width
if ( ! isset( $content_width ) ) $content_width = 880;


// Add includes
do_action( 'themebutler_init' );


// Includes
require_once( get_stylesheet_directory() . '/inc/cleanup.php' );
require_once( get_stylesheet_directory() . '/inc/alert.php' );
require_once( get_stylesheet_directory() . '/admin/cpt.php' );