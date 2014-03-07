$(function(){

	$('#mon_bouton').click(function(){
		$('.date_img p:last-child').remove();
		$.get('ajax.php', function(data){
			var par=$('<p/>');
			par.text(data);
			par.appendTo('.date_img');
		});
	});

	var numpage=$('.inputnumpage').attr('value');
	console.log(numpage);

	/*$('.next').click(function(e){
		e.preventDefault();
		console.log(e);
	});*/
});