$(document).ready(function(){
	if(location.pathname == '/'){
		$('#menu a:eq(0)').addClass('active');		
	}else{/*
		$('#menu a[href='+location.pathname+']').addClass('active');
	*/}

	$(".zoomimage").fancybox();
	
	$(".slideimage").owlCarousel({
		navigation : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		items : 1, 
		itemsDesktop : false,
		itemsDesktopSmall : false,
		itemsTablet: false,
		itemsMobile : false
	});
	
	var owl = $(".slideimage").data('owlCarousel');
	
	$(".owl-prev").click(function(){
		owl.prev();
	});
	
	$(".owl-next").click(function(){
		owl.next();
	});
	
	setInterval(function() {
		$('.master_link').fadeOut('slow');
		img = $('.master_link img').attr('src');
		setTimeout(function(){	
			if(img == '/images/master-1.png'){
				$('.master_link img').attr('src', '/images/master-2.png');
				$('.master_link p').text('Виктория');
			}else{
				$('.master_link img').attr('src', '/images/master-1.png');
				$('.master_link p').text('Василиса');
			}			
		}, 600);
		$('.master_link').fadeIn('slow');
	}, 5000);
	

	setInterval(function() {
		$('.some_reviews').fadeOut('slow');
		name = $('.some_reviews .reviews_name').text();
		setTimeout(function(){	
			if(name == 'Андрей'){
				$('.some_reviews .reviews_name').text('Лёха');
				$('.reviews_text').text('Часто здесь бываю, всем рекомендую.');
			}else{
				$('.some_reviews .reviews_name').text('Андрей');
				$('.reviews_text').text('Отличный салон!');
			}
		}, 600);
		$('.some_reviews').fadeIn('slow');
	}, 7000);	
});

function change_image(thisis){	
	choose_element_link = thisis.attr('src');
	active_element_link =  thisis.parents('.master_images').find('.main_image img').attr('src');
	thisis.parents('.master_images').find('.main_image a').attr('href', choose_element_link);
	thisis.parents('.master_images').find('.main_image img').attr('src', choose_element_link);
	thisis.parents('.master_images').find('.preview_image').append('<img onclick="change_image($(this));" src="'+active_element_link+'">');
	thisis.remove();
}

function image_prev(thisis){
	prev_link = thisis.parents('.master_images').find('.preview_image img').eq(2).attr('src');
	active_link = thisis.parents('.master_images').find('.main_image img').attr('src');
	thisis.parents('.master_images').find('.preview_image img').eq(2).remove();
	thisis.parents('.master_images').find('.main_image a').attr('href', prev_link);
	thisis.parents('.master_images').find('.main_image img').attr('src', prev_link);
	thisis.parents('.master_images').find('.preview_image').prepend('<img onclick="change_image($(this));" src="'+active_link+'">');	
}

function image_next(thisis){
	next_link = thisis.parents('.master_images').find('.preview_image img').eq(0).attr('src');
	active_link = thisis.parents('.master_images').find('.main_image img').attr('src');
	thisis.parents('.master_images').find('.preview_image img').eq(0).remove();
	thisis.parents('.master_images').find('.main_image a').attr('href', next_link);
	thisis.parents('.master_images').find('.main_image img').attr('src', next_link);
	thisis.parents('.master_images').find('.preview_image').append('<img onclick="change_image($(this));" src="'+active_link+'">');	
}

function delete_preview(thisis){
	name = thisis.parents('.file-actions').siblings('.file-caption-name').text();
	if($('.file-input input[data-name="'+name+'"]').length){
		for(i=0;i<$('.file-input input[data-name="'+name+'"]').length;i++){
			$('.file-input input[data-name="'+name+'"]').eq(i).remove();
		}
	}
}