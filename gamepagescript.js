const slider = document.querySelector('.z3antot div');
const forwardButton = document.getElementById('forwardd');
const backwardButton = document.getElementById('backwardd');

function moveForward() {
    const images = Array.from(slider.children);

    images.forEach((img) => {
        img.style.transition = 'transform 0.4s ease-in-out';
        img.style.transform = `translateX(-300px)`;
    });

    setTimeout(() => {
        const firstImage = images[0];
        slider.appendChild(firstImage);

        images.forEach((img) => {
            img.style.transition = 'none';
            img.style.transform = 'translateX(0)';
        });
    }, 400);
}

function moveBackward() {
    const images = Array.from(slider.children);
    const lastImage = images[images.length - 1];
    slider.prepend(lastImage);

    images.forEach((img) => {
        img.style.transition = 'none';
        img.style.transform = `translateX(-300px)`;
    });

    setTimeout(() => {
        images.forEach((img) => {
            img.style.transition = 'transform 0.4s ease-in-out';
            img.style.transform = 'translateX(0)';
        });
    }, 0);
}

forwardButton.addEventListener('click', moveForward);
backwardButton.addEventListener('click', moveBackward);
let lastScrollY = window.scrollY;
const header = document.getElementById("header");

window.addEventListener("scroll", () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY > lastScrollY) {

        header.classList.add("hidden");
    } else {
        header.classList.remove("hidden");
    }

    lastScrollY = currentScrollY;
});