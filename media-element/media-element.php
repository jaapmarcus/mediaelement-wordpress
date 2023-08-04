<?php
/*
Plugin Name: MediaElement.js - HTML5 Audio and Video
Plugin URI: https://mediaelementjs.com/
Description: Video and audio plugin for WordPress built on MediaElement.js HTML5 video and audio player library. Embeds media in your post or page using HTML5 with Flash or Silverlight fallback support for non-HTML5 browsers. Video support: MP4, Ogg, WebM, WMV. Audio support: MP3, WMA, WAV
Author: John Dyer, Jaap Marcus
Version: 7.0.0
Author URI: https://www.mediaelementjs.com/
Text Domain: media-element
Domain Path: /languages/
License: MIT
*/		

define('MEJS_VERSION','7.0.0');
Class MediaElements {
	
	var $options = '';
		function init(){
		
		$opt = get_option('mediaelementjs');
		$default = array('playsinline' => false, 'poster' => false, 'remove' => false, 'css' => array(), 'extra' => array(), 'features' => '', 'advanced' => '');
				if(is_array($opt)){
						$this -> options = array_merge( $default, $opt);
						if($this -> options['advanced'] == ''){
							$this -> options['advanced'] = json_encode(array('iconSprite' => plugins_url("media-element/dist/mejs-controls.svg")));
						}else{
							$advanced_options = json_decode($this -> options['advanced'], true);
							$sprite=array('iconSprite' => plugins_url("media-element/dist/mejs-controls.svg"));
							$this -> options['advanced'] = json_encode(array_merge($sprite, $advanced_options));
						}            
				}else{
				$this -> options = $default;
				}
		//remove WP Media Elements 
		wp_deregister_script('mediaelement');
		wp_deregister_style('wp-mediaelement');
		wp_deregister_script('wp-mediaelement');
			
		//Add our own
		add_action('wp_head',array($this, 'addHeader'));
		//incase of loading additional plugins with a second plugin same functions can be used
		add_action('wp_footer',array($this, 'addFooter'),1);
		
		remove_shortcode('video');
		add_shortcode('video', Array($this, 'Video'),8);
	}
	
		public function Video($args, $content = ''){
		global $post;
		if(!empty($this -> options['poster'])){
		if(empty($args['poster'])){
			if(has_post_thumbnail($post)){
				$args['poster'] = get_the_post_thumbnail_url($post);
			}else{
				$args['poster'] = '';
			}
		}
		}
		if(!empty($this -> options['remove'])){
			unset($args['width'],$args['height']);	
		}
		
		$output = wp_video_shortcode( $args, $content);
		if($this -> options['playsinline']){
			return str_replace('<video ', '<video playsinline ', $output);
		}else{
			return $output;
		}
	}	
	
		public function addHeader(){
		wp_enqueue_style('mediaelementjs-styles', plugins_url("media-element/dist/mediaelementplayer.min.css"), array(), MEJS_VERSION, false);
		wp_enqueue_style('mediaelementjs-style', plugins_url("media-element/mediaelement.css"), array(), MEJS_VERSION, false);
				if(!empty($this -> options['css'])){
						$scripts = explode(',',$this -> options['css']);
						//also support loading css
						foreach($scripts as $script){
								wp_enqueue_style(basename($script), $script,array(), MEJS_VERSION);
						}		
				}		
		
		
	}
		public function addFooter(){
		wp_enqueue_script('mediaelementjs-player-test', plugins_url("media-element/dist/mediaelement-and-player.min.js"), array(), MEJS_VERSION);
		wp_enqueue_script('mediaelementjs', plugins_url("media-element/mediaelement.js"), MEJS_VERSION);
		if(!empty($this -> options['extra'])){
				$scripts = explode(',',$this -> options['extra']);
				foreach($scripts as $script){
					wp_enqueue_script(basename($script), $script,array(), MEJS_VERSION);
				}
				}
		wp_localize_script('mediaelementjs', 'mediaelementjs', array('pluginPath' => plugins_url(), 'options' => $this -> options));
		
		
	}
	
}
if(!is_admin()){
	
	$cls = new MediaElements();
	
	add_action('init', array($cls, 'init'));
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
		add_settings_section(
			'mediaelements-settings-advanced', // id
			__('Advanced','media-element'), // title
			array( $this, 'advanced_info' ), // callback
			'mediaelements-settings' // page
		);
		add_settings_section(
			'mediaelements-settings-extra', // id
			__('Additional Plugins / Renderers','media-element'), // title
			array( $this, 'extra_info' ), // callback
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
			'poster', // id
			__('Poster','media-element'), // title
				array( $this, 'poster' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-features',
		);
		add_settings_field(
			'remove', // id
			__('Remove width / height','media-element'), // title
				array( $this, 'remove' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-features',
		);		
		add_settings_field(
			'playsinline', // id
			__('Plays Inline','media-element'), // title
				array( $this, 'playsinline' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-features',
		);		
		
		
		add_settings_field(
			'advanced', // id
			__('Advanced','media-element'), // title
				array( $this, 'advanced' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-advanced',
		);
		

		
		add_settings_field(
			'extra', // id
			__('Additional Plugins / Renderers','media-element'), // title
				array( $this, 'extra' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-extra',
		);
		add_settings_field(
			'css', // id
			__('Additional Css Files','media-element'), // title
				array( $this, 'css' ), // callback
			'mediaelements-settings',
			'mediaelements-settings-extra',
		);				
	
	}

function advanced_info(){
		?>
		<div class="">
			<p><?php _e('Additional settings can be loaded when necessary.','media-element');?></p>
			<p><?php _e('The Syntax for those settings are a valid json string','media-element');?></p>
			<p>{ "pauseOtherPlayers":false}</p>
			<p><?php _e('This example will not pause any other player in the page','media-element');?></p>
			<p><?php _e('When empty default settings are used','media-element','media-element');?></p>
		</div>
		<?php
	}


	function extra_info(){
	?>	
		<div class="">
			<p><?php _e('Please provide a comma separated list with all the required plugins / renderers','media-element');?></p>
			<p><a href="https://github.com/mediaelement/mediaelement/tree/master/build/renderers"><?php _e('Renderers','media-element');?></a> <?php _e('or');?> <a href="https://github.com/mediaelement/mediaelement-plugins"><?php _e('Plugins','media-element');?></a></p>
			<p><?php echo plugins_url('/media-element/files/');?></p>
		</div>
		<?php
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
			$sanitary_values['advanced'] = $input['advanced'];
			//in some cases mainly advertisign an url needs the be pasted in how very sanitize_text_field breaks it	
			//posible security issue	
		}
		if ( isset( $input['extra'] ) ) {
			$sanitary_values['extra'] = sanitize_text_field( $input['extra'] );		
		}
		if ( isset( $input['css'] ) ) {
			$sanitary_values['css'] = sanitize_text_field( $input['css'] );		
		}
		if ( isset( $input['remove'] ) ) {
			$sanitary_values['remove'] = sanitize_text_field( $input['remove'] );		
		}
		if ( isset( $input['poster'] ) ) {
			$sanitary_values['poster'] = sanitize_text_field( $input['poster'] );		
		}
		if ( isset( $input['playsinline'] ) ) {
			$sanitary_values['playsinline'] = sanitize_text_field( $input['playsinline'] );		
		}
				
		return $sanitary_values;
	}
	function remove(){
		printf(
			'<input class="regular-text" type="checkbox" name="mediaelementjs[remove]" id="remove" %s value="1"> Remove width / height attribute in video (Classic editor only)',
			isset( $this->settings['remove'] ) ? 'checked' : ''
		);
	}
	function poster(){
		printf(
			'<input class="regular-text" type="checkbox" name="mediaelementjs[poster]" id="poster" %s value="1"> Use featured image as poster when no poster has been set? (Classic editor only)',
			isset( $this->settings['poster'] ) ? 'checked' : ''
		);
	}
	function playsinline(){
		printf(
			'<input class="regular-text" type="checkbox" name="mediaelementjs[playsinline]" id="poster" %s value="1"> Add playsinline attribute to video tag? (Classic editor only)',
			isset( $this->settings['playsinline'] ) ? 'checked' : ''
		);
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

	function extra(){
		printf(
			'<textarea class="regular-text" type="text" name="mediaelementjs[extra]" id="extra">%s</textarea>',
			isset( $this->settings['extra'] ) ? esc_attr( $this->settings['extra']) : ''
		);
	}	
	function css(){
		printf(
			'<textarea class="regular-text" type="text" name="mediaelementjs[css]" id="css">%s</textarea>',
			isset( $this->settings['css'] ) ? esc_attr( $this->settings['css']) : ''
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
