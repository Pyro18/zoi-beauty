const dots = document.querySelectorAll('.dot');
const images = document.querySelectorAll('.image');

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        const currentActiveImage = document.querySelector('.image.active');
        const currentActiveDot = document.querySelector('.dot.active');
        currentActiveImage.classList.remove('active');
        currentActiveDot.classList.remove('active');

        images[index].classList.add('active');
        dot.classList.add('active');
    });
});