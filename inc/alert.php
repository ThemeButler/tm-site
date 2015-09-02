<?php

global $themebutler_alerts;

if ( !isset( $themebutler_alerts ) )
	$themebutler_alerts = array(
		'success' => array(),
		'warning' => array(),
		'danger' => array()
	);

function themebutler_get_alert( $target = false, $type = false ) {

	global $themebutler_alerts;

	if ( !$type && !$target )
		return $themebutler_alerts;

	if ( $type && !$target )
		return butler_get( $type, $themebutler_alerts );

	if ( !$type && $target )
		foreach ( $themebutler_alerts as $type => $targets )
			if ( array_key_exists( $target, $targets ) )
				return $themebutler_alerts[$type][$targets];

	if ( $type && $target )
		return butler_get( $target, $themebutler_alerts[$type] );

	return false;

}


function themebutler_add_alert( $message, $target = false, $type = 'danger' ) {

	global $themebutler_alerts;

	$themebutler_alerts[$type][$target] = $message;

	return true;

}