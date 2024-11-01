=== Tx Responsive Slider ===
	Contributors: themexpo	
	Tags: tx responsive slider,responsive slider, slider, responsive, flex slider, flexslider, slides, jquery slider, slideshow, content slider, gallery slider, image slider, Photo Slider, slide, slider plugin, slideshow, wordpress slider, wordpress slideshow
	Requires at least: 3.8
	Tested up to: 5.5
	Stable tag: 1.5.17
        Author : Themexpo	
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

A tx responsive slider integrate into theme using simple shortcode.

== Description ==

The *Tx Responsive Slider* plugin allows you to create slides that consist images. The slider would then take those slides and present them as a jQuery slideshow - at a chosen location within your theme, page, or post. In whatever order you want them.
This plugin is only for use on Self-Hosted WordPress installations, not WordPress.com.

== Shortcode Base ==

Tx responsive slider is shortcode base plugin.Even without any programming knowledge, You can fulfill your demand by using this plugin. 
The directions of using the shortcode for registration in post or page are given below:

<code>[tx_responsive_slider] </code>

Directions of using registration shortcode in custom template

<code> <?php echo do_shortcode( '[tx_responsive_slider]' );?> </code>


== Installation ==

1. Upload the plugin folder `tx-responsive-slider` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the "Plugins" menu in WordPress. A new item **"Responsive Slider"** would appear in the admin menu (under "Media"). 
1. Go to **Responsive Slider -> Settings** and configure the slider options.
1. Go to **Responsive Slider -> Add New Responsive Slider** and create a few slides.
1. Place `<?php echo do_shortcode( '[tx_responsive_slider]' ); ?>` in your template - wherever you want it displayed. Alternatively you can use `[tx_responsive_slider]` into a post or a page - just like any other shortcode.
1. That's it. Your site should now display the slider at the chosen location.

== Screenshots ==

screenshot-1.jpg
screenshot-2.jpg
screenshot-3.jpg


== Changelog ==

= 1.0 =
* Initial release.

