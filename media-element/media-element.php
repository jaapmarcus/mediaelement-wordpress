<?php
/*
Plugin Name: MediaElement.js - HTML5 Audio and Video
Plugin URI: https://mediaelementjs.com/
Description: Video and audio plugin for WordPress built on MediaElement.js HTML5 video and audio player library. Embeds media in your post or page using HTML5 with Flash or Silverlight fallback support for non-HTML5 browsers. Video support: MP4, Ogg, WebM, WMV. Audio support: MP3, WMA, WAV
Author: John Dyer, Jaap Marcus
Version: 4.2.8
Author URI: https://mediaelementjs.com/
License: MIT
*/

/*
	Add Media Elements CSS belongs in head	
*/

function mejs_add_header(){
	if(!is_admin()){
		wp_enqueue_style('mediaelementjs-styles', plugins_url("media-element/files/mediaelementplayer.css"), array(), "4.2.14", false);
	}

}
/*
	Add Media Elements Javascript options to footer	
*/
function mejs_add_footer(){
	if(!is_admin()){
		wp_enqueue_script('mediaelementjs-player', plugins_url("media-element/files/mediaelement-and-player.js"), array(), "4.2.14");
		wp_enqueue_script('mediaelementjs-js', plugins_url("media-element/mediaelement.js"), array('jquery'), "4.2.14");
		wp_localize_script('mediaelementjs-js', 'mediaelementjs', array('pluginPath' => plugins_url()));
	}
}

/* Function
	deregister_media_elements()
	Remove Media Elements not known to be last version	
*/
 function deregister_media_elements(){
   wp_deregister_script('wp-mediaelement');
   wp_deregister_style('wp-mediaelement');

}
//remove Current Wordpress verison from Media Element still a version bakked in to it
add_action('wp_enqueue_scripts','deregister_media_elements');

//Inject code into header andd footer
add_action('wp_head','mejs_add_header');
add_action('wp_footer','mejs_add_footer');


?>