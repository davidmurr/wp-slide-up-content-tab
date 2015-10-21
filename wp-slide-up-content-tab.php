<?php
/**
 * Plugin Name: WP Slide Up Content Tab
 * Plugin URI: https://davidmurr.com/
 * Description: Creates a simple sticky slide-up tab that you can use to display any content you'd like!
 * Version: 0.4
 * Author: David Murr
 * Author URI: https://davidmurr.com/
 * License: GPL2
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'wp_enqueue_scripts', 'wp_slide_up_content_tab_assets' );
add_action( 'wp_footer', 'wp_slide_up_content_tab' );
add_action( 'admin_menu', 'wp_slide_up_content_tab_settings_menu' );
add_action( 'admin_init', 'wp_slide_up_content_tab_settings' );

function wp_slide_up_content_tab_settings() {
	register_setting( 'wp-slide-up-content-tab-settings-group', 'dmsuct_display_post_id' );
}

function wp_slide_up_content_tab_settings_menu() {
	add_options_page('Slide Up Content Tab', 'Slide Up Content Tab', 'manage_options', 'wp-slide-up-content-tab', 'wp_slide_up_content_tab_settings_page');
}

function wp_slide_up_content_tab_settings_page() {
	echo '
	<div class="wrap">
	
		<h2>WP Slide Up Content Tab Settings</h2>
		
		<form method="post" action="options.php">';
		settings_fields( 'wp-slide-up-content-tab-settings-group' );
		do_settings_sections( 'wp-slide-up-content-tab-settings-group' );
		echo '
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Page Content to Display:</th>
					<td>
						<select name="dmsuct_display_post_id" id="dmsuct_display_post_id">';
						$dm_args = array(
							'posts_per_page'   => 9999,
							'offset'           => 0,
							'category'         => '',
							'category_name'    => '',
							'orderby'          => 'post_title',
							'order'            => 'ASC',
							'include'          => '',
							'exclude'          => '',
							'meta_key'         => '',
							'meta_value'       => '',
							'post_type'        => 'page',
							'post_mime_type'   => '',
							'post_parent'      => '',
							'author'	   => '',
							'post_status'      => 'publish',
							'suppress_filters' => true 
							);
							$dm_posts_array = get_posts( $dm_args );
							foreach ($dm_posts_array as $dm_post) {
								echo '<option value="' . $dm_post->ID . '"';
								if ($dm_post->ID == esc_attr( get_option('dmsuct_display_post_id') )) {
									echo ' selected="selected"';
								}
								echo '>' . $dm_post->post_title . '</option>';
							}
					echo '
						</select>
					</td>
				</tr>
			</table>';
		submit_button();
		echo '
		</form>
	</div>
	';
}

function wp_slide_up_content_tab_assets() {
	wp_enqueue_style( 'wp_slide_up_content', plugin_dir_url( __FILE__ ) . 'css/basic.css' );
	wp_enqueue_script( 'wp_slide_up_content', plugin_dir_url( __FILE__ ) . 'js/init.js', array( 'jquery' ), '1.0', true );
}

function wp_slide_up_content_tab() {
	
	$post_title = apply_filters('the_title', get_post_field('post_title', esc_attr(get_option('dmsuct_display_post_id'))));
	$post_content = apply_filters('the_content', get_post_field('post_content', esc_attr(get_option('dmsuct_display_post_id'))));
		
	echo '<div class="wp_slide_up_content_tab_container">';
	echo '<h3 class="wp_slide_up_content_tab_grabber">' . $post_title . '</h3>';
	echo '<div class="wp_slide_up_content_tab_content">';
	echo $post_content;
	echo '</div>';
	echo '</div>';
	
}
?>
