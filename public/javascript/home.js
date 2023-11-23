const swiperEl = document.querySelectorAll('.swiper');

swiperEl.forEach(swiper => {
    Object.assign(swiper, {
        loop: true,
        freeMode: true,
        slidesPerView: 1,
        spaceBetween: 10,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 50,
            },
        },
    });
    swiper.initialize();
});


var r = document.querySelector(':root');

let navbar = document.querySelector("#navbar");

document.addEventListener('scroll', () => {
    if (this.scrollY > 0) {
        navbar.classList.add("bg");
        navbar.classList.remove("shadow");
        navbar.style.color = 'white';
    } else {
        navbar.classList.remove("bg")
        navbar.classList.add("shadow");
    }
})

let darkSwitch = document.getElementById('darkSwitch');

darkSwitch.addEventListener('click', () => {
    if (darkSwitch.className === 'bx bx-sun') {
        darkSwitch.className = 'bx bx-moon';
        r.style.setProperty('--bg-color', '#fff');
        r.style.setProperty('--navbar-color', '#111');
        r.style.setProperty('--navbar-bg', '#fff');
        r.style.setProperty('--color', '#111');
        r.style.setProperty('--shadow-banner', 'linear-gradient(#11111100 80%, #fff)');
        r.style.setProperty('--shadow-navbar', 'linear-gradient(#fff 100%, #fff)');
    } else {
        darkSwitch.className = 'bx bx-sun';
        r.style.setProperty('--bg-color', '#141414');
        r.style.setProperty('--navbar-color', '#fff');
        r.style.setProperty('--navbar-bg', '#111');
        r.style.setProperty('--color', '#fff');
        r.style.setProperty('--shadow-banner', 'linear-gradient(#11111100 80%, #141414)');
        r.style.setProperty('--shadow-navbar', 'linear-gradient(#111111b0, #111111b0,#11111100)');
    }
})