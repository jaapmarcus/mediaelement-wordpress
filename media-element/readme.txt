=== MediaElement.js - HTML5 Video & Audio Player ===
Contributors: johndyer jaapmarcus
Donate link: http://mediaelementjs.com/
Tags: html5, video, audio, player, flash, mp4, mp3, ogg, webm, wmv, captions, subtitles, websrt, srt, accessible, Silverlight, javascript,
Requires at least: 2.9
Tested up to: 4.9
Stable tag: 4.2.8

MediaElement.js is an HTML5 video and audio player with Flash fallback and captions. Supports IE, Firefox, Opera, Safari, Chrome and iPhone, iPad, Android.

==Still to be updated==
== Description ==

Video and audio plugin for WordPress built on the MediaElement.js HTML5 media player library. Provides Flash or Silverlight fallback players for non-HTML5 browsers. Supports iPhone, iPad, and Andriod.
Supports MP4, OGG, WebM, WMV, MP3, WAV, WMA files as well as captions with WebSRT files.

Check out <a href="http://mediaelementjs.com/">mediaElementjs.com</a> for more information and examples.

== Guteberg Support ==

This plugin will convert all Gutenberg Video and Audio block to Mediaelement JS video player. This plugin will support the default video block. 



= Multiple sources =

Currently there are in the Gutenberg blocks no easy way to add multiple sources for example webm and mp4. (See  https://github.com/WordPress/gutenberg/issues/7673)
How ever when you edit the html source you can add multiple sources

== Short Codes ==

This plugin uses the default behaviour of the Video and Audio Short tag. How ever Vimeo Support is not enabled by default Please add by default /wp-content/plugins/media-element/dist/renderers/vimeo.min.js on the Settings Page --> Mediaelement JS Settings --> Aditional Plugin / Renderers


= Simple Video =
Basic playback options

    [video src="http://mysite.com/mymedia.mp4" width="640" height="360"]

= All Attributes Video =
All options enabled

    [video mp4="http://mysite.com/mymedia.mp4" ogg="http://mysite.com/mymedia.ogg" webm="http://mysite.com/mymedia.webm" poster="http://mysite.com/mymedia.png" preload="true" autoplay="true" width="640" height="264"]

= Simple Audio =
Basic playback options

    [audio src="http://mysite.com/mymedia.mp3"]

= All Attributes Audio =
All options enabled

    [audio mp3="http://mysite.com/mymedia.mp3" ogg="http://mysite.com/mymedia.ogg" preload="true" autoplay="true"]


###  Use in a template
You can use Wordpress shortcodes in your templates using the do_shortcode function.

	<?php echo do_shortcode('[video src="myvfile.mp4"]'); ?>


== Installation ==

View <a href="http://mediaelementjs.com/">MediaElementjs.com</a> for more information.

1. Upload the `media-element-html5-video-and-audio-player` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the `Plugins` menu in WordPress
3. Use the `[video]` or `[audio]` shortcode in your post or page with the options on the front page.

== Changelog ==

For change log MediaelementJS See https://github.com/mediaelement/mediaelement/blob/master/changelog.md



== Upgrade Notice ==

None

== Frequently Asked Questions ==

= Where can I find out more? =

Check out <a href="http://mediaelementjs.com/">mediaElementjs.com</a> for more examples

= What does this get me over other HTML5 players? =

Most HTML5 players offer one player to modern browsers and then a competely separate Flash player to older browser. This creates an inconsistent look and functionality.

Instead, MediaElement.js upgrades older browsers, using Flash to mimic the entire HTML5 Media API. Then once all the browsers have something that looks like HTML5 Media, we build a consistent player on top using just HTML and CSS.

See original blog post at <a href="http://johndyer.name/post/MediaElement-js-a-magic-unicorn-HTML5-video-library.aspx">johndyer.name</a> for a full explanation of MediaElement.js

== Screenshots  ==

1. Video player