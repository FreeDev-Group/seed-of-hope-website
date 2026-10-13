<?php
/**
 * Media optimisation: lighter images for visitors on slow mobile connections.
 *
 * @package SeedOfHope\Core
 */

namespace SeedOfHope\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generates WebP versions for uploaded JPEG and PNG images.
 *
 * WordPress then serves the WebP sub-sizes in the content. Lazy loading is added
 * by WordPress core to every image below the fold.
 *
 * @param array $formats Map of source MIME type => output MIME type.
 * @return array
 */
function output_webp( $formats ) {
	if ( ! wp_image_editor_supports( array( 'mime_type' => 'image/webp' ) ) ) {
		return $formats;
	}

	$formats['image/jpeg'] = 'image/webp';
	$formats['image/png']  = 'image/webp';

	return $formats;
}
add_filter( 'image_editor_output_format', __NAMESPACE__ . '\output_webp' );

/**
 * Lowers the default compression quality slightly: visually identical, noticeably smaller.
 *
 * @param int    $quality   Quality level between 1 and 100.
 * @param string $mime_type Image MIME type.
 * @return int
 */
function webp_quality( $quality, $mime_type ) {
	return 'image/webp' === $mime_type ? 78 : $quality;
}
add_filter( 'wp_editor_set_quality', __NAMESPACE__ . '\webp_quality', 10, 2 );
