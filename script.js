$(function(){

	$('#mon_bouton').click(function(){
		$('.date_img p:last-child').remove();
		$.get('ajax.php', {action: 'date'}, function(data){
			var par=$('<p/>');
			par.text(data);
			par.appendTo('.date_img');
		});
	});

	$('.next').click(function(e){
		e.preventDefault();
		var num_page = $('.inputnumpage').attr('value');
		num_page=parseInt(num_page);

		$.get('ajax.php', {action: 'nav', page:num_page+1}, function(data){
			var gallery=$('<div/>', {class: 'gallery'});
				var div=$('<div/>', {class: 'image'}).appendTo(gallery);
			for (var i in data['images']){

				var lien=$('<a/>', {href: 'image.php?id='+data['images'][i]['id']+'&page='+(num_page+1)});
				lien.appendTo(div);

				var img=$('<img/>', {src: 'images/'+data['images'][i]['nom_fichier'], width:'150', alt: data['images'][i]['nom']});
				img.appendTo(lien);
			}
			$('.gallery').replaceWith(gallery);
		});
		//découpe du href pour le bt next
		var btnext=$('.next').attr('href');
		btnext=btnext.split("=");
		console.log(btnext[1]);
		$('.next').attr('href',btnext[0]+"="+(parseInt(btnext[1])+1));

		var val_getpage=$('.inputnumpage').attr('value', num_page+1);
	});
});