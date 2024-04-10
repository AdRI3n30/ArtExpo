document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".slider .mail");
    const navLinks = document.querySelectorAll(".slider-nav a");

    let currentSlide = 0;
    const intervalTime = 5000; // Temps en millisecondes entre chaque changement de diapositive

    // Fonction pour afficher la diapositive actuelle
    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.style.display = "block";
            } else {
                slide.style.display = "none";
            }
        });
    }

    // Fonction pour passer à la diapositive suivante
    function nextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }

    // Démarrez le défilement automatique
    const slideInterval = setInterval(nextSlide, intervalTime);

    // Arrêtez le défilement automatique lorsque vous survolez le carrousel
    document.querySelector('.slider-wrapper').addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
    });

    // Reprenez le défilement automatique lorsque vous quittez le carrousel
    document.querySelector('.slider-wrapper').addEventListener('mouseleave', () => {
        slideInterval = setInterval(nextSlide, intervalTime);
    });

    // Fonction pour gérer le clic sur un lien de navigation
    navLinks.forEach((link, index) => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Afficher la première diapositive au chargement de la page
    showSlide(currentSlide);
});
