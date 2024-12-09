var cardMd = new Swiper(".testimonial", {
  slidesPerView: 1,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

$('.next-btn').on('click', function() {
  $(this).parent().siblings(".testimonial").children('.swiper-button-next').click();
  $('.prev-btn').attr("disabled", false);
  if($(this).parent().siblings(".testimonial").children('.swiper-button-next').hasClass('swiper-button-disabled')) {
    $(this).attr("disabled", true);
  }

});
$('.prev-btn').on('click', function() {
  $(this).parent().siblings(".testimonial").children('.swiper-button-prev').click();
  $('.next-btn').attr("disabled", false);
  if($(this).parent().siblings(".testimonial").children('.swiper-button-prev').hasClass('swiper-button-disabled')) {
    $(this).attr("disabled", true);
  }
});

var mainSlider = new Swiper(".main-slider", {
  loop: true,
  centeredSlides: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  }
});

var mainSlider = new Swiper(".product", {
    slidesPerView: 5,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
        },
    },
});

$('.btn-next').on('click', function() {
    $(this).parent().parent().children(".swiper-button-next").click();
})
$('.btn-prev').on('click', function() {
    $(this).parent().parent().children(".swiper-button-prev").click();
})
