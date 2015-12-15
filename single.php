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
  beans_replace_attribute( 'beans_no_comment', 'class', 'uk-text-muted', 'uk-text-center uk-margin-large-top' );
  beans_add_attribute( 'beans_comment_form_wrap', 'id', 'js-comment-form' );
  beans_modify_markup( 'beans_no_comment', 'h3' );
  beans_wrap_markup( 'beans_no_comment', 'tm_no_comments_wrap', 'div', array( 'class' => 'uk-text-center' ) );
  beans_modify_markup( 'beans_comment_form_comment', 'div' );
  beans_modify_action_hook( 'beans_comment_form_comment', 'beans_comment_form_name_before_markup' );
  beans_add_attribute( 'beans_comment_form_legend', 'class', 'uk-hidden' );
  beans_add_attribute( 'beans_comment_form_field_name', 'placeholder', 'Name' );
  beans_add_attribute( 'beans_comment_form_field_email', 'placeholder', 'Email' );
  beans_add_attribute( 'beans_comment_form_field_url', 'placeholder', 'Website' );
  beans_remove_markup( 'beans_comment_all_fields_wrap' );
  beans_replace_attribute( 'beans_comment_form', 'class', 'uk-margin-bottom', 'uk-margin-small-bottom' );
  beans_add_attribute( 'beans_comment_form_field_comment', 'autofocus', '' );
  beans_add_attribute( 'beans_comment_form_wrap', 'class', 'uk-panel-box' );
  beans_replace_attribute( 'beans_primary', 'class', 'uk-width-medium-3-4', 'uk-width-medium-2-3' );
  beans_replace_attribute( 'beans_sidebar_primary', 'class', 'uk-width-medium-1-4', 'uk-width-medium-1-3' );

  if (get_comments_number()==0)
    beans_add_attribute( 'beans_comment_form_wrap', 'class', 'uk-hidden tm-no-comments' );
}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enque_uikit_blog_single' );

