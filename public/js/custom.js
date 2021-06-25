
$( document ).ready(function() {
	$('.loading').addClass('done')
		
		
	function InvalidMsg(textbox) {
	    if (textbox.value === '') {
	        textbox.setCustomValidity('Required');
	    } else if (textbox.validity.typeMismatch){
	        textbox.setCustomValidity('Please enter a valid');
	    } else {
	       textbox.setCustomValidity('');
	    }
	    return true;
	}
	
});


var stickyNav = $('body').offset().top;
window.onscroll = function() {
    NavFixed();
};
function NavFixed() {
    let scroll = window.pageYOffset > stickyNav ? true : false;
    if (scroll) {
	    $('header').addClass('is-scroll')
    }else{
    	$('header').removeClass('is-scroll')
    }
}

$('.open_navbar').on('click', function(){
	$('body').addClass('nav-open')
})
$('.close_nav').on('click', function(){
	$('body').removeClass('nav-open')
})


$('.search_modal').on('click', function(){
	$(this).toggleClass('is-open')
})
$('.techsub_item.item_01').find('.techitem_title').on('click', function(){
	var father = $(this).parent().parent();
	if (father.hasClass('is-open')) {
		if ($('.techsub_item.item_02').hasClass('is-open')) {
			$('.techsub_item.item_01').addClass('is-open')
			$('.techsub_item.item_02').addClass('is-unselect')
			$('.techsub_item.item_02').removeClass('is-open')
			$('.techsub_item.item_02').find('.tectitem_icon').find('i').removeClass('fa-minus')
			$('.techsub_item.item_02').find('.tectitem_icon').find('i').addClass('fa-plus')
			$('.techsub_item.item_01').find('.tectitem_icon').find('i').removeClass('fa-plus')
			$('.techsub_item.item_01').find('.tectitem_icon').find('i').addClass('fa-minus')
		}else{
			father.removeClass('is-open')
			$('.techsub_item.item_01').removeClass('is-open')
			$('.techsub_item.item_02').removeClass('is-unselect')
			$(this).find('.tectitem_icon').find('i').removeClass('fa-minus')
			$(this).find('.tectitem_icon').find('i').addClass('fa-plus')
		}
	}else{
		father.addClass('is-open')
		$('.techsub_item.item_01').addClass('is-open')
		$('.techsub_item.item_02').addClass('is-unselect')
		$(this).find('.tectitem_icon').find('i').addClass('fa-minus')
		$(this).find('.tectitem_icon').find('i').removeClass('fa-plus')
	}
})
$('.techsub_item.item_02').find('.techitem_title').on('click', function(){
	var father = $(this).parent().parent();
	if (father.hasClass('is-open')) {
		if ($('.techsub_item.item_01').hasClass('is-open')) {
			$('.techsub_item.item_01').removeClass('is-open')
			$('.techsub_item.item_02').removeClass('is-unselect')
			$('.techsub_item.item_02').addClass('is-open')
			$('.techsub_item.item_01').find('.tectitem_icon').find('i').removeClass('fa-minus')
			$('.techsub_item.item_01').find('.tectitem_icon').find('i').addClass('fa-plus')
			$('.techsub_item.item_02').find('.tectitem_icon').find('i').removeClass('fa-plus')
			$('.techsub_item.item_02').find('.tectitem_icon').find('i').addClass('fa-minus')
		}else{
			father.removeClass('is-open')
			$('.techsub_item.item_02').removeClass('is-open')
			$('.techsub_item.item_02').removeClass('is-unselect')
			$(this).find('.tectitem_icon').find('i').removeClass('fa-minus')
			$(this).find('.tectitem_icon').find('i').addClass('fa-plus')
		}
	}else{
		father.addClass('is-open')
		$(this).parent().addClass('is-open')
		$(this).find('.tectitem_icon').find('i').addClass('fa-minus')
		$(this).find('.tectitem_icon').find('i').removeClass('fa-plus')
	}
})

$(".I-contact").find('input').on('focus', function(){
	$(this).parent().addClass('is-select')
})
$(".I-contact").find('input').on('focusout', function(){
	$(this).parent().removeClass('is-select')
})
$(".I-contact").find('textarea').on('focus', function(){
	$(this).parent().addClass('is-select')
})
$(".I-contact").find('textarea').on('focusout', function(){
	$(this).parent().removeClass('is-select')
})
$('.open_submenu').on('click', function(){
	if ($(this).parent().hasClass('is-open')) {
		$(this).parent().removeClass('is-open')
	}else{
		$(this).parent().parent().find('.sub_menu').removeClass('is-open')
		$(this).parent().addClass('is-open')
	}
})




// $('.bound_01').on('click', function(){
// 	$(this).toggleClass('click')
// })



	// const a = [
	// 		  '😀',
	// 		  '😁',
	// 		  '😂',
	// 		  '😅',
	// 		  '😊',
	// 		  '😎',
	// 		  '😐',
	// 		  '😒',
	// 		  '😓',
	// 		  '😕',
	// 		  '😗',
	// 		  '😠',
	// 		  '😢',
	// 		  '😧',
	// 		  '😬',
	// 		  '😮',
	// 		  '😯',
	// 		  '😳',
	// 		  '😮',
	// 		  '😲',
	// 		  '😶',
	// 		  '🙄',
	// 		  '🙃',
	// 		  '👍',
	// 		  '😯',
	// 		  '😡',
	// 		  '❤️',
	// 		  '🥰',
	// 		  '😍',
	// 		  '😕',
	// 		];
	// for (var i = 0; i < 30; i++) {
	// 	$('body').append('<span>'+a[i]+'</span>')
	// }