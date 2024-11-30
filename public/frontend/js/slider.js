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