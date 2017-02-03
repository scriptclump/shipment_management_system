
/*=========== slideshow ===============*/
$(document).ready(function(){
	$('.bxslider').bxSlider({
	  mode: 'fade',
	  controls: false,
	  pager:true,
	  auto: true,	  
	  speed:2000,	  
	  //autoHover: true,
	});
});

/*=========== content slideshow ===============*/
$(document).ready(function(){
	$('#content_slider').bxSlider({
	  mode: 'fade',
	  controls: false,
	  pager:true,
	  auto: true,	  
	  speed:2000,	  
	  //autoHover: true,
	});
});

/*=========== testimonials slideshow ===============*/
$(document).ready(function(){
	$('.testimonials_slider').bxSlider({
	  mode: 'vertical',
	  controls: false,
	  pager:true,
	  auto: true,	  
	  speed:2000,	  
	  //autoHover: true,
	});
});

/*=========== carousel slideshow ===============*/
$(document).ready(function(){
  $('.carousel_slider').bxSlider({
    controls: true,
	pager:false,
	auto: true,
	slideWidth: 134,
    minSlides: 2,
    maxSlides: 6,
    moveSlides: 1,
    slideMargin: 0,
	speed:1000,
	//infiniteLoop:false,
	//hideControlOnEnd:true
  });
});














