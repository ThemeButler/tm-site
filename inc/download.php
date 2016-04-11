<?php

function tbr_process_download() {

	if ( stripos( $_SERVER['REQUEST_URI'], 'download-jenkins' ) !== false )
		$filename = 'tm-jenkins-v1.2.3.zip';
	elseif ( stripos( $_SERVER['REQUEST_URI'], 'download-totem' ) !== false )
		$filename = 'tm-totem-v1.2.3.zip';
	elseif ( stripos( $_SERVER['REQUEST_URI'], 'download-banks' ) !== false )
		$filename = 'tm-banks-v1.2.3.zip';
	elseif ( stripos( $_SERVER['REQUEST_URI'], 'download-themebutler' ) !== false )
		$filename = 'tm-tbr-v1.0.0.zip';
	elseif ( stripos( $_SERVER['REQUEST_URI'], 'download-devignerforhire' ) !== false )
		$filename = 'tm-dfh-v1.0.0.zip';
	elseif ( stripos( $_SERVER['REQUEST_URI'], 'download-uikit-sketch' ) !== false )
		$filename = 'uikit-element-library-v0.7.zip';
	elseif ( stripos( $_SERVER['REQUEST_URI'], 'download-wordpress-sketch' ) !== false )
		$filename = 'wordpress-admin-sketch-v0.1.zip';

	$file = trailingslashit( ABSPATH ) . '/wp-content/downloads/' . $filename;

	if ( !file_exists( $file ) )
		return;

	@session_write_close();

	if ( !ini_get( 'safe_mode' ) )
		@set_time_limit( 0 );

	if ( function_exists( 'get_magic_quotes_runtime' ) && get_magic_quotes_runtime() && version_compare( phpversion(), '5.4', '<' ) )
		set_magic_quotes_runtime( 0 );

	if ( function_exists( 'apache_setenv' ) )
		@apache_setenv( 'no-gzip', 1 );

	if( ini_get( 'zlib.output_compression' ) )
		@ini_set( 'zlib.output_compression', 'Off' );

	// Conditional headers.
	if ( function_exists( 'apache_get_modules' ) && in_array( 'mod_xsendfile', apache_get_modules() ) ) {

		header( "X-Sendfile: $file" );

	} elseif ( stristr( getenv( 'SERVER_SOFTWARE' ), 'lighttpd' ) ) {

		header( "X-LIGHTTPD-send-file: $file" );

	} elseif ( stristr( getenv( 'SERVER_SOFTWARE' ), 'nginx' || stristr( getenv( 'SERVER_SOFTWARE' ), 'cherokee' ) ) ) {

		$file = str_ireplace( $_SERVER['DOCUMENT_ROOT'], '', $file );
		header( "X-Accel-Redirect: /$file" );

	}

	// Headers.
	header( 'Content-Type: application/zip' );
	header( 'Content-Description: File Transfer' );
	header( 'Content-Type: application/octet-stream' );
	header( 'Content-Disposition: attachment; filename="' . basename( $file ) . '"' );
	header( 'Robots: none');
	header( 'Content-Transfer-Encoding: binary' );
	header( 'Expires: 0' );
	header( 'Cache-Control: private',false);
	header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
	header( 'Pragma: public' );
	header( 'Content-Length: ' . filesize( $file ) );
	header( 'Connection: close' );

	// Deliver files.
	readfile( $file );

	// Log download.
	$option_id = beans_get( 'theme_update' ) ? 'tbr_downloads_update_log' : 'tbr_downloads_log';
	$logs = get_option( $option_id, array() );
	$logs[$filename] = beans_get( $filename, $logs ) + 1;

	update_option( $option_id, $logs );

	exit;

}
