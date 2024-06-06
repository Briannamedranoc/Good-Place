let currentIndex = 0;
let slideInterval;

function changeSlide(direction) {
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    slides[currentIndex].style.display = 'none';

    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

    slides[currentIndex].style.display = 'block';
}

function startSlideShow() {
    slideInterval = setInterval(() => {
        changeSlide(1);  // Avanzar a la siguiente imagen
    }, 2000);  // Cambiar cada 8 segundos
}

function stopSlideShow() {
    clearInterval(slideInterval);
}

document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.slide');
    slides.forEach(slide => slide.style.display = 'none');
    slides[currentIndex].style.display = 'block';

    // Iniciar el cambio automático de imágenes
    startSlideShow();

    // Opcional: Pausar el cambio de imágenes al pasar el mouse sobre el carrusel
    const carousel = document.querySelector('.slider');
    carousel.addEventListener('mouseenter', stopSlideShow);
    carousel.addEventListener('mouseleave', startSlideShow);
});
