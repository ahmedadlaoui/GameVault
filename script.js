
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry);
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        } else {
            entry.target.classList.remove('show');
        }

    })
})

const divs = document.querySelectorAll('.scroll');
divs.forEach((div) => observer.observe(div))



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
document.addEventListener("DOMContentLoaded",() => {
    const addToLibButtons = document.querySelectorAll('.addtolib');

    addToLibButtons.forEach(button => {
        button.addEventListener('click', function() {

            const gameID = this.getAttribute('data-game-id');
            const url = new URL(window.location.href);
            url.searchParams.set('Game_ID', gameID);

            window.location.href = url.toString();
        });
    });
});

// const slider = document.querySelector('.z3antot .sliderr');
// const forwardButton = document.getElementById('forwardd');
// const backwardButton = document.getElementById('backwardd');
// const images = Array.from(slider.children);

// function moveForward() {
//     const firstImage = images.shift();
//     images.push(firstImage);
//     updateImageOrder();
// }

// function moveBackward() {
//     const lastImage = images.pop();
//     images.unshift(lastImage);
//     updateImageOrder(); 
// }
// function updateImageOrder() {
//     slider.innerHTML = '';
//     images.forEach((img) => slider.appendChild(img))
// }

// forwardButton.addEventListener('click', moveForward);
// backwardButton.addEventListener('click', moveBackward);

const slider = document.querySelector('.z3antot div');
const forwardButton = document.getElementById('forwardd');
const backwardButton = document.getElementById('backwardd');

function moveForward() {
    const images = Array.from(slider.children);

    images.forEach((img, index) => {
        img.style.transition = 'transform 0.3s ease-in-out';
        img.style.transform = `translateX(-290px)`;
    });

    setTimeout(() => {
        const firstImage = images[0];
        slider.appendChild(firstImage);

        images.forEach((img) => {
            img.style.transition = 'none';
            img.style.transform = 'translateX(0)';
        });
    }, 300);
}

function moveBackward() {
    const images = Array.from(slider.children);
    const lastImage = images[images.length - 1];
    slider.prepend(lastImage);

    images.forEach((img) => {
        img.style.transition = 'none';
        img.style.transform = `translateX(-290px)`;
    });

    setTimeout(() => {
        images.forEach((img) => {
            img.style.transition = 'transform 0.3s ease-in-out';
            img.style.transform = 'translateX(0)';
        });
    }, 0);
}

forwardButton.addEventListener('click', moveForward);
backwardButton.addEventListener('click', moveBackward);




