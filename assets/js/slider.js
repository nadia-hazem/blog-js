document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('#slider');
    const slides = slider.querySelectorAll('.slide');
    const captions = slider.querySelectorAll('.caption');
    const next = slider.querySelector('.next');
    const prev = slider.querySelector('.prev');
    let currentSlide = 0;

    slides[currentSlide].classList.add('active');
    console.log(slides.length);

    function goToSlide(moveTo) {

        slides[currentSlide].classList.remove('active');

        currentSlide = (moveTo + slides.length) % slides.length;
        console.log(currentSlide);

        slides[currentSlide].classList.add('active');
    }


    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function prevSlide() {
        goToSlide(currentSlide - 1);
    }

    next.onclick = function() {
        nextSlide();
    };
    prev.onclick = function() {
        prevSlide();
    };

    setInterval(nextSlide, 5000);
    });