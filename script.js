$(function(){

	$('#mon_bouton').click(function(){
		$('.date_img p:last-child').remove();
		$.get('ajax.php', {action: 'date'}, function(data){
			var par=$('<p/>');
			par.text(data);
			par.appendTo('.date_img');
		});
	});
/*
	var numpage=$('.inputnumpage').attr('value');
	console.log(numpage);
*/
/*
	$('.next').click(function(e){
		e.preventDefault();
		$.get('ajax.php', {action: 'next'}, function(data) {
			console.log(data);
			//$(this).attr(href);
		});
	})
	$('.first').click(function(e){
		e.preventDefault();
		$.get('ajax.php', {action: 'first'}, function(data){
			console.log(data);
			$(this).attr("href");
		})
	})*/
	$('.next').click(function(e){
		e.preventDefault();
		//$('.gallery').hide();
		$.get('ajax.php', {action: 'next'}, function(data){
			var gallery=$('.gallery').replaceWith('<div/>', {class: 'gallery'});
			console.log(data);
		})
		//$('.gallery').show();
	})
});