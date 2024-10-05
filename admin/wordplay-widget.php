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
 * WordPlay_Widget Class
 *
 * A widget that displays a random image from the public/assets/img folder.
 */
class WordPlay_Widget extends WP_Widget {

    /**
     * Constructor method to set up the widget's name and description.
     */
    public function __construct() {
        parent::__construct(
            'wordplay_widget',
            esc_html__( 'WordPlay', 'wordplay' ),
            array(
                'description' => esc_html__( 'Displays a random image from the img folder', 'wordplay' )
            )
        );
    }

    /**
     * Output the widget content on the front-end.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     * 
     * @since  1.0.0
     * @return void
     */
    public function widget( $args, $instance ) {
        // Output the widget's HTML before the widget content.
        echo $args['before_widget'];

        // Get the plugin directory and the image folder path.
        $img_dir = plugin_dir_path( dirname( __FILE__ ) ) . 'public/img/';
        $img_url = plugin_dir_url( dirname( __FILE__ ) ) . 'public/img/';

        // Check if the directory exists
        if ( is_dir( $img_dir ) ) {
            // Get all image files in the folder (filtering for common image extensions).
            $images = glob( $img_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE );

            // If images are found, display a random one.
            if ( !empty( $images ) ) {
                $random_image = basename( $images[ array_rand( $images ) ] );
                echo '<img src="' . esc_url( $img_url . $random_image ) . '" alt="' . esc_attr__( 'WordPress® meme', 'wordplay' ) . '" />';
            } else {
                echo esc_html__( 'No images found in the folder.', 'wordplay' );
            }
        } else {
            echo esc_html__( 'Image directory does not exist.', 'wordplay' );
        }

        // Output the widget's HTML after the widget content
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from the database.
     */
    public function form( $instance ) {
        // Sanitize and validate input fields (if we had any options).
        echo '<p>' . esc_html__( '"Like I even care about money" - Matthew Mullenweg.', 'wordplay' ) . '</p>';
    }

    /**
     * Updating widget on save.
     *
     * @param array $new_instance New values from the form.
     * @param array $old_instance Previous values from the database.
     * 
     * @since  1.0.0
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        // Ensure no harmful data is saved into the database.
        $instance = array();

        return $instance;
    }
}

/**
 * Register the WordPlay_Widget widget.
 * 
 * @since  1.0.0
 * @return void
 */
function register_wordplay_widget() {
    register_widget( 'WordPlay_Widget' );
}
add_action( 'widgets_init', 'register_wordplay_widget' );
