$(document).ready(function(){

	$('.mapnavgation ul li a').click(function(){  

		$('.close').fadeIn(150);

		var divid = '';

		divid = $(this).attr('data-id');

		//console.log(divid);

		$('[data-map]').fadeOut(100);

		$('#'+divid).fadeIn(100);



		$('[data-map] span').removeClass('animated tada');

		$('#'+divid+' span').addClass('animated tada');

	});



	$('.close').click(function(){

		$('[data-map]').fadeOut(100);

		$(this).fadeOut();

	});







	function onResize(){

		if($(window).width() <= 767){

				$('.mnbtn').click(function(e){

			    	e.stopPropagation();

			    	$('.mapnavgation').stop().toggle(100);

			    	$('.tooltip').css({'display':'none'});

			    });



			    $('body, [data-map] span').click(function(e){		

					if(!$(e.target).closest('.mapnavgation').length &&  $('.mnbtn').length) {

					    $('.mapnavgation').css({display:'none'});		    

				    }

				});

			}



		// if($(window).width() <= 479){

		// 	//$('[data-map] span').removeClass('tl tr bl br bt tp');

		// }		

	}

	onResize();



	$( window ).resize(function() {

		onResize();

	});

	



	var locationsdata = $.getJSON( basepath+"front-end/js/kanpur-locations.json", function() {}); 



	$('[data-map] span').click(function(e){ 

		e.stopPropagation();	

		$('[data-map] span').removeClass('animated tada');

		 var data_map = '';

		 var result = '';

		data_map = $(this).parent('div[data-map]').attr('data-map');		

		var loctions = $(this).attr('data-locations');

		//console.log(JSON.stringify(locationsdata.responseJSON[data_map]));exit;

		result = locationsdata.responseJSON[data_map];	

		console.log(loctions);	

		result = result[loctions-1];	

		//result = {'image':'https://www.mmrcl.com/map/img/locations/parlecolleges.jpg','alt':'No Image','locationname':'Location name','detail':'df gffdgfd gfdg fdgfd'};	



			if(result){		

				var data = '<div class="tooltip"><P><img src="'+basepath+'front-end/'+result.image+'" alt="'+result.alt+'" /><strong>'+result.locationname+'</strong><span>'+result.detail+'</span></p></div>'

				

				$(this).html(data);

				

			}

			else{

				alert('!For this result there is no-data in json.');

			}			

		$('.tooltip').css({'display':'none'});

		$(this).children('.tooltip').fadeIn(200);	



	});

	

	$('body').click(function(e){

		if(!$(e.target).closest('.tooltip').length) {

		    $('.tooltip').css({display:'none'});		    

	    }

	});

	

});