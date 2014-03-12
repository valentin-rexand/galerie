$(function(){

	$('#mon_bouton').click(function(){
		$('.date_img p:last-child').remove();
		$.get('ajax.php', {action: 'date'}, function(data){
			var par=$('<p/>');
			par.text(data);
			par.appendTo('.date_img');
		});
	});

	// TODO : ALLEGER LE CODE ET LES REPETITIONS --> bt last, prev et autre, bt de navigations a réjouter : chiffres de pages jusqua nbpage
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

		var btlast=$('.last').attr('href');
		btlast=btlast.split("=");
		if(num_page>1){
			$('.first').show();
			$('.previous').show();
		} else if(num_page=parseInt(btlast[1])){
			$('.next').hide();
			$('.last').hide();
		}
	});

	$('.previous').click(function(e){
		e.preventDefault();
		num_page=(parseInt(num_page))-1;

		navigation(num_page);

		var btnext=$('.next').attr('href');
		btnext=btnext.split("=");
		$('.next').attr('href', btnext[0]+"="+(parseInt(btnext[1])-1));

		var val_getpage=$('.inputnumpage').attr('value', num_page);

		if(num_page==1){
			$('.first').hide();
			$('.previous').hide();
		} else {
			$('.next').show();
			$('.last').show();
		}

		var btprev=$('.previous').attr('href');
		btprev=btprev.split("=");
		$('.previous').attr('href', btprev[0]+"="+(parseInt(btprev[1])-1));

	});

	$('.first').click(function(e){
		e.preventDefault();
		num_page=1;
		navigation(num_page);

		var btnext=$('.next').attr('href');
		btnext=btnext.split("=");
		$('.next').attr('href', btnext[0]+"="+2);
		var val_getpage=$('.inputnumpage').attr('value', "1");
		$('.first').hide();
		$('.previous').hide();
		$('.next').show();
		$('.last').show();
	});

	$('.last').click(function(e){
		e.preventDefault();
		var btlast=$('.last').attr('href');
		btlast=btlast.split("=");
		num_page=parseInt(btlast[1]);

		navigation(num_page);

		var val_getpage=$('.inputnumpage').attr('value', num_page);
		$('.next').hide();
		$('.last').hide();
		$('.previous').show();
		$('.first').show();
		var btprev=$('.previous').attr('href');
		btprev=btprev.split("=");
		$('.previous').attr('href', btprev[0]+"="+(num_page-1));

	});

});