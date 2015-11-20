<?php

// Include Beans
require_once( get_template_directory() . '/lib/init.php' );


// Enqueue child theme assets
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enqueue_uikit_assets', 5 );

function tbr_enqueue_uikit_assets() {

  $less_dir = get_stylesheet_directory() . '/assets/less/';

  // Include uikit overwrite folder
  beans_uikit_enqueue_theme( 'site', $less_dir . 'uikit' );

  // Add the theme style as a uikit fragment to have access to all the variables
  beans_compiler_add_fragment( 'uikit', $less_dir . 'style.less', 'less' );

  // Add the theme js as a uikit fragment
  beans_compiler_add_fragment( 'uikit', get_stylesheet_directory() . '/assets/js/theme.js', 'js' );

}


// Cleanup AdsPro
remove_action('wp_enqueue_scripts', 'BSA_PRO_add_custom_stylesheet');
remove_action('wp_enqueue_scripts', 'BSA_PRO_add_stylesheet_and_script');

add_action( 'wp_print_styles', 'deregister_my_styles', 100 );

function deregister_my_styles() {
	wp_deregister_style( 'opanda-lockers' );
}

remove_theme_support( 'offcanvas-menu' );


// Remove unnecessary classes
add_filter( 'nav_menu_css_class', '__return_false' );


// Dequeue unnecessary uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_home_remove_uikit_components' );

function tbr_home_remove_uikit_components() {

  $components = array(
    'article',
    'alert',
    'breadcrumb',
    'badge',
    'comment',
    'dropdown',
    'form',
    'pagination',
    'table',
    'navbar',
    'nav',
    'icon',
    'offcanvas',
    'contrast'
  );
  beans_uikit_dequeue_components( $components );

}


// Setup theme
add_action( 'beans_before_load_document', 'tbr_setup_theme' );

function tbr_setup_theme() {

  beans_remove_attribute( 'beans_primary_menu', 'class' );
  beans_add_attribute( 'beans_primary_menu', 'id', 'js-mobile-nav' );
  beans_add_attribute( 'beans_fixed_wrap_header', 'class', 'uk-text-center' );
  beans_remove_attribute( 'beans_menu_navbar', 'id' );
  beans_remove_attribute( 'beans_header', 'role' );
  beans_remove_attribute( 'beans_footer', 'role' );
  beans_remove_attribute( 'beans_primary_menu', 'role' );
  beans_remove_action( 'beans_comments' );
  beans_remove_action( 'beans_replace_nojs_class' );
  beans_remove_action( 'beans_breadcrumb' );
  beans_remove_markup( 'beans_site' );
  beans_remove_markup( 'beans_content' );
  beans_add_attribute( 'beans_primary', 'role', 'main' );
  beans_replace_attribute( 'beans_site_branding', 'class', 'uk-float-left', 'tm-logo uk-align-center tm-nudge' );
  beans_replace_attribute( 'beans_main', 'class', ' uk-block', ' uk-block-large' );
  beans_remove_attribute( 'beans_menu_navbar_primary', 'id' );
  beans_remove_attribute( 'beans_post', 'id' );
  beans_modify_action_hook( 'beans_footer', 'beans_main_after_markup' );
  beans_add_attribute( 'beans_menu_navbar', 'class', 'uk-hidden-small uk-subnav uk-subnav-line uk-margin-remove tm-nudge' );
  beans_add_attribute( 'beans_menu_item_link_24', 'class', 'tm-external' );

  if ( is_page( 'Theme Setup Guide', 'Features' ) ) {
      beans_remove_attribute( 'beans_post', 'class', 'uk-panel-box' );
      beans_add_attribute( 'beans_post_title', 'class', 'uk-text-center' );
      beans_remove_markup( 'beans_main_grid');
      beans_remove_markup( 'beans_primary');
      beans_add_attribute( 'beans_post_content', 'class', 'tm-narrow-content' );
  }

}

// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_global' );

function tbr_enque_uikit_global() {

  beans_uikit_enqueue_components( array( 'toggle', 'flex' ) );

}


