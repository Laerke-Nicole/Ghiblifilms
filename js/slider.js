const swiper = new Swiper('.mySwiper', {
    slidesPerView: 'auto',
    spaceBetween: 16,
    grabCursor: true, // Enables dragging with mouse
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
    }
});