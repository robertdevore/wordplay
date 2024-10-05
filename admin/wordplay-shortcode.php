<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://robertdevore.com
 * @since      1.0.0
 *
 * @package    WordPlay
 * @subpackage WordPlay/admin
 */

/**
 * Function to display a random image from the public/img folder via a shortcode.
 *
 * @return string HTML output of the random image.
 */
function wordplay_shortcode() {
    // Get the plugin directory and the image folder path.
    $img_dir = plugin_dir_path( dirname( __FILE__ ) ) . 'public/img/';
    $img_url = plugin_dir_url( dirname( __FILE__ ) ) . 'public/img/';
    $output  = '';

    // Check if the directory exists.
    if ( is_dir( $img_dir ) ) {
        // Get all image files in the folder (filtering for common image extensions)
        $images = glob( $img_dir . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE );

        // If images are found, display a random one.
        if ( !empty( $images ) ) {
            $random_image = basename( $images[ array_rand( $images ) ] ); // Select a random image
            $output      .= '<img src="' . esc_url( $img_url . $random_image ) . '" alt="' . esc_attr__( 'WordPress® meme', 'wordplay' ) . '" />';
        } else {
            // If no images are found.
            $output .= '<p>' . esc_html__( 'No images found in the folder.', 'wordplay' ) . '</p>';
        }
    } else {
        // If the image directory does not exist.
        $output .= '<p>' . esc_html__( 'Image directory does not exist.', 'wordplay' ) . '</p>';
    }

    return $output;
}

/**
 * Register the [wordplay] shortcode.
 * 
 * @since  1.0.0
 * @return void
 */
function register_wordplay_shortcode() {
    add_shortcode( 'wordplay', 'wordplay_shortcode' );
}
add_action( 'init', 'register_wordplay_shortcode' );