function tbr_enque_uikit_blog_single() {

  beans_uikit_enqueue_components( array( 'animation', 'subnav', 'comment', 'badge', 'list', 'article', 'pagination', 'modal', 'icon' ) );
  beans_uikit_enqueue_components( array( 'lightbox', 'slidenav' ), 'add-ons' );

}


 // Customize the no comments text
 add_action( 'beans_no_comment_text_output', 'tbr_no_comments' );

 function tbr_no_comments() {

   return 'No comments yet <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
       <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
           <g id="Mask-+-Contribute-to-the-di" sketch:type="MSLayerGroup" transform="translate(-246.000000, 0.000000)" fill="#8E8E8E">
               <g id="frown" transform="translate(246.000000, 0.000000)" sketch:type="MSShapeGroup">
                   <path d="M14.88,4.01168254 C14.1695238,2.7944127 13.2057143,1.83060317 11.9884444,1.12012698 C10.7709206,0.409650794 9.44177778,0.0544761905 8.00012698,0.0544761905 C6.55860317,0.0544761905 5.22907937,0.409650794 4.01180952,1.12012698 C2.7944127,1.83047619 1.83060317,2.79428571 1.12012698,4.01168254 C0.40952381,5.22907937 0.0543492063,6.55860317 0.0543492063,8 C0.0543492063,9.44152381 0.409650794,10.7707937 1.12,11.9883175 C1.83047619,13.2054603 2.79428571,14.1693968 4.01168254,14.879873 C5.22907937,15.5903492 6.55847619,15.9455238 8,15.9455238 C9.44152381,15.9455238 10.7710476,15.5903492 11.9883175,14.879873 C13.2055873,14.1695238 14.1693968,13.2055873 14.879873,11.9883175 C15.5902222,10.7709206 15.9453968,9.44139683 15.9453968,8 C15.9453968,6.55847619 15.5902222,5.22895238 14.88,4.01168254 L14.88,4.01168254 Z M14.0937143,10.5709206 C13.7419683,11.3881905 13.2712381,12.0916825 12.6815238,12.6813968 C12.0919365,13.2711111 11.3883175,13.7418413 10.5710476,14.0934603 C9.75365079,14.4453333 8.8967619,14.6212063 8.00012698,14.6212063 C7.10349206,14.6212063 6.24660317,14.4453333 5.42920635,14.0934603 C4.61193651,13.7418413 3.90831746,13.2711111 3.31860317,12.6813968 C2.72901587,12.0916825 2.25828571,11.3883175 1.9064127,10.5709206 C1.55466667,9.75365079 1.37879365,8.89650794 1.37879365,8 C1.37879365,7.10336508 1.55466667,6.24647619 1.9064127,5.42907937 C2.25815873,4.61180952 2.72888889,3.90831746 3.31860317,3.31847619 C3.90831746,2.72888889 4.61193651,2.25815873 5.42920635,1.90628571 C6.24647619,1.55466667 7.10349206,1.37879365 8.00012698,1.37879365 C8.89663492,1.37879365 9.75377778,1.55453968 10.5710476,1.90628571 C11.3883175,2.25803175 12.0918095,2.7287619 12.6815238,3.31847619 C13.2712381,3.90819048 13.7419683,4.61168254 14.0937143,5.42907937 C14.4454603,6.24634921 14.6214603,7.1032381 14.6214603,8 C14.6215873,8.89663492 14.4454603,9.75377778 14.0937143,10.5709206 L14.0937143,10.5709206 Z" id="Shape"></path>
                   <path d="M10.3589841,9.42768254 C9.66247619,8.91733333 8.87593651,8.66209524 8.00012698,8.66209524 C7.12419048,8.66209524 6.33790476,8.91720635 5.64126984,9.42768254 C4.94463492,9.93815873 4.46869841,10.6105397 4.2135873,11.4452063 C4.15847619,11.6175238 4.17219048,11.7850159 4.25498413,11.9469206 C4.33777778,12.1088254 4.46869841,12.2175238 4.64812698,12.2727619 C4.82057143,12.328 4.98780952,12.3141587 5.14984127,12.2313651 C5.31187302,12.1485714 5.42044444,12.0175238 5.47568254,11.8382222 C5.64812698,11.2862222 5.96711111,10.839746 6.43263492,10.4982857 C6.89815873,10.1569524 7.42057143,9.98628571 8,9.98628571 C8.57930159,9.98628571 9.10196825,10.1570794 9.56736508,10.4982857 C10.0330159,10.839746 10.352,11.2862222 10.5244444,11.8382222 C10.5794286,12.0175238 10.6897778,12.1485714 10.8553651,12.2313651 C11.0209524,12.3141587 11.1899683,12.328 11.3622857,12.2727619 C11.5347302,12.2175238 11.6623492,12.1088254 11.7451429,11.9469206 C11.8279365,11.7850159 11.8417778,11.6175238 11.7864127,11.4452063 C11.5315556,10.6106667 11.0554921,9.93803175 10.3589841,9.42768254 L10.3589841,9.42768254 Z" id="Shape"></path>
                   <path d="M5.35149206,6.67580952 C5.71695238,6.67580952 6.02907937,6.54628571 6.28774603,6.28774603 C6.5464127,6.02920635 6.67580952,5.71707937 6.67580952,5.35149206 C6.67580952,4.98590476 6.5464127,4.67390476 6.28774603,4.4152381 C6.02907937,4.15657143 5.71695238,4.0271746 5.35149206,4.0271746 C4.98590476,4.0271746 4.67377778,4.15657143 4.41511111,4.4152381 C4.15657143,4.67390476 4.0271746,4.98590476 4.0271746,5.35149206 C4.0271746,5.71707937 4.15644444,6.02920635 4.41511111,6.28774603 C4.67390476,6.5464127 4.98590476,6.67580952 5.35149206,6.67580952 L5.35149206,6.67580952 Z" id="Shape"></path>
                   <path d="M10.6485079,4.0271746 C10.2829206,4.0271746 9.97066667,4.15657143 9.712,4.4152381 C9.4535873,4.67390476 9.32406349,4.98590476 9.32406349,5.35149206 C9.32406349,5.71707937 9.4535873,6.02920635 9.712,6.28774603 C9.97066667,6.5464127 10.2829206,6.67580952 10.6485079,6.67580952 C11.0138413,6.67580952 11.3260952,6.54628571 11.5847619,6.28774603 C11.8434286,6.02920635 11.9728254,5.71707937 11.9728254,5.35149206 C11.9728254,4.98590476 11.8434286,4.67390476 11.5847619,4.4152381 C11.3260952,4.15657143 11.0138413,4.0271746 10.6485079,4.0271746 L10.6485079,4.0271746 Z" id="Shape"></path>
               </g>
           </g>
       </g>
   </svg>';

 }


 // Add the bottom newsletter signup
 add_action( 'tm_no_comments_wrap_append_markup', 'tbr_no_comments_text' );

