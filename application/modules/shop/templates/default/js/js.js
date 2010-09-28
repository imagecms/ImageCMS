$(document).ready(function(){
    // Cufon - Style Font
	//Cufon.replace('#header .right',{fantFamily:'Kartika'});
	//Cufon.replace('#navigation .item',{fantFamily:'Kartika'});	
	//Cufon.replace('h1,h2,h3,h4,h5,h6',{fantFamily:'Kartika',hover:true});
	//Cufon.replace('#title,.title',{fantFamily:'Kartika',hover:true});
	//Cufon.replace('.product .name',{fantFamily:'Kartika',hover:true});	
	//Cufon.replace('#titleExt .left',{fantFamily:'Kartika',hover:true});
	//Cufon.replace('#title',{fantFamily:'Kartika'});	
	//Cufon.replace('#table .head',{fantFamily:'Kartika'});		
	//Cufon.replace('#total .label,#buttons .button',{fantFamily:'Kartika',hover:true});
// Menu 
$("#navigation ul").superfish({ 
            delay:       1000,                            // one second delay on mouseout 
            animation:   {opacity:'fast',height:'show'},  // fade-in and slide-down animation 
            speed:       'slow',                          // faster animation speed 
            autoArrows:  false,                           // disable generation of arrow mark-up 
            dropShadows: false                            // disable drop shadows 
        });

});