// Add external link icon to a menu item
beans_add_smart_action( 'beans_menu_item_link_24_append_markup', 'custom_add_external_link_icon' );
function custom_add_external_link_icon() { ?>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="32px" height="32px" viewBox="0 0.002 32 32" overflow="visible" enable-background="new 0 0.002 32 32" xml:space="preserve">
    <path d="M2,32c-1.103,0-2-0.896-2-2V2c0-1.104,0.897-2,2-2h13c0.553,0,1,0.447,1,1v2c0,0.553-0.447,1-1,1H4v24h24V17c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v13c0,1.104-0.897,2-2,2H2z"/>
    <path d="M31,0.002H21c-0.404,0-0.77,0.242-0.924,0.617c-0.155,0.373-0.069,0.803,0.217,1.09l3.586,3.586l-10,10c-0.391,0.391-0.391,1.023,0,1.414l1.414,1.414c0.393,0.391,1.025,0.391,1.416,0l9.999-10l3.585,3.586C30.484,11.9,30.74,12.002,31,12.002c0.129,0,0.259-0.025,0.383-0.078C31.757,11.771,32,11.404,32,11.002v-10C32,0.447,31.553,0.002,31,0.002z"/>
    </svg>
<? }


// Set the default layout to content only.
beans_add_filter( 'beans_default_layout', 'c' );


// Add the top ad section
add_action( 'beans_main_before_markup', 'tbr_top_ads' );

function tbr_top_ads() { ?>
  <div class="tm-top tm-media-block">
    <?php echo bsa_pro_ad_space('1'); ?>
  </div>
<? }


// Add the bottom ad section
add_action( 'beans_primary_menu_before_markup', 'tbr_mobile_menu_link' );

function tbr_mobile_menu_link() { ?>
    <button class="uk-button uk-visible-small uk-margin-top" data-uk-toggle="{target:'#js-mobile-nav', cls:'tm-nav-open'}">Show Navigation</button>
<? }

// Add the article lead class
add_filter( 'the_content', 'tbr_blog_post_content' );

function tbr_blog_post_content( $content ) {

	// Stop here if the excerpt is empty.
	if ( !has_excerpt() )
		return $content;

	// Add the excerpt as lead if it is singular.
	if ( is_singular('post') )
		return '<p class="uk-article-lead">' . get_the_excerpt() . '</p>' . $content;

	// Replace content with excerpt and more link if not singular.
    elseif ( is_home() )
		return '<p>' . get_the_excerpt() . '</p><p class="uk-margin-bottom-remove">'.  beans_post_more_link() .  '</p>';

}

// Add the bottom newsletter signup
add_action( 'beans_footer_before_markup', 'tbr_newsletter' );

function tbr_newsletter() { ?>
  <div class="tm-newsletter uk-block">
    <div class="uk-container uk-container-center uk-text-center">
      <h2 class="uk-h3 uk-margin-top-remove">Want to be notified when new child-themes are released?</h2>
      <form action="//themebutler.us7.list-manage.com/subscribe/post?u=bdf3d2258eff9f6988b1e329f&amp;id=f4e4290e61" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate uk-display-inline" target="_blank" novalidate>
        <input type="email" value="" name="EMAIL" class="required email tm-input" id="mce-EMAIL" placeholder="Email address">
        <button class="uk-button uk-button-primary tm-field-button" id="mc-embedded-subscribe" name="subscribe">Signup, it's free!</button>
        <div class="uk-hidden" style="position: absolute; left: -5000px;"><input type="text" name="b_bdf3d2258eff9f6988b1e329f_f4e4290e61" tabindex="-1" value=""></div>
        <div id="mce-responses" class="clear uk-hidden">
          <div class="response" id="mce-error-response" style="display:none"></div>
          <div class="response" id="mce-success-response" style="display:none"></div>
        </div>
      </form>
    </div>
  </div>
<? }


// Add footer content
beans_modify_action_callback( 'beans_footer_content', 'tbr_footer' );

function tbr_footer() { ?>
  <div class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2 uk-margin-top uk-margin-large-bottom uk-text-muted">
    <div class="tm-copyright">&#169; ThemeButler <?php echo date('Y'); ?>. All rights reserved.</div>
    <div class="tm-credits uk-text-right">Built with <a href="http://getbeans.io/" target="_blank" title="Build Smarter with Beans.">Beans</a> and <a href="https://wordpress.org/" target="_blank">WordPress</a>.</div>
  </div>
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
      g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'js/'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><p><img src="//stats.themebutler.com/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<? }


// Set the content width
if ( ! isset( $content_width ) ) $content_width = 880;


// Add includes
do_action( 'themebutler_init' );


// Includes
require_once( get_stylesheet_directory() . '/inc/cleanup.php' );
require_once( get_stylesheet_directory() . '/inc/alert.php' );
