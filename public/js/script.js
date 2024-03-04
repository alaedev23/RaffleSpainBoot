// Animacion entrar pagina que salga el elemento y modificaciones grid 

document.addEventListener('DOMContentLoaded', function () {

    if (document.querySelector("header")) {
        setTimeout(function() {
            document.querySelector("#banner").classList.add('visible');
            document.querySelector("header").classList.add('visible');
        }, 100);
    }

});

// Animacion mientras haces scroll que vayan apareciendo

document.addEventListener('DOMContentLoaded', function () {
    const animatedElements = document.querySelectorAll(".animation");

    window.addEventListener('scroll', () => {
        handleScroll(animatedElements)
    });

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= window.innerHeight * 0.8 &&
            rect.bottom >= 0
        );
    }

    function handleScroll(elements) {
        elements.forEach(element => {
            const animationDirection = element.classList.contains('animated-section-left-right') ? 'left_right' :
                element.classList.contains('animated-section-right-left') ? 'right_left' : 'down_up';

            if (isInViewport(element)) {
                element.classList.add('visible');
            }

        });
    }

});

// Menu aparecer desaparecer

const img = document.querySelector('.menu');
const menu = document.getElementById('menu');
const manuAparecer = document.getElementById('aparecer');
const media = window.matchMedia("(min-width: 1024px)");

function mirarTamaño(media) {
    if (media.matches) {
        manuAparecer.style.display = 'none';
        menu.style.display = 'flex';
    }
    else {
        menu.style.display = 'none';
        manuAparecer.style.display = 'none';
    }
}

mirarTamaño(media);

media.addEventListener("change", mirarTamaño)

img.addEventListener('click', () => {
    let styleMenu = window.getComputedStyle(manuAparecer);
    if (styleMenu.getPropertyValue("display") === 'none') {
        manuAparecer.style.display = 'flex';
        menu.style.display = 'none';
    } else if (styleMenu.getPropertyValue("display") === 'flex') {
        manuAparecer.style.display = 'none';
    }
});