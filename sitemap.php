<?php

header( 'HTTP/1.1 200 OK' );
header('Content-type: application/xml; charset=utf-8');


echo '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/css" href="' . get_stylesheet_directory_uri() . '/assets/css/sitemap.css"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	$query = new WP_Query( array(
		'post_type' => array(
			'post',
			'page',
			'themes',
			'resources',
		),
		'orderby' => 'modified',
		'post_status' => 'publish',
		'posts_per_page' => 500000,
		'has_password' => false
	) );

	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) : $query->the_post();

			$link = esc_url( get_permalink() );
			$date = esc_html( get_the_modified_date( 'Y-m-d\TH:i:sP' ) );

			echo "<url><loc>$link</loc><lastmod>$date</lastmod></url>";

		endwhile;

	}

	wp_reset_postdata();

echo '</urlset>';
