jQuery( document ).ready( function(){
	
	jQuery('video').each( function (){
	//new Gutenberg videos/audio don't recive an Id just create one a 36 string should be unique enough
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
//videos with the Gutenberg editor will break when this is not used as WP calculates ratio by height/width;
		
		console.log(this.offsetWidth, this.offsetHeight);
				
			var settings = { 
				stretching : "fill",
				pluginPath : mediaelementjs.pluginPath
			}
		
			//console.log(mediaelementjs.options.features);
			
			if(mediaelementjs.options.features != ''){
				mejsfeatures = new Array();
				features = mediaelementjs.options.features.split(',');
				for(i in features){
					//console.log(features[i]);
					mejsfeatures.push(features[i]);
				}
				//console.log(mejsfeatures);
				settings.features = mejsfeatures;
			}
			//console.log(mediaelementjs.options.advanced);
			var advanced = JSON.parse(mediaelementjs.options.advanced);
			
			const newSettings = {...advanced,...settings};

			//console.log(newSettings);
			
	player =  new MediaElementPlayer(this.id,newSettings);
	console.log(newSettings);

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
			}
		
			//console.log(mediaelementjs.options.features);
			
			if(mediaelementjs.options.features != ''){
				mejsfeatures = new Array();
				features = mediaelementjs.options.features.split(',');
				for(i in features){
					//console.log(features[i]);
					mejsfeatures.push(features[i]);
				}
				//console.log(mejsfeatures);
				settings.features = mejsfeatures;
			}
			//console.log(mediaelementjs.options.advanced);
			var advanced = JSON.parse(mediaelementjs.options.advanced);
			
			const newSettings = {...advanced,...settings};
			//console.log(newSettings);
			
			player =  new MediaElementPlayer(this.id,newSettings);

	
	});



});