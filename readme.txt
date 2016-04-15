=== DCG Display Plugin Data (from wordpress.org)  ===
Contributors: dipakcg
Tags: plugin-api, plugins, api, promote, info, directory, specs, developer
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3S8BRPLWLNQ38
Requires at least: 3.5
<<<<<<< HEAD
Tested up to: 4.5
=======
Tested up to: 4.3.1
>>>>>>> origin/master
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display plugin data (from wordpress.org) into pages / posts using simple shortcode.

== Description ==
This plugin display WordPress.org plugin data such as version, requires and compatible up to, release and last update date, number of downloads, rating, description, installation steps, faq and screenshots etc. into pages / posts using simple shortcode.

= Shortcode examples =
* Display specs only. This will display version, requires and compatible up to, release and last update date, total number of downloads, average rating and download link.
`[dcg_display_plugin_data name='dcg-display-plugin-data']`
* Display specs with plugin description
`[dcg_display_plugin_data name='dcg-display-plugin-data' description="true"]`
* Display specs with installation instructions
`[dcg_display_plugin_data name='dcg-display-plugin-data' installation="true"]`
* Display specs with FAQ
`[dcg_display_plugin_data name='dcg-display-plugin-data' faq="true"]`
* Display specs with screenshot(s)
`[dcg_display_plugin_data name='dcg-display-plugin-data' screenshots="true"]`
* Display all data (everything)
`[dcg_display_plugin_data name='dcg-display-plugin-data' description="true" installation="true" faq="true" screenshots="true"]`

*Change 'dcg-display-plugin-data' to appropriate plugin slug for which you want to display data.*

= Note: In shortcode, you must have to pass name attribute with the correct plugin slug =
* Correct slug: dcg-display-plugin-data
* Wrong slug: DCG Display Plugin Data

**Follow the development of this plugin on [GitHub](https://github.com/dipakcg/dcg-display-plugin-data)**

**P.S. It is always the best policy to open a [support thread](http://wordpress.org/support/plugin/dcg-display-plugin-data) first before posting any negative review.**

== Installation ==
1. Upload the 'dcg-display-plugin-data' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the ‘Plugins’ menu in WordPress.
3. That’s it!

== Frequently Asked Questions ==
= What does this plugin do? =

This plugin display WordPress.org plugin data such as version, requires and compatible up to, release and last update date, number of downloads, rating, description, installation steps, faq and screenshots etc. into pages / posts using simple shortcode.

= Any shortcode examples? =

* Display specs only. This will display version, requires and compatible up to, release and last update date, total number of downloads, average rating and download link.
`[dcg_display_plugin_data name='dcg-display-plugin-data']`
* Display specs with plugin description
`[dcg_display_plugin_data name='dcg-display-plugin-data' description="true"]`
* Display specs with installation instructions
`[dcg_display_plugin_data name='dcg-display-plugin-data' installation="true"]`
* Display specs with FAQ
`[dcg_display_plugin_data name='dcg-display-plugin-data' faq="true"]`
* Display specs with screenshot(s)
`[dcg_display_plugin_data name='dcg-display-plugin-data' screenshots="true"]`
* Display all data (everything)
`[dcg_display_plugin_data name='dcg-display-plugin-data' description="true" installation="true" faq="true" screenshots="true"]`

= How can I find plugin slug? =

Last part of plugin URL (in WordPress.org) will be a plugin slug.
For example, plugin slug for ***DCG Display Plugin Data*** will be ***dcg-display-plugin-data***
( https://wordpress.org/plugins/**dcg-display-plugin-data**/ )

= Will DCG Display Plugin Data slow my site down? =

No.

= Any specific requirements for this plugin to work? =

No.

= How can I ask a question that is not answered here? =

You can always open a [support thread](http://wordpress.org/support/plugin/dcg-display-plugin-data) if you have any question(s).

= Is that it? =

Pretty much, yeah.

== Screenshots ==
1. Sample front-end output (on page / post)

== Changelog ==

= 1.1, Sept 29, 2015 =
* Updated WordPress compatibility
* Merged with SVN repo. for easy updates

= 1.0, June 27, 2015 =
* Initial release
