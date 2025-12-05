/*------------banner ảnh */
document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector(".banner-slide")) {
        new Swiper(".banner-slide", {
            loop: true,
            autoplay: { delay: 3000 },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: { el: ".swiper-pagination", clickable: true }
        });
    }
});


