jQuery( document ).ready( function(){
jQuery('video').each( function (){
	
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
		//don't know why but just remove it
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
	
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
		//don't know why but just remove it
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
