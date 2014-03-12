$(function(){

	$('#mon_bouton').click(function(){
		$('.date_img p:last-child').remove();
		$.get('ajax.php', {action: 'date'}, function(data){
			var par=$('<p/>');
			par.text(data);
			par.appendTo('.date_img');
		});
	});

	function navigation(num_page){
		var gallery=$('<div/>', {class: 'gallery'});
		var div=$('<div/>', {class: 'image'}).appendTo(gallery);
		$.get('ajax.php', {action: 'nav', page:num_page}, function(data){
		for (var i in data['images']){
			var lien=$('<a/>', {href: 'image.php?id='+data['images'][i]['id']+'&page='+(num_page)});
			lien.appendTo(div);
			var img=$('<img/>', {src: 'images/'+data['images'][i]['nom_fichier'], width:'150', alt: data['images'][i]['nom']});
			img.appendTo(lien);
			}
		});
		$('.gallery').replaceWith(gallery);
	}

	var num_page = $('.inputnumpage').attr('value');

	$('.next').click(function(e){
		e.preventDefault();
		num_page=(parseInt(num_page))+1;

		navigation(num_page);
		
		//découpe du href pour le bt next
		var btnext=$('.next').attr('href');
		btnext=btnext.split("=");
		$('.next').attr('href',btnext[0]+"="+(parseInt(btnext[1])+1));

		//btprev
		var btprev=$('.previous').attr('href');
		btprev=btprev.split("=");
		$('.previous').attr('href', btprev[0]+"="+(parseInt(btprev[1])+1));

		//incrémentation du numéro de page dans l'input hidden
		var val_getpage=$('.inputnumpage').attr('value', num_page);
	});

	$('.previous').click(function(e){
		e.preventDefault();
		num_page=(parseInt(num_page))-1;

		navigation(num_page);

		var btnext=$('.next').attr('href');
		btnext=btnext.split("=");
		$('.next').attr('href', btnext[0]+"="+(parseInt(btnext[1])-1));

		var btprev=$('.previous').attr('href');
		btprev=btprev.split("=");
		$('.previous').attr('href', btprev[0]+"="+(parseInt(btprev[1])-1));

		var val_getpage=$('.inputnumpage').attr('value', num_page);
	});

	$('.first').click(function(e){
		e.preventDefault();
	});
});