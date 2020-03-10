jQuery( document ).ready( function(){
jQuery('video').each( function (){
	//new Gutenberg videos/audio don't recive an Id just create one a 36 string should be unique enough
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
		//videos with the Gutenberg editor will break when this is not used as WP calculates ratio by height/width
		jQuery(this).attr('height',this.offsetHeight);
		jQuery(this).attr('width',this.offsetWidth );
	
			var settings = { 
				pluginPath : mediaelementjs.pluginPath,
				stretching : 'responsive',
				defaultVideoWidth: '100%',
            defaultVideoHeight: '100%',
             videoWidth: '100%',
            videoHeight: '100%'
			}
	
	player =  new MediaElementPlayer(this.id,settings);

	
});

jQuery('audio').each( function (){
	//new Gutenberg videos/audio don't recive an Id just create one a 36 string should be unique enough
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
		//videos with the Gutenberg editor will break when this is not used as WP calculates ratio by height/width
		jQuery(this).attr('height',this.offsetHeight);
		jQuery(this).attr('width',this.offsetWidth );
	
			var settings = { 
				pluginPath : mediaelementjs.pluginPath,
				stretching : 'responsive',
				defaultVideoWidth: '100%',
            defaultVideoHeight: '100%',
             videoWidth: '100%',
            videoHeight: '100%'
			}
	
	player =  new MediaElementPlayer(this.id,settings);

	
});


});
