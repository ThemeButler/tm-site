<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_blog_setup' );

function tbr_blog_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-blog' );
  beans_remove_action( 'beans_post_meta' );
  beans_remove_action( 'beans_post_meta_tags' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post', 'class', 'uk-article' );
  beans_modify_action( 'beans_post_meta_date', 'tm-item-inner_prepend_markup' );
  beans_modify_action( 'beans_post_meta_categories', 'tm_item_inner_prepend_markup', null, 7 );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_post_body' );
  beans_remove_markup( 'beans_post_header' );
  beans_remove_markup( 'beans_post_content' );
  beans_remove_markup( 'beans_post_title_link' );
  beans_add_attribute( 'beans_main_grid', 'class', 'uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3' );
  beans_add_attribute( 'beans_main_grid', 'data-uk-grid', '{gutter: 20, controls: \'#js-blog-filters\'}' );
  beans_remove_attribute( 'beans_main_grid', 'data-uk-grid-margin' );
  beans_replace_attribute( 'beans_post', 'class', 'uk-article', 'tm-item' );
  beans_modify_markup( 'beans_post', 'div' );
  beans_wrap_inner_markup( 'beans_post', 'tm_item_inner', 'div', array( 'class' => 'uk-panel uk-panel-box uk-panel-box-secondary' ) );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-small-top' );
  beans_add_attribute( 'beans_post_more_link', 'class', 'uk-button uk-button-secondary' );
  beans_replace_attribute( 'beans_next_icon_more_link', 'class', 'uk-icon-angle-double-right', 'uk-icon-arrow-circle-o-right' );
  beans_replace_attribute( 'beans_post_meta_categories', 'class', 'uk-text-small uk-text-muted uk-clearfix', 'tm-topic uk-button uk-button-tertiary uk-button-mini' );
  beans_add_attribute( 'beans_widget_content_sidebar_primary_recent-posts', 'class', 'tm-list-style1' );
  beans_add_attribute( 'beans_widget_content_categories', 'class', 'tm-list-style1' );

}


// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enqueue_blog_uikit' );

function tbr_enqueue_blog_uikit() {

  beans_uikit_enqueue_components( array( 'grid' ), 'add-ons' );

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

// Add the bottom newsletter signup
//add_action( 'beans_main_grid_before_markup', 'tbr_blog_top' );

function tbr_blog_top() { ?>
    <div class="uk-clearfix">
        <div id="js-blog-filters" class="filters uk-float-left">
            <nav class="uk-clearfix">
                <a href="#offcanvas_filters" class="uk-hidden-large uk-float-left tm-filters uk-button uk-button-small" data-uk-offcanvas><i class="uk-icon-filter"></i> Show Filters</a>
                <ul id="filters" class="uk-subnav uk-subnav-line uk-margin-large-bottom uk-visible-large">
                    <li<?php echo ( !beans_get( 'filter_term_id' ) ? ' class="uk-active"' : '' ); ?> data-uk-filter=""><a href="/blog/">All</a></li>
                    <?php foreach ( get_terms( 'category', array( 'orderby' => 'id', 'hide_empty' => true ) ) as $term ) : ?>
                        <li<?php echo ( beans_get( 'filter_term_id' ) == $term->term_id ? ' class="uk-active"' : '' ); ?> data-uk-filter="<?php echo $term->name; ?>"><a href="<?php echo add_query_arg( 'filter_term_id', $term->term_id ); ?>"><?php echo $term->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
<?php }



// Load Beans
beans_load_document();
