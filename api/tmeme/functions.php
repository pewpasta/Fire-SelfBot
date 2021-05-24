<?php

/**
 * 
 *
 * @param array
 *     top_text    string Text for top of image
 *     bottom_text string Text for bottom of image
 *     filename    string Filename to save image as
 *     font        string Path to font file
 *     memebase    string Path to base image
 *     textsize    int    Font size
 *     textfit     bool   Fit text to image
 *     linespacing int    Line spacing // Pending
 *     padding     int    Padding between text and image
 * @return void
 */
function memegen_build_image( $args = array() ) {

	list( $width, $height ) = getimagesize( $args['memebase'] );

	$args['textsize'] = empty( $args['textsize'] ) ? round( $height/10 ) : $args['textsize'];

	extract( $args );

	$im = imagecreatefromjpeg( $args['memebase'] );

	$black = imagecolorallocate( $im, 0, 0, 0 );
	imagecolortransparent( $im, $black );

	$textcolor = imagecolorallocate( $im, 255, 255, 255 );

	$angle = 0;

	$top_text = strtoupper( trim( $args['top_text'] ) );
	$bottom_text = strtoupper( trim( $args['bottom_text'] ) );

	$fit = isset( $textfit ) ? $textfit : true;

	extract( memegen_font_size_guess( $textsize, ($width-$padding*2), $font, $top_text, $fit ) );
	$from_side = ($width - $box_width)/2;
	$from_top = $box_height + $padding;
	memegen_imagettfstroketext( $im, $fontsize, $angle, $from_side, $from_top, $textcolor, $black, $font, $top_text, 1 );

	extract( memegen_font_size_guess( $textsize, ($width-$padding*2), $font, $bottom_text, $fit ) );
	$from_side = ($width - $box_width)/2;
	$from_top = $height - $padding;
	memegen_imagettfstroketext( $im, $fontsize, $angle, $from_side, $from_top, $textcolor, $black, $font, $bottom_text, 1 );

	$basename = basename( $args['memebase'], '.jpg' );
	header('Content-Type: image/jpeg');
	header('Content-Disposition: filename="'. $basename .'-'. $filename .'.jpg"');
	imagejpeg( $im );
	imagedestroy( $im );

}

/**
 * Font size guess
 *
 * Check if font box is too big for image and reduce recursively as needed till it does
 *
 * @param int $fontsize
 * @param int $imwidth
 * @param string $font TTF
 * @param string $text
 * @param bool $fit Try and fit text to image
 * @return array Font size, font box width, font box height
 */
function memegen_font_size_guess( $fontsize, $imwidth, $font, $text, $fit ) {

	$angle = 0;

	$_box = imageftbbox( $fontsize, $angle, $font, $text );
	$box_width = $_box[4] - $_box[6];
	$box_height = $_box[3] - $_box[5];

	if ( $box_width > $imwidth && $fit ) {

		$sub = 1;
		$fontsize = $fontsize - $sub;

		return memegen_font_size_guess( $fontsize, $imwidth, $font, $text, $fit );

	}

	return compact( 'fontsize', 'box_width', 'box_height' );

}

function memegen_imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {

	for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
		for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
			$bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);

	return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
}

/**
 * Sanitize
 *
 * Replace non-alphanumeric characters with hyphens
 * Reduce any multihyphens down to one
 *
 * @param string $input
 * @return string $input
 */
function memegen_sanitize( $input ) {
	$input = preg_replace( '/[^a-zA-Z0-9-_]/', '-', $input );
	$input = preg_replace( '/--*/', '-', $input );
	return $input;
}