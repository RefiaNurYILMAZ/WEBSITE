/* JavaScript Document */
jQuery(window).on('load', function() {
    'use strict';


	if(jQuery('.main-swiper1').length > 0){
		var galleryThumbs1 = new Swiper(".main-swiper-thumb1", {
			spaceBetween: 0,
			slidesPerView: 1,
			loop:false,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			autoplay: {
			   delay: 3000,
			}
		});
		var swiperSlider = new Swiper('.main-swiper1', {
			speed: 1500,
			parallax: true,
			loop:false,
			autoplay: {
			   delay: 3000,
			},
			pagination: {
			  el: ".swiper-pagination-slider1",
			  type: "progressbar",
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			thumbs: {
				swiper: galleryThumbs1
			}
		});
		
		function mainSliderPagination(){
			var swipertotalSlide = $('.main-swiper1 .swiper-slide').length;			
			var fragment = document.querySelector('.image-slider__current');
			var fragment2 = document.querySelector('.image-slider__total');
			var current = swiperSlider.realIndex + 1;
			if (current > swipertotalSlide)
			current = 1;
			var idx = current < 10 ? ("0" + current) : current;
			var tdx = swipertotalSlide < 10 ? ("0" + swipertotalSlide) : swipertotalSlide;
			fragment2.innerHTML = (tdx);
			fragment.innerHTML = (idx);
		}
		mainSliderPagination();
		swiperSlider.on('slideChange', function() {
			mainSliderPagination();
		});
		
		
	}
	
	// Main Slider 2
	if(jQuery('.main-slider-2').length > 0){
		var swiperSlider3 = new Swiper('.main-slider-2', {
			speed: 1500,
			parallax: true,
			slidesPerView: 1,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	}
	
	
	// about-swiper-2
	if(jQuery('.about-swiper-2').length > 0){
		var swiper = new Swiper('.about-swiper-2', {
			speed: 1000,
			effect:"fade",
			slidesPerView: 1,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-about2',
				prevEl: '.swiper-button-prev-about2',
			},
		});
	}
	
	// Portfolio Slider 2
	if(jQuery('.swiper-portfolio-1').length > 0){
		var swiper = new Swiper('.swiper-portfolio-1', {
			speed: 1500,
			parallax: true,
			slidesPerView: 3,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-portfolio',
				prevEl: '.swiper-button-prev-portfolio',
			},
			breakpoints: {
				1200: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 2,
				},
				591: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// Portfolio Slider 2
	if(jQuery('.swiper-portfolio-2').length > 0){
		var swiper = new Swiper('.swiper-portfolio-2', {
			speed: 1500,
			parallax: true,
			slidesPerView: 4,
			spaceBetween: 30,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-portfolio',
				prevEl: '.swiper-button-prev-portfolio',
			},
			breakpoints: {
				1200: {
					slidesPerView: 4,
				},
				992: {
					slidesPerView: 3,
				},
				591: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}

	// content-slider
	if(jQuery('.content-slider').length > 0){
		var swiper = new Swiper('.content-slider', {
			speed: 1500,
			parallax: true,
			slidesPerView: 3,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			pagination: {
				el: '.swiper-pagination-content',
				clickable: true,
			},
			breakpoints: {
				1200: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	if(jQuery('.team-slider').length > 0){
		var swiper = new Swiper('.team-slider', {
			speed: 1500,
			parallax: true,
			slidesPerView: 3,
			spaceBetween: 30,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-team',
				prevEl: '.swiper-button-prev-team',
			},
			breakpoints: {
				1200: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 2,
				},
				591: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}

	if(jQuery('.service-slider').length > 0){
		var swiper = new Swiper('.service-slider', {
			speed: 1500,
			parallax: true,
			slidesPerView: 3,
			spaceBetween: 30,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-service',
				prevEl: '.swiper-button-prev-service',
			},
			breakpoints: {
				1200: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// Main Slider 3
	if(jQuery('.main-swiper3').length > 0){
		var galleryThumbs = new Swiper(".main-swiper-thumb3", {
			spaceBetween: 30,
			slidesPerView: 2,
			freeMode: true,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			autoplay: {
			   delay: 3000,
			},
			breakpoints: {
				1280: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 2,
				},
				591: {
					slidesPerView: 1,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
		var swiper = new Swiper('.main-swiper3', {
			speed: 1500,
			parallax: true,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-home-next',
				prevEl: '.swiper-button-home-prev',
			},
			thumbs: {
				swiper: galleryThumbs
			}
		});
		
	}
	
	
	// Main Slider 5
	if(jQuery('.main-swiper5').length > 0){
		var galleryThumbs2 = new Swiper(".main-swiper-thumb5", {
			watchSlidesVisibility: true,
			speed: 1500,
			loop:false,
			parallax: true,
			watchSlidesProgress: true,
			autoplay: {
			   delay: 3000,
			}
		});
		var swiperSlider5 = new Swiper('.main-swiper5', {
			speed: 1500,
			parallax: true,
			loop:false,
			autoplay: {
			   delay: 3000,
			},
			pagination: {
				el: '.swiper-pagination-slider5',
				//clickable: true,
				type: "progressbar",
				
			},
			navigation: {
				nextEl: '.swiper-button-home-next',
				prevEl: '.swiper-button-home-prev',
			},
			thumbs: {
				swiper: galleryThumbs2
			}
		});	
		function mainSliderPagination(){
			var swipertotalSlide = $('.main-swiper5 .swiper-slide').length;			
			var fragment = document.querySelector('.image-slider__current');
			var fragment2 = document.querySelector('.image-slider__total');
			var current = swiperSlider5.realIndex + 1;
			if (current > swipertotalSlide)
			current = 1;
			var idx = current < 10 ? ("0" + current) : current;
			var tdx = swipertotalSlide < 10 ? ("0" + swipertotalSlide) : swipertotalSlide;
			fragment2.innerHTML = (tdx);
			fragment.innerHTML = (idx);
		}
		mainSliderPagination();
		swiperSlider5.on('slideChange', function() {
			mainSliderPagination();
		});
	}
	
	
	
	// Testimonial Swiper 1
	if(jQuery('.testimonial-swiper').length > 0){
		var swiperTestimonial = new Swiper('.testimonial-swiper', {
			speed: 1500,
			parallax: true,
			slidesPerView: 1,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next1',
				prevEl: '.swiper-button-prev1',
			},
		});
	}
	
	// Testimonial Swiper 2
	if(jQuery('.testimonial-swiper2').length > 0){
		var swiperTestimonial2 = new Swiper('.testimonial-swiper2', {
			speed: 1500,
			parallax: true,
			slidesPerView: 2,
			spaceBetween: 50,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next2',
				prevEl: '.swiper-button-prev2',
			},
			breakpoints: {
				1300: {
					slidesPerView: 2,
				},
				991: {
					slidesPerView: 2,
				},
				600: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// Testimonial Swiper 3
	if(jQuery('.testimonial-swiper3').length > 0){
		var swiperTestimonial3 = new Swiper('.testimonial-swiper3', {
			speed: 1500,
			parallax: true,
			slidesPerView: 3,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next3',
				prevEl: '.swiper-button-prev3',
			},
			breakpoints: {
				1300: {
					slidesPerView: 3,
				},
				991: {
					slidesPerView: 3,
				},
				768: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// service-slider-2
	if(jQuery('.service-slider-2').length > 0){
		var swiperService = new Swiper('.service-slider-2', {
			speed: 1500,
			parallax: true,
			slidesPerView: 5,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-service',
				prevEl: '.swiper-button-prev-service',
			},
			breakpoints: {
				1400: {
					slidesPerView: 5,
				},
				991: {
					slidesPerView: 3,
				},
				600: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// service-slider-3
	if(jQuery('.service-slider-3').length > 0){
		var swiperService = new Swiper('.service-slider-3', {
			speed: 1500,
			parallax: true,
			slidesPerView: 5,
			spaceBetween: 30,
			centeredSlides: true,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-service',
				prevEl: '.swiper-button-prev-service',
			},
			breakpoints: {
				1200: {
					slidesPerView: 5,
				},
				991: {
					slidesPerView: 4,
				},
				768: {
					slidesPerView: 3,
				},
				400: {
					slidesPerView: 2,
				},
				300: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	// Testimonial Swiper 4
	if(jQuery('.testimonial-swiper4').length > 0){
		var swiperTestimonial4 = new Swiper('.testimonial-swiper4', {
			speed: 1500,
			parallax: true,
			slidesPerView: 1,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next4',
				prevEl: '.swiper-button-prev4',
			},
		});
	}
	
	// post-swiper
	if(jQuery('.post-swiper').length > 0){
		var swiper = new Swiper('.post-swiper', {
			speed: 1500,
			parallax: true,
			slidesPerView: 1,
			spaceBetween: 0,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.next-post-swiper-btn',
				prevEl: '.prev-post-swiper-btn',
			}
		});
	}
	
	// Clients Swiper
	if(jQuery('.clients-swiper').length > 0){
		var swiper5 = new Swiper('.clients-swiper', {
			speed: 1500,
			parallax: true,
			slidesPerView: 4,
			spaceBetween: 30,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			breakpoints: {
				1191: {
					slidesPerView: 6,
				},
				991: {
					slidesPerView: 5,
				},
				691: {
					slidesPerView: 4,
				},
				591: {
					slidesPerView: 3,
				},
				320: {
					slidesPerView: 2,
				},
			}
		});
	}


	if(jQuery('.about-main-slider').length > 0){
		var aboutThumbs = new Swiper(".about-bg-slider", {
			spaceBetween: 0,
			slidesPerView: 1,
			loop:false,
			speed: 1500,
			freeMode: true,
			effect: "fade",
			watchSlidesProgress: true,
			autoplay:{
			   delay: 3000,
			},
		});

      	var menuTtemText = {};
      	var menuTtemNum = {};
		$(".about-swiper .swiper-slide").each(function(index){
	      	menuTtemText[index] = $(this).attr('data-title');
	      	menuTtemNum[index] = index+1;
	    });	
		var swiper = new Swiper('.about-main-slider', {
			speed: 1500,
			parallax: true,
			loop:false,
			autoplay:{
			   delay: 3000,
			},
			pagination: {
				el: '.swiper-pagination-about',
				clickable: true,

				renderBullet: function (index, className) {
		          return '<div class="' + className + '">'+ (menuTtemText[index]) +"<span>"+ "0"+(menuTtemNum[index]) +"</span>" + '</div>';
		        },

			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			thumbs: {
				swiper: aboutThumbs
			}
		});

	}
	
	
	if(jQuery('.feature-swiper').length > 0){
		var featureThumbs = new Swiper(".feature-swiper-thumb", {
			spaceBetween: 0,
			slidesPerView: 1,
			speed: 1500,
			loop:false,
			parallax: true,
			autoplay:{
			   delay: 3000,
			},
			watchSlidesProgress: true,
		});

			
		var swiper = new Swiper('.feature-swiper', {
			speed: 1500,
			effect: "fade",
			loop:false,
			autoplay:{
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next-feature',
				prevEl: '.swiper-button-prev-feature',
			},
			thumbs: {
				swiper: featureThumbs
			}
		});

	}

	
	// related-item-swiper
	if(jQuery('.related-item-swiper').length > 0){
		var swiper5 = new Swiper('.related-item-swiper', {
			speed: 1500,
			parallax: true,
			slidesPerView: 4,
			spaceBetween: 30,
			autoplay: {
			   delay: 3000,
			},
			loop:false,
			navigation: {
				nextEl: '.swiper-button-next-related',
				prevEl: '.swiper-button-prev-related',
			},
			breakpoints: {
				1191: {
					slidesPerView: 4,
				},
				992: {
					slidesPerView: 4,
				},
				768: {
					slidesPerView: 3,
				},
				500: {
					slidesPerView: 2,
				},
				320: {
					slidesPerView: 1,
				},
			}
		});
	}
	
	if(jQuery('.sync2').length > 0){
		var swiperProduct = new Swiper(".sync2", {
			spaceBetween: 15,
			slidesPerView: "auto",
			watchSlidesVisibility: true,
			direction: "vertical",
			watchSlidesProgress: true,
			autoplay:{
			   delay: 3000,
			},
			navigation: {
			  nextEl: ".swiper-button-next-thumb",
			  prevEl: ".swiper-button-prev-thumb",
			},
			breakpoints: {
				576: {
					spaceBetween: 15
				},
				320: {
					spaceBetween: 15
				}
			}
		});
		var swiper2 = new Swiper(".sync1", {
			spaceBetween: 10,
			navigation: {
			  nextEl: ".swiper-button-next",
			  prevEl: ".swiper-button-prev",
			},
			thumbs: {
			  swiper: swiperProduct,
			},
		});
	}
	
	
	// portfolio-slider
	if(jQuery('.portfolio-slider').length > 0){
		var swiperTestimonial = new Swiper('.portfolio-slider', {
			speed: 1500,
			slidesPerView: 'auto',
			spaceBetween: 10,
			mousewheel: true,
			loop:true,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next1',
				prevEl: '.swiper-button-prev1',
			},
		});
	}
	
	// portfolio-slider
	if(jQuery('.portfolio-slider-2').length > 0){
		var swiperTestimonial = new Swiper('.portfolio-slider-2', {
			speed: 1500,
			slidesPerView: 4,
			spaceBetween: 0,
			loop:false,
			autoplay: {
			   delay: 3000,
			},
			navigation: {
				nextEl: '.swiper-button-next1',
				prevEl: '.swiper-button-prev1',
			},
			
			breakpoints: {
			  300: {
				slidesPerView: 1,
			  },
			  575: {
				slidesPerView: 2,
			  },
			  991: {
				slidesPerView: 3,
			  },
			  1200: {
				slidesPerView: 4,
			  },
			},
		});
	}
	
	
	if(jQuery('.split-slider').length > 0){
		var mySwiper = new Swiper(".split-slider", {
		  direction: "vertical",
		  loop: true,
			pagination: {
				el: '.swiper-pagination-split',
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '">' + "0"+(index + 1) + "</span>";
				},
			},
		  grabCursor: true,
		  speed: 1000,
		  paginationClickable: true,
		  parallax: true,
		  autoplay: false,
		  effect: "slide",
		  mousewheel: true,
		});
	}
	
});
/* Document .ready END */