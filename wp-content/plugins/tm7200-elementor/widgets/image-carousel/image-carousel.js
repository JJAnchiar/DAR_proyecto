(function ($) {
  const initCarousel = ($scope) => {
    const $carousel = $scope.find('.image-carousel');

    new Swiper($carousel[0], {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      navigation: {
        nextEl: $carousel.find('.swiper-button-next')[0],
        prevEl: $carousel.find('.swiper-button-prev')[0],
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        }
      }
    });
  };

  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/image-carousel.default', initCarousel);
  });
})(jQuery);