function tbr_no_comments_text() { ?>
    <p>Help banish the Crickets by adding your voice below!</p>
    <p><a href="#" class="uk-button uk-button-secondary" data-uk-toggle="{target:'#js-comment-form', animation:'uk-animation-slide-bottom'}">Contribute to the discussion</a>
    <figure class="uk-panel uk-panel-primary tm-sound tm-crickets uk-margin-large-top uk-margin-large-bottom" data-uk-scrollspy="{cls:'uk-animation-fade', target:'.tm-crickets', delay:300}">
        <img src="/wp-content/themes/tm-site/assets/images/crickets-inactive.jpg" alt="&lt;crickets&gt;" class="tm-crickets tm-no-comments uk-align-center">
        <figcaption class="uk-text-muted uk-text-center uk-text-small">Image credit: <a href="http://emla.deviantart.com/art/Cute-Crickets-165544070" target="_blank" rel="nofollow">@Emla</a>. <a class="mute"><svg width="8px" height="12px" viewBox="0 0 8 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="volume28" sketch:type="MSLayerGroup" transform="translate(0.000000, -280.000000)" fill="#796B69">
                    <path d="M6.94976323,280.252929 C6.83419851,280.137476 6.69748981,280.07975 6.53952526,280.07975 C6.38156071,280.07975 6.24474013,280.137476 6.12939916,280.252929 L3.09417518,283.288153 L0.706135988,283.288153 C0.548059563,283.288153 0.411350864,283.34588 0.295898018,283.461333 C0.180445173,283.576897 0.12271875,283.713606 0.12271875,283.87157 L0.12271875,287.371515 C0.12271875,287.529479 0.180445173,287.666412 0.295898018,287.781641 C0.411462737,287.897205 0.548171436,287.954932 0.706135988,287.954932 L3.0940633,287.954932 L6.12917542,290.990268 C6.24474013,291.105497 6.38144883,291.163335 6.53930151,291.163335 C6.69748981,291.163335 6.83408664,291.105497 6.94965135,290.990268 C7.06499233,290.874815 7.12271875,290.737994 7.12271875,290.580142 L7.12271875,280.663167 C7.12271875,280.505203 7.0651042,280.368382 6.94976323,280.252929 L6.94976323,280.252929 Z" id="Shape" sketch:type="MSShapeGroup"></path>
                </g>
            </g>
        </svg> Mute sound</a>.</figcaption>
    </figure>
    <audio id="crickets" preload="auto">
        <source src="/wp-content/themes/tm-site/assets/audio/crickets.mp3"></source>
        <source src="/wp-content/themes/tm-site/assets/audio/crickets.ogg"></source>
        Your browser isn\'t invited for super fun audio time.
    </audio>
<?php }



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
