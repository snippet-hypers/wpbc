(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$('.wpbc_root_list li').click(function(){
 		$('.wpbc_box').hide();
 		$(this).find('.wpbc_box').show();
 	});
	$('body').on('click','.wpbc_back',function(){
		if($.fancybox.getInstance() !== false){
			$.fancybox.close();
		}
		$(this).closest('.wpbc_box').hide();
	});
	$('body').on('change keyup keydown','#front_name',function(){
		var $txt = $(this).val();
		$('#front_preview').text($txt);
		if($txt!='') {
			$('.wpbc_font_option .wpbc_seleted_message').text($txt);
			$('.wpbc_font_option').addClass('wpbc_text_added');
		} else {
			$('.wpbc_font_option .wpbc_seleted_message').text('');
			$('.wpbc_font_option').removeClass('wpbc_text_added');
		}

	});
	$('body').on('change','.wpbc_font_option input',function(){
		$('#front_preview').css('font-family',$(this).val());
	});
	$('body').on('change','.wpbc_color_option input',function(){
		$('#front_preview').css('color',$(this).val());
	});
	//
	draw_svg();



})( jQuery );

function draw_svg() {
	var svgElement = document.getElementById('Layer_1');
	let {width, height} = svgElement.getBBox();
	let clonedSvgElement = svgElement.cloneNode(true);
	let outerHTML = clonedSvgElement.outerHTML;
	let blob = new Blob([outerHTML],{type:'image/svg+xml;charset=utf-8'});
	let URL = window.URL || window.webkitURL || window;
	let blobURL = URL.createObjectURL(blob);

	let image = new Image();



	console.log(image);
	image.onload = () => {
	   let canvas = document.getElementById('canvas');

	   canvas.width = width;

	   canvas.height = height;
	   let context = canvas.getContext('2d');
		 console.log(context);
	   // draw image in canvas starting left-0 , top - 0
	   context.drawImage(image, 0, 0 );
	   // context.drawImage(image, 0, 0, width, height );
	  //  downloadImage(canvas); need to implement
	};

	image.src = blobURL;

}

/* var svgElement = document.getElementById('Layer_1');
let {width, height} = svgElement.getBBox();
let clonedSvgElement = svgElement.cloneNode(true);
let outerHTML = clonedSvgElement.outerHTML;
let blob = new Blob([outerHTML],{type:'image/svg+xml;charset=utf-8'});
let URL = window.URL || window.webkitURL || window;
let blobURL = URL.createObjectURL(blob);

let image = new Image();



console.log(image);
window.onload = () => {
	 let canvas = document.getElementById('canvas');

	 canvas.width = width;

	 canvas.height = height;
	 let context = canvas.getContext('2d');
	 console.log(context);
	 // draw image in canvas starting left-0 , top - 0
	 context.drawImage(image, 0, 0 );
	 // context.drawImage(image, 0, 0, width, height );
	//  downloadImage(canvas); need to implement
};

image.src = blobURL; */

// window.onload = () => {
// 	draw_svg();
// };
