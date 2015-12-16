<?php

// Setup frontpage view
add_action( 'beans_before_load_document', 'tbr_resources_archive_setup' );

function tbr_resources_archive_setup() {

  beans_remove_attribute( 'beans_body', 'class' );
  beans_add_attribute( 'beans_body', 'class', 'tm-resources' );
  beans_remove_markup( 'beans_primary' );
  beans_remove_markup( 'beans_main_grid', 'class' );
  beans_modify_action_hook( 'beans_post_image', 'beans_post_prepend_markup' );
  beans_remove_markup( 'beans_post_header' );
  beans_add_attribute( 'beans_post_title', 'class', 'uk-h3' );
  beans_add_attribute( 'beans_post_image', 'class', 'uk-margin-remove' );
  beans_remove_attribute( 'beans_post', 'class' );
  beans_add_attribute( 'beans_post_body', 'class', 'uk-panel-box' );
  beans_modify_action_hook( 'beans_post_title', 'beans_post_body_prepend_markup' );

}

// Include the needed uikit components
add_action( 'beans_uikit_enqueue_scripts', 'tbr_enqueue_resources_uikit' );

function tbr_enqueue_resources_uikit() {

  beans_uikit_enqueue_components( array( 'grid' ), 'add-ons' );

}

// output the sub menu
add_filter( 'beans_fixed_wrap_main_prepend_markup', 'tbr_resource_types_menu' );

function tbr_resource_types_menu() {

$total = wp_count_posts('resources')->publish; ?>

<nav class="uk-clearfix uk-margin-large-bottom">
    <header class="uk-float-left">
        <h1 class="uk-display-inline uk-margin-right">Resources</h1>
        <h2 class="uk-display-inline uk-h3 tm-sub-heading">Browse our growing collection of freebies.</h2>
    </header>
    <a href="#offcanvas_filters" class="uk-hidden-large uk-float-right tm-filters uk-button uk-button-small" data-uk-offcanvas><i class="uk-icon-filter"></i> Show Filters</a>
    <ul id="filters" class="uk-subnav uk-subnav-line uk-float-right uk-visible-large">
        <li<?php echo ( !beans_get( 'filter_term_id' ) ? ' class="uk-active"' : '' ); ?> data-uk-filter=""><a href="/resources/">All</a></li>
        <?php foreach ( get_terms( 'resource_type', array( 'orderby' => 'id', 'hide_empty' => true ) ) as $term ) :
            $lowercase_term = strtolower($term->name);
        ?>
            <li<?php echo ( beans_get( 'filter_term_id' ) == $term->term_id ? ' class="uk-active"' : '' ); ?> data-uk-filter="<?php echo $lowercase_term; ?>"><a href="<?php echo add_query_arg( 'filter_term_id', $term->term_id ); ?>"><?php echo $term->name; ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php }


add_filter( 'beans_widget_area_offcanvas_wrap_offcanvas_menu_after_markup', 'dfh_filters_offcanvas' );

function dfh_filters_offcanvas() {

?>

<div id="offcanvas_filters" class="uk-offcanvas">
  <div class="uk-offcanvas-bar">
    <nav class="tm-primary-offcanvas-menu uk-margin uk-margin-top" role="navigation">
      <ul id="mobile-filters" class="menu uk-nav uk-nav-offcanvas" data-uk-nav>
        <li<?php ( !beans_get( 'filter_term_id' ) ? ' class="uk-active"' : '' ); ?>><a href="/resources/">All</a></li>
        <?php foreach ( get_terms( 'resource_type', array( 'orderby' => 'id', 'hide_empty' => true ) ) as $term ) : ?>
          <li<?php echo ( beans_get( 'filter_term_id' ) == $term->term_id ? ' class="uk-active"' : '' ); ?> data-uk-filter="<?php echo $$lowercase_term; ?>"><a href="<?php echo add_query_arg( 'filter_term_id', $term->term_id ); ?>"><?php echo $term->name; ?></a></li>
        <?php endforeach; ?>
        </ul>
      </nav>
    <div id="search-3" class="tm-widget uk-panel widget_search">
      <div>
        <form class="uk-form uk-form-icon uk-form-icon-flip uk-width-1-1" method="get" action="/" role="search">
          <input class="uk-width-1-1" type="search" placeholder="Search" value="" name="s">
          <i class="uk-icon-search"></i>
        </form>
      </div>
    </div>
  </div>
</div>
<?php }




// modify the loop output
beans_modify_action_callback( 'beans_loop_template', 'tbr_resources_loop' );

function tbr_resources_loop( $query ) {

	$query_args = array(
		'post_type' => 'resources'
	);

	if ( $term_id = beans_get( 'filter_term_id' ) )
		$query_args = array_merge( $query_args , array(
			'tax_query' => array(
				array(
					'taxonomy' => 'resource_type',
					'field' => 'term_id',
					'terms' => beans_get( 'filter_term_id' )
				)
			)
		) );

	$the_query = new WP_Query( $query_args );

    if ( wp_is_mobile() ){
      $filter_id = 'mobile-filters';
    } else {
      $filter_id = 'filters';
    } ?>

    <div class="tm-index-wrap tm-portfolio tm-lazy uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3" data-uk-grid="{gutter: 30, controls: '#<?php echo $filter_id; ?>'}">

		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
			global $post;
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full-size', true);
            $resized_src = beans_edit_image( $thumb_url_array[0], array(
                'resize' => array( 407, 379, array( 'center', 'top' ) )
            ) );

            $resource_cats = get_the_terms($post->ID, 'resource_type');
            $resource_cats = array_values($resource_cats);

            for($cat_count=0; $cat_count<count($resource_cats); $cat_count++) {
			    $resource_type = $resource_cats[$cat_count]->name;
                $lowercase_resource_type = strtolower($resource_type);
			    if ($cat_count<count($resource_cats)-1){
			        echo ', ';
			    }
			}
		?>
		<div class="tm-item" data-uk-filter="<?php echo $lowercase_resource_type; ?>">
            <div class="uk-article">
                <a rel="bookmark" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                    <img src="<?php echo $resized_src; ?>" width="407" height="378" alt="<?php the_title(); ?>" />
                </a>
                <div class="uk-panel uk-panel-box">
    			    <h3 class="uk-margin-top-remove"><a rel="bookmark" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <div class="tm-meta"><?php echo get_the_term_list( $post->ID, 'resource_type', '', ''); ?><?php echo get_the_term_list( $post->ID, 'resource_tags', '', ''); ?></div>
    				<p><?php the_excerpt(); ?></p>
                    <p class="uk-margin-remove"><a rel="bookmark" class="uk-button uk-button-small uk-button-secondary" href="<?php echo get_permalink(); ?>" title="Learn more">Learn more</a></p>
    			</div>
            </div>
		</div>
		<?php endwhile; else: ?>
			<p>Sorry, there are no posts to display</p>
		<?php endif; ?>
	</div>
	<?php
	wp_reset_query();
}



// Load Beans
beans_load_document();
