/* 
jQuery('video').each( function (){
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
	
	var div = jQuery('<div></div>').attr('id',this.id+"_parent");
	div.insertBefore(this);
	console.log(this.height);
	if(this.height > 0 && this.width > 0){
		
		div.attr('height',this.height);
		div.attr('width',this.width);
		
	}
	this.removeAttribute('height');
	this.removeAttribute('width');
	this.style.height="100%";
	this.style.width="100%";
	
	jQuery(this).appendTo(div);
	jQuery(this).mediaelementplayer({
		pluginPath: mediaelementjs.pluginPath+'/mediaelement/build/',
		features : ['playpause','current','progress','duration','volume'],		
	})
});

jQuery('audio').mediaelementplayer({
		pluginPath: mediaelementjs.pluginPath+'/mediaelement/build/',
		features : ['playpause','current','progress','duration','volume'],		
})