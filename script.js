$(function(){

	$('#mon_bouton').click(function(){
		$('.date_img p:last-child').remove();
		$.get('ajax.php', {action: 'date'}, function(data){
			var par=$('<p/>');
			par.text(data);
			par.appendTo('.date_img');
		});
	});

	//animation fadeIn/fadeOut
	//facto btnext et autre

	function navigation(num_page){
		$.get('ajax.php', {action: 'nav', page:num_page}, function(data){
		var gallery=$('<div/>', {class: 'gallery'});
		var div=$('<div/>', {class: 'image'}).appendTo(gallery);
		for (var i in data['images']){
			var lien=$('<a/>', {href: 'image.php?id='+data['images'][i]['id']+'&page='+(num_page)});
			lien.appendTo(div);
			var img=$('<img/>', {src: 'images/'+data['images'][i]['nom_fichier'], width:'150', alt: data['images'][i]['nom']});
			img.appendTo(lien);
			}
		$('.gallery').replaceWith(gallery);
		});
	}


	var num_page = $('.inputnumpage').attr('value');

	//btnext
	var btnext=$('.next').attr('href');
	btnext=btnext.split("=");
	//btprev
	var btprev=$('.previous').attr('href');
	btprev=btprev.split("=");
	//btlast
	var btlast=$('.last').attr('href');
	btlast=btlast.split("=");


	$('.next').click(function(e){
		e.preventDefault();
		num_page=(parseInt(num_page))+1;


		navigation(num_page);
		
		$('.next').attr('href',btnext[0]+"="+(parseInt(btnext[1])+1));
		$('.previous').attr('href', btprev[0]+"="+(parseInt(btprev[1])+1));

		//incrémentation du numéro de page dans l'input hidden
		var val_getpage=$('.inputnumpage').attr('value', num_page);

		if((num_page>1) && (num_page<parseInt(btlast[1]))){
			$('.first').show();
			$('.previous').show();
		} else if(num_page==parseInt(btlast[1])){
			$('.next').hide();
			$('.last').hide();
		}
	});

	$('.previous').click(function(e){
		e.preventDefault();
		num_page=(parseInt(num_page))-1;

		navigation(num_page);

		$('.next').attr('href', btnext[0]+"="+(parseInt(btnext[1])-1));

		var val_getpage=$('.inputnumpage').attr('value', num_page);

		if(num_page==1){
			$('.first').hide();
			$('.previous').hide();
		} else {
			$('.next').show();
			$('.last').show();
		}
		$('.previous').attr('href', btprev[0]+"="+(parseInt(btprev[1])-1));

	});

	$('.first').click(function(e){
		e.preventDefault();
		num_page=1;
		navigation(num_page);

		$('.next').attr('href', btnext[0]+"="+2);
		var val_getpage=$('.inputnumpage').attr('value', "1");
		$('.first').hide();
		$('.previous').hide();
		$('.next').show();
		$('.last').show();
	});

	$('.last').click(function(e){
		e.preventDefault();

		num_page=parseInt(btlast[1]);

		navigation(num_page);

		var val_getpage=$('.inputnumpage').attr('value', num_page);
		$('.next').hide();
		$('.last').hide();
		$('.previous').show();
		$('.first').show();
		$('.previous').attr('href', btprev[0]+"="+(num_page-1));

	});

	$('.chiffrenav').click(function(e){
		e.preventDefault();
		var link = $(e.currentTarget);

		var btchiffrenav=link.attr('href');
		btchiffrenav=btchiffrenav.split("=");
		num_page=parseInt(btchiffrenav[1]);

		navigation(num_page);

		var val_getpage=$('.inputnumpage').attr('value', num_page);
		$('.previous').attr('href', btprev[0]+"="+(num_page-1));
		$('.next').attr('href',btnext[0]+"="+(num_page+1));

		if(num_page==1){
			$('.previous').hide();
			$('.first').hide();
			$('.next').show();
			$('.last').show();
		} else if(num_page==parseInt(btlast[1])){
			$('.next').hide();
			$('.last').hide();
			$('.previous').show();
			$('.first').show();
		} else {
			$('.next').show();
			$('.last').show();
			$('.previous').show();
			$('.first').show();
		}
	});

});