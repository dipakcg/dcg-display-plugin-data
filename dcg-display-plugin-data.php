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
				$rating_stars_path = plugins_url( 'rating_stars.png', __FILE__ );
				$rating_stars_holder_style = "position: relative;height: 17px;width: 92px;background: url($rating_stars_path) repeat-x bottom left; vertical-align: top; display:inline-block;";
				$rating_stars_style = "background: url($rating_stars_path) repeat-x top left; height: 17px;float: left;text-indent: 100%;overflow: hidden;white-space: nowrap; width: {$decoded_data->rating}%";
				$rating_stars_value = floor($decoded_data->rating/20);
				// Count average rating
				$stars = array();
				foreach ($decoded_data->ratings as $value) {
				    $stars[] = $value;
				}
				$calculate_average_rating = ((($stars[0] * 5) + ($stars[1] * 4) + ($stars[2] * 3) + ($stars[3] * 2) + ($stars[4] * 1)) / $decoded_data->num_ratings);
				// Format rating. Eg: 4.7 out of 5 stars, but 5 (no decimal) out of 5 stars
				$average_rating = ( is_float($calculate_average_rating) ? number_format($calculate_average_rating, 1) : $calculate_average_rating );
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
										<div class='dcg-rating-stars-holder' style='{$rating_stars_holder_style}'>
											<div class='dcg-rating-stars' style='{$rating_stars_style}'>{$rating_stars_value}</div>
										</div>
										<span class='dcg-average-rating' style='margin-left:4px;'>($average_rating out of 5 stars)</span>
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