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
 * Function to display random image in the dashboard widget.
 * 
 * @since  1.0.0
 * @erturn void
 */
function wordplay_dashboard_widget_display() {
    // Get the plugin directory and the image folder path.
    $img_dir = plugin_dir_path( dirname( __FILE__ ) ) . 'public/img/';
    $img_url = plugin_dir_url( dirname( __FILE__ ) ) . 'public/img/';

    // Check if the directory exists.
    if ( is_dir( $img_dir ) ) {
        // Get all image files in the folder (filtering for common image extensions).
        $images = glob( $img_dir . "*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE );

        // If images are found, display a random one.
        if ( !empty( $images ) ) {
            $random_image = basename( $images[ array_rand( $images ) ] );
            echo '<img src="' . esc_url( $img_url . $random_image ) . '" alt="' . esc_attr__( 'WordPress® meme', 'wordplay' ) . '" style="max-width:100%; height:auto;" />';
        } else {
            echo '<p>' . esc_html__( 'No images found in the folder.', 'wordplay' ) . '</p>';
        }
    } else {
        echo '<p>' . esc_html__( 'Image directory does not exist.', 'wordplay' ) . '</p>';
    }
}

/**
 * Function to add the dashboard widget.
 * 
 * @since  1.0.0
 * @return void
 */
function wordplay_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'wordplay_dashboard_widget', // Widget ID
        esc_html__( 'WordPlay - Putting the FUN in dysFUNctional', 'wordplay' ), // Widget Title
        'wordplay_dashboard_widget_display' // Display callback
    );
}
add_action( 'wp_dashboard_setup', 'wordplay_add_dashboard_widget' );
