$( document ).ready(function() {

    const swiper = new Swiper('.swiper', {
        slidesPerView: "auto",
        slidesPerGroup: 1,
        slidesPerGroupAuto:true,
/*        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
        },*/
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });

});