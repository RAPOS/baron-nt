var page; //Объект
$(document).ready(function(){
	window.onload = function(){
		init_preview_file(page);
	}
	
	if(location.pathname == '/'){
		$('#menu a:eq(0)').addClass('active');		
	}else{
		$('#menu a').each(function(){
			if ($(this).attr('href') == location.pathname) {
				$(this).addClass('active')
			}
		});
	}
	
	$(".zoomimage").fancybox();
	
	$("#main_page .slideimage").owlCarousel({
		navigation : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		items : 1, 
		itemsDesktop : false,
		itemsDesktopSmall : false,
		itemsTablet: false,
		itemsMobile : false
	});

	
	$("aside .slideimage").owlCarousel({
		navigation : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		items : 1, 
		itemsDesktop : false,
		itemsDesktopSmall : false,
		itemsTablet: false,
		itemsMobile : false
	});
	
	var owl = $("#main_page .slideimage").data('owlCarousel');
	
	var owl1 = $("aside .slideimage").data('owlCarousel');
	
	$("#main_page .owl-prev").click(function(){
		owl.prev();
	});
	
	$("#main_page .owl-next").click(function(){
		owl.next();
	});

	$("aside .owl-prev").click(function(){
		owl1.prev();
	});
	
	$("aside .owl-next").click(function(){
		owl1.next();
	});	
	
	m = 0;
	
	$('#ca-container').contentcarousel();
	$('#ca-container2').contentcarousel();
	
/* 	setInterval(function() {
		mcount = $('.master_link').length;
		$('.master_link').eq(m).fadeOut('slow');	
		setTimeout(function(){	
			$('.master_link').eq(m).removeClass('active');
			m++;		
			if(m == mcount){
				m = 0;
			}
			$('.master_link').eq(m).fadeIn('slow');
			$('.master_link').eq(m).addClass('active');
		}, 700);		
	}, 6000);	 */

	r = 0;
	setInterval(function() {
		rcount = $('.some_reviews').length;
		$('.some_reviews').eq(r).fadeOut('slow');	
		setTimeout(function(){	
			r++;		
			if(r == rcount){
				r = 0;
			}
			$('.some_reviews').eq(r).fadeIn('slow');
		}, 600);
	}, 7000);	
	
	$('#sortable').sortable({
		distance: 5,
		axis: 'y',
		cursor: 'move',
		stop: function (event, ui){
			$('#sortable td:nth-child(1)').each(function(i, val){
				$(this).text(i+1);
			});
			s = $('#sortable').sortable('toArray', {attribute: 'data-key'});
			if(page.name == 'masters'){
				$.post('/admin/masters/sort/', {'id_master[]':s});
			} else if(page.name == 'programs'){
				$.post('/admin/programs/sort/', {'id_massage[]':s});
			}
		},
		out: function (event, ui){
			$( ".selector" ).sortable( "disable" );
		}
	});
    $('#sortable').disableSelection();
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

function init_preview_file(page){
	if(page){
		if($(".file-input .file-preview-frame").length == page.files_count){
			$(".file-input .input-group").hide();
		}
	}
}

function setSmile(smile) {
	obj = document.getElementById('breviews-text');
	obj.value += smile;
	obj.focus();
}