=== Responsive Slider ===

Contributors: themeXpo
Donate link: 
Tags: responsive slider, slider, responsive, flex slider, flexslider, slides, jquery slider, slideshow, content slider, gallery slider, image slider, Photo Slider, slide, slider plugin, slideshow, wordpress slider, wordpress slideshow
Requires at least: 3.3
Tested up to: 5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: 0.1

A responsive slider for integrating into theme by a simple shortcode.

== Description ==

The *TX Responsive Slider* plugin allows you to create slides that images and titles. The slider would then take those slides and present them as a jQuery-powered slideshow - at a chosen location within your theme, page, or post. In whatever order you want them.

Use the following shortcode in to the page or post

[tx_responsive_slider]

Or you can use following code into the php file 

<?php echo do_shortcode( '[tx_responsive_slider]' );?>

== Installation ==

1. Upload the plugin folder `responsive-slider` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the "Plugins" menu in WordPress. A new item **"Responsive Slider"** would appear in the admin menu (under "Media"). 
1. Go to **Responsive Slider -> Settings** and configure the slider options.
1. Go to **Responsive Slider -> Add Responsive Slider** and create a few slides.
1. Place `<?php echo do_shortcode( '[tx_responsive_slider]' ); ?>` in your template - wherever you want it displayed. Alternatively you can use `[tx_responsive_slider]` into a post or a page
1. That's it. Your site should now display the slider at the chosen location.


== Changelog ==
= 0.1 =
* Initial release.

