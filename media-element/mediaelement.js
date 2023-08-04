document.addEventListener("DOMContentLoaded", () => {
	videos=document.getElementsByTagName('video');
	
	Array.from(videos).forEach(function (video) {
		console.log(video);
		if(video.id == ''){
			//make sure its unique
			video.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
		}

		//set height / width
		video.setAttribute('height',video.offsetHeight);
		video.setAttribute('width',video.offsetWidth);
		video.setAttribute('style','width:'+video.offsetWidth+'; height:'+video.offsetHeight);

		var settings = { 
			stretching : "responsive",
			enableAutosize : false
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

		player =  new MediaElementPlayer(video.id,newSettings);
	});
	audios=document.getElementsByTagName('audio');
	
	Array.from(audios).forEach(function (audio) {
		console.log(video);
		if(video.id == ''){
			//make sure its unique
			video.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
		}
	
		//set height / width
		video.setAttribute('height',video.offsetHeight);
		video.setAttribute('width',video.offsetWidth);
	
		var settings = { 
			stretching : "responsive",
			enableAutosize : false
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
	
		player =  new MediaElementPlayer(video.id,newSettings);
	});
});

