jQuery( document ).ready( function(){
jQuery('video').each( function (){
	
	if(this.id == ''){
		//make sure its unique
		this.id = 'video-'+Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);		
	}
	//create a new div to insert the video inside
	var div = jQuery('<div></div>').attr('id',this.id+"_parent");
	//just insert it above
	div.insertBefore(this);
	//set height and width of current video into the new div
	if(this.offsetWidth > 0 && this.offsetHeight > 0){
		div.attr('height',this.offsetHeight);
		div.attr('width',this.offsetWidth );	
	}
	//remove all sizes
		jQuery(this).attr('height',this.offsetHeight);
		jQuery(this).attr('width',this.offsetWidth );
	
	//move viddeo to new div
	jQuery(this).appendTo(div);
	
	//load MEJS width 100% width and height
	player =  new MediaElementPlayer(this.id,
	{
            defaultVideoWidth: '100%',
            defaultVideoHeight: '100%',
             videoWidth: '100%',
            videoHeight: '100%',
	});
	
});
});
