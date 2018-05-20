jQuery( document ).ready( function( $ ){

	$( '#nav ul' ).onePageNav( { 
		scrollSpeed: 400,
		currentClass: 'current',
 	   	changeHash: false,
	} );

	$(window).scroll(function(){
		if($(window).scrollTop() < $(window).height()/2) {
			$('#nav').find('li').removeClass('current');
		}
	});

	// Full background image
	$( '.fx-backstretch' ).find( '.info' ).backstretch( 'assets/img/backstretch-min.jpg' ); // Replace backstrech.jpg with your own image if needed
});
