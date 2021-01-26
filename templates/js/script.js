jQuery( document ).ready(function() {
	jQuery(".btnLastEvent").click(function(){
		if(document.getElementById("nav")){	
		if(jQuery("#lastEvent").hasClass("windowOpen")){
						
			jQuery("#lastEvent").css("margin-right", "-1000px");
			jQuery(".btnLastEvent").css("margin-right", "0px");
			jQuery("#lastEvent").removeClass("windowOpen"); 
			jQuery("#page").css("margin-right", "0");
						
			
		}else{  
						
			jQuery("#lastEvent").css("margin-right", "0");
			jQuery(".btnLastEvent").css("margin-right", "500px");
			jQuery("#lastEvent").addClass("windowOpen");
			jQuery("#page").css("margin-right", "25%"); 
			
			if(jQuery("#nav").hasClass("navOpen")){
				var windowWidth = jQuery(window).width();
				if(windowWidth<768){
					jQuery("#page").css("margin-left", "0");
					jQuery("#nav").css("width", "0");
					jQuery(".deplier").remove();
					showOpenBurger();
				}else{
			
					jQuery("#page").css("margin-left", "70px");
					jQuery("#nav").css("width", "70px");
					//jQuery("#nav #menu-primary-nav>li a").css("display", "none");
					//jQuery("#nav #menu-primary-nav>li ul").css("display", "none");
					jQuery(".deplier").remove();
					showOpenBurger();
				}
			}
								
		}
		}else{
			jQuery("#lastEvent").css("margin-right", "0");
			jQuery(".btnLastEvent").css("margin-right", "500px");
			jQuery("#mn_event").css("padding-top", "10px");
			jQuery("#lastEvent").addClass("windowOpen");
			jQuery("#page").css("margin-right", "25%");
		}
    });
//----------------------------- PAGE LOGIN ----------------------------------------
	//----------------------- Champs identifiant -----------------------------------
	jQuery("#user_login").click(function(){
		
		var conteneur = jQuery(this).parent();
		var inputParent = conteneur[0]["classList"][0];
		
		//console.log(conteneur[0]["classList"][0]);
		
		jQuery("."+inputParent).css("border-bottom", "2px solid #880000");
		
	});
	jQuery( "input#user_login" ).change(function() {
		
		var conteneur = jQuery(this).parent();
		var inputParent = conteneur[0]["classList"][0];
		
		jQuery("."+inputParent).css("border-bottom", "1px solid #d4d4d4");
	});
	
	//----------------------- Champs mot de passe -----------------------------------
	
	jQuery("#user_pass").click(function(){
		
		var conteneur = jQuery(this).parent();
		var inputParent = conteneur[0]["classList"][0];
		
		//console.log(conteneur[0]["classList"][0]);
		
		jQuery("."+inputParent).css("border-bottom", "2px solid #880000");
		
	});
	jQuery( "input#user_pass" ).change(function() {
		
		var conteneur = jQuery(this).parent();
		var inputParent = conteneur[0]["classList"][0];
		
		jQuery("."+inputParent).css("border-bottom", "1px solid #d4d4d4");
	});
	
	//------------------------ Afficher plus d'options ----------------------------------
	
	jQuery(".moreOptions").click(function(e){
		e.preventDefault();
		if(jQuery(".moreOptionsBox").hasClass("open")){
			jQuery(".moreOptionsBox").css("display", "none");
			jQuery(".moreOptionsBox").css("height", "0");
			jQuery(".moreOptionsBox a").css("display", "none");
			jQuery(".moreOptionsBox").removeClass("open");
			jQuery(".moreOptions span").removeClass("dashicons-arrow-up-alt2");
			jQuery(".moreOptions span").addClass("dashicons-arrow-down-alt2");
		}else{
			jQuery(".moreOptionsBox").css("display", "block");
			jQuery(".moreOptionsBox").css("height", "auto");
			jQuery(".moreOptionsBox a").css("display", "block");
			jQuery(".moreOptionsBox").addClass("open");
			jQuery(".moreOptions span").removeClass("dashicons-arrow-down-alt2");
			jQuery(".moreOptions span").addClass("dashicons-arrow-up-alt2");
			
		}
		
	});
	
//----------------------------- PAGE INSCRIPTION ----------------------------------------
	//----------------------- Champs Nom -----------------------------------
	var arr = [ "#last_name", "#first_name", "#email", "#username", "#pwd1", "#pwd2", "#emailNoPwd" ];
	jQuery.each( arr, function( i, val ) {
		jQuery(val).click(function(){
			
			var conteneur = jQuery(this).parent();
			var inputParent = conteneur[0]["classList"][0];
			
			//console.log(conteneur[0]["classList"][0]);
			
			jQuery("."+inputParent).css("border-bottom", "2px solid #880000");
			
		});
		jQuery( "input"+val ).change(function() {
			
			var conteneur = jQuery(this).parent();
			var inputParent = conteneur[0]["classList"][0];
			
			jQuery("."+inputParent).css("border-bottom", "1px solid #d4d4d4");
		});
	});
});
