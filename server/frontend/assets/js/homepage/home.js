const dots = document.querySelectorAll('.dot');
const images = document.querySelectorAll('.image');
let currentIndex = 0;

function changeImage() {
    const currentActiveImage = document.querySelector('.image.active');
    const currentActiveDot = document.querySelector('.dot.active');
    currentActiveImage.classList.remove('active');
    currentActiveDot.classList.remove('active');

    currentIndex = (currentIndex + 1) % images.length;

    images[currentIndex].classList.add('active');
    dots[currentIndex].classList.add('active');
}

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        const currentActiveImage = document.querySelector('.image.active');
        const currentActiveDot = document.querySelector('.dot.active');
        currentActiveImage.classList.remove('active');
        currentActiveDot.classList.remove('active');

        currentIndex = index;

        images[currentIndex].classList.add('active');
        dot.classList.add('active');
    });
});

setInterval(changeImage, 5000);