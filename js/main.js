// *********************************************************************************************************
// 		main.js
// 		Javascript custom code for for medicinecreek wordpress theme
//		Dorian Sutton 2014
// *********************************************************************************************************

jQuery(document).ready( function($) { 
	
	var menuOuter = $( "#menu-menu" );
	var hamburgerButton = $( "#hamburger-button" );
	
	hamburgerButton.on( "click", function() {
	
		menuOuter.toggleClass( "menu-visible" );
		return false;
	
	});
 	
});