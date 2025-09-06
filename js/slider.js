const swiper = new Swiper('.swiper', {
    loop: true,
    spaceBetween: 16,
    grabCursor: true, 

    breakpoints: {
        320: {
        slidesPerView: 1.3,
        spaceBetween: 20
        },
        500: {
        slidesPerView: 2.3,
        spaceBetween: 30
        },
        640: {
        slidesPerView: 3.3,
        spaceBetween: 40
        }
    },

    scrollbar: {
        el: '.swiper-scrollbar',
    },
});



const swiperMovieList = new Swiper('.swiper-movies', {
    loop: true,
    spaceBetween: 16,
    grabCursor: true, 
    slidesPerView: 1.2,

    scrollbar: {
        el: '.swiper-scrollbar',
    },
    
    pagination: {
    el: '.swiper-pagination',
  },
});