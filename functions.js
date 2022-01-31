

//<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

//cntrl shift p install package installer, daarna jquery 

$(document).ready(function(){
	
	//hide je main div (bijv: $('#display').hide() . 
	//header inlude(display.php) stop daarin display hhtml met ja en nee knoppen
	 
 		var link = null; 
 		$("a").click(function(){
			link = $(this).attr('href');

			$('#display').show();
			 
			 var deletecheck = 'delete';
			 console.log(deletecheck);

			 if(link.includes(deletecheck))
			 {
			 	$("a").attr({
			 		href: '#' 
			 	 
			 	});
			 }
				//$('#display').show() om  het display te laten zien 1
				//link = (string),  check string op het woord delete 2
				//if link heeft het woord delete  3
				//met attr href link zetten op: # zodat a href je niet doorstuurd  4

 		});

 		$("#ja").click(function(){
 				// window.location.href = link  //navigeert je browser 
 				window.location.href = link;
 		});
 

 		$("#nee").click(function(){
 				//hide je main div (bijv: $('#display').hide()
 				$('#display').hide();
 		});



});

