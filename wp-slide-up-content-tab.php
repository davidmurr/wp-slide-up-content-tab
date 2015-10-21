<?php
/**
 * Plugin Name: WP Slide Up Content Tab
 * Plugin URI: https://davidmurr.com/
 * Description: Creates a simple sticky slide-up tab that you can use to display any content you'd like!
 * Version: 0.2
 * Author: David Murr
 * Author URI: https://davidmurr.com/
 * License: GPL2
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'wp_enqueue_scripts', 'wp_slide_up_content_tab_assets' );
add_action( 'wp_footer', 'wp_slide_up_content_tab' );

function wp_slide_up_content_tab_assets() {
	wp_enqueue_style( 'wp_slide_up_content', plugin_dir_url( __FILE__ ) . 'css/basic.css' );
	wp_enqueue_script( 'wp_slide_up_content', plugin_dir_url( __FILE__ ) . 'js/init.js', array( 'jquery' ), '1.0', true );
}

function wp_slide_up_content_tab() {
	if (is_front_page() || is_home()) {
	
		$post_id = '';
		$post_title = apply_filters('the_title', get_post_field('post_title', $post_id));
		$post_content = apply_filters('the_content', get_post_field('post_content', $post_id));
			
		echo '<div class="wp_slide_up_content_tab_container">';
			echo '<h3 class="wp_slide_up_content_tab_grabber">' . $post_title . '</h3>';
			echo '<div class="wp_slide_up_content_tab_content">';
				echo $post_content;
			echo '</div>';
		echo '</div>';
	
	}
}
?>
