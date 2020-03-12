<?php
/*
Plugin Name: MediaElement.js - HTML5 Audio and Video
Plugin URI: https://mediaelementjs.com/
Description: Video and audio plugin for WordPress built on MediaElement.js HTML5 video and audio player library. Embeds media in your post or page using HTML5 with Flash or Silverlight fallback support for non-HTML5 browsers. Video support: MP4, Ogg, WebM, WMV. Audio support: MP3, WMA, WAV
Author: John Dyer, Jaap Marcus
Version: 4.2.8
Author URI: https://mediaelementjs.com/
Text Domain: media-element
Domain Path: /languages/
License: MIT
*/		
Class MediaElements {
	static function init(){
		
		//remove WP Media Elements 
		wp_deregister_script('mediaelement');
			
		//Add our own
		add_action('wp_head',array('MediaElements', 'addHeader'));
		add_action('wp_footer',array('MediaElements', 'addFooter'));

	}
	
	static public function addHeader(){
		wp_enqueue_style('mediaelementjs-styles', plugins_url("media-element/files/mediaelementplayer.css"), array(), "4.2.14", false);
	}
	static public function addFooter(){
		wp_enqueue_script('mediaelementjs-player-test', plugins_url("media-element/files/mediaelement-and-player.js"), array(), "4.2.14");
		wp_enqueue_script('mediaelementjs', plugins_url("media-element/mediaelement.js?random=".rand(0,100000)), array('jquery'), "4.2.14");
		wp_localize_script('mediaelementjs', 'mediaelementjs', array('pluginPath' => plugins_url(), 'options' => get_option('mediaelementjs')));
	}
	
}
if(!is_admin()){
	add_action('init', array('MediaElements','init'));
}	

Class MediaElementsSettings {
	private $settings;

	function __construct(){
		//add a new page the settings section
		add_action( 'admin_menu', array( $this, 'addPluginPage' ) );
		//register posible settings
		add_action( 'admin_init', array( $this, 'registerSettings' ) );
		
		add_action( 'plugins_loaded',  array( $this, 'textDomain' ));
		
		$this -> settings = get_option( 'mediaelementjs' );
		
	}
	
	function textDomain(){
		load_plugin_textdomain( 'media-element', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
	}
	
	function addPluginPage(){
		add_options_page(
			__('MediaElement JS Settings','media-element'), // page_title
			__('MediaElement JS','media-element'), // menu_title
			'manage_options', // capability
			'mediaelementjs', // menu_slug
			array( $this, 'SettingsPage' ) // function
		);
	}
	
	function registerSettings(){
		register_setting('mediaelementjs',
			'mediaelementjs',
			array( $this, 'santize' ) 
		);
		
		add_settings_section(
			'mediaelements-settings-features', // id
			__('Settings','media-element'), // title
			array( $this, 'basic_info' ), // callback
			'mediaelements-settings' // page
		);
		//options
		//enabled features
		add_settings_field(
			'features', // id
			__('Features','media-element'), // title
				array( $this, 'features' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-features',
		);
		add_settings_field(
			'advanced', // id
			__('Advanced','media-element'), // title
				array( $this, 'advanced' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-features',
		);
	}
	
	function basic_info(){
		?>
		<h3><?php _e('Features','media-element');?></h3>
		<div class="">
			<style>.mejs_options { padding-left: 20px; list-style: disc;} li {} .mejs_info { border: 1px black solid; background-color: white;}</style>
			<p><?php _e('Provide a comma separated with the wanted features.','media-element');?></p>
			<p><?php _e('By default the following options are available.','media-element');?></p>
			<ul class="mejs_options">
				<li>playpause</li>
				<li>current</li>
				<li>progress</li>
				<li>duration</li>
				<li>tracks</li>
				<li>volume</li>
				<li>fullscreen</li>
			</ul>
			<p><?php _e('When empty default settings are used','media-element');?></p>
		</div>
		<?php
	}
	
	function santize($input){
		$sanitary_values = array();
		if ( isset( $input['features'] ) ) {
			$sanitary_values['features'] = sanitize_text_field( str_replace(' ','',$input['features'] ));		
		}
		if ( isset( $input['advanced'] ) ) {
			$sanitary_values['advanced'] = sanitize_text_field( $input['advanced'] );		
		}
		return $sanitary_values;
	}
	
	function features(){
		printf(
			'<input class="regular-text" type="text" name="mediaelementjs[features]" id="features" value="%s">',
			isset( $this->settings['features'] ) ? esc_attr( $this->settings['features']) : ''
		);
	}
	function advanced(){
		printf(
			'<textarea class="regular-text" type="text" name="mediaelementjs[advanced]" id="features">%s</textarea>',
			isset( $this->settings['advanced'] ) ? esc_attr( $this->settings['advanced']) : ''
		);
	}	
	function SettingsPage(){
		?>
		<div class="">
			<h1 class = "wp-heading-inline"><?php _e('MediaElement JS Settings','media-element');?></h1>
			
			<?php settings_errors(); ?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'mediaelementjs' );
					do_settings_sections( 'mediaelements-settings' );
					submit_button();
				?>
			</form>	
		</div>
		<?php
	}
}

if(is_admin()){
	$media = new MediaElementsSettings();
}


	
?>