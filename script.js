
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



const smallImages = document.querySelectorAll('.small');
smallImages.forEach(image => {
    image.addEventListener('click', () => {
    const currentMainImage = document.querySelector('.principale');
        
        const tempSrc = currentMainImage.src;
        currentMainImage.src = image.src;
        image.src = tempSrc;
    });
});




