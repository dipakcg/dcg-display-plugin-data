<?php
/**
 * Plugin Name: DCG Display Plugin Data (from wordpress.org)
 * Plugin URI: http://dipakgajjar.com
 * Description: Display plugin data (from wordpress.org) into pages / posts using simple shortcode.
 * Version: 1.0
 * Author: Dipak C. Gajjar
 * Author URI: http://dipakgajjar.com
 * License: GPLv2 or later
 */
defined('ABSPATH') or die("Script Error!");

class dcgGetPluginData{

	public function __construct(){
		add_shortcode( 'dcg_display_plugin_data', array($this, 'display_plugin_data_from_wordpressorg') );
	}

	public function display_plugin_data_from_wordpressorg( $atts ) {
		$a = shortcode_atts( array(
			'name' => 'dcg-custom-logout',
			'downloaded' => true,
			'description' => false,
			'installation' => false,
			'faq' => false,
			'screenshots' => false
		), $atts );
		$data = "";
		$args = array('timeout' => 120, 'httpversion' => '1.1');
		$default_images = array('default.png', 'default2.png');
		$response = wp_remote_post( 'https://api.wordpress.org/plugins/info/1.0/'.$a['name'].'.json', $args );
		if ($response && is_array($response)) {
			$decoded_data = json_decode($response['body'] );
			if($decoded_data && is_object($decoded_data)) {
				//echo $decoded_data->name;
				$url = getimagesize("https://ps.w.org/{$decoded_data->slug}/assets/icon-128x128.png");
				if(!is_array($url)) {
					$image_path = plugins_url( $default_images[rand(0, 1)], __FILE__ );
					$image = "<img src='{$image_path}' style='width: 126px;height: 126px;'/>";
				}
				else {
					$image = "<img src='https://ps.w.org/{$decoded_data->slug}/assets/icon-128x128.png' style='width: 126px;height: 126px;'/>";
				}
				$stars_path = plugins_url( 'stars.png', __FILE__ );
				$stars_holder_style = "position: relative;height: 17px;width: 92px;background: url($stars_path) repeat-x bottom left; vertical-align: top; display:inline-block;";
				$stars_rating_style = "background: url($stars_path) repeat-x top left; height: 17px;float: left;text-indent: 100%;overflow: hidden;white-space: nowrap; width: {$decoded_data->rating}%";
				$stars_rating_value = floor($decoded_data->rating/20);
				$release_date = date("d F Y", strtotime($decoded_data->added));
				$last_updated_date = date("d F Y", strtotime($decoded_data->last_updated));
				$wordpress_page = "https://wordpress.org/plugins/{$decoded_data->slug}";
				$data = "<div class='dcg-display-plugin-data'>
							<div class='dcg-data' style='line-height:26px;'>
								<div class='dcg-version'><span style='width: 27%; display: inline-block;'>Version:</span>{$decoded_data->version}</div>
								<div class='dcg-requires_wp'><span style='width: 27%; display: inline-block;'>Requires:</span>{$decoded_data->requires} or higher</div>
								<div class='dcg-tested_wp'><span style='width: 27%; display: inline-block;'>Compatible up to:</span>{$decoded_data->tested}</div>
								<div class='dcg-released'><span style='width: 27%; display: inline-block;'>Released:</span>{$release_date}</div>
								<div class='dcg-downloaded'><span style='width: 27%; display: inline-block;'>Downloads:</span>{$decoded_data->downloaded}</div>
								<div class='dcg-last_updated'><span style='width: 27%; display: inline-block;'>Last Updated:</span>{$last_updated_date}</div>
								<div class='dcg-rating'><span style='width: 27%; display: inline-block;'>Rating:</span>
										<div class='dcg-star-holder' style='{$stars_holder_style}'>
											<div class='dcg-star-rating' style='{$stars_rating_style}'>{$stars_rating_value}</div>
										</div>
										<span class='dcg-ratings-count' style='margin-left:4px;'>({$decoded_data->num_ratings})</span>
								</div>
								<div class='dcg-download-link'><span style='width: 27%; display: inline-block;'>Download Link:</span><a href='{$decoded_data->download_link}' target='_blank' style='border: 0px; '>Click here</a></div>
							</div>
					  </div>";

				if ($a['description'] == "true") {
				$data .= "<h2 style='padding-top: 20px; color: #6296c8;'>Description:</h2>
					  {$decoded_data->sections->description}";
				}

				if ($a['installation'] == "true") {
				$data .= "<h2 style='padding-top: 20px; color: #6296c8;'>Installation:</h2>
					  {$decoded_data->sections->installation}";
				}

				if ($a['faq'] == "true") {
				$data .= "<h2 style='padding-top: 20px; color: #6296c8;'>FAQ:</h2>
					  {$decoded_data->sections->faq}";
				}

				if ($a['screenshots'] == "true") {
				$data .= "<h2 style='padding-top: 20px; color: #6296c8;'>Screenshot(s):</h2>
					  {$decoded_data->sections->screenshots}";
				}
			}
			else {
				$data = "No data found for this plugin!";
			}
		}
		else {
			$data = "No data found for this plugin!";
		}
		return $data;
	}
}

$dcg_display_plugin_data = new dcgGetPluginData;

// END OF THE PLUGIN
?>