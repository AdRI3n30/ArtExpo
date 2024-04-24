function toggleComments(elementId) {
    var commentsContainer = document.getElementById(elementId);
    var text2 = commentsContainer.parentElement;
    if (commentsContainer.style.display === "none") {
        commentsContainer.style.display = "block";
        text2.classList.add('open-comments'); // Ajoute la classe pour décaler le cadre vers le haut
    } else {
        commentsContainer.style.display = "none";
        text2.classList.remove('open-comments'); // Retire la classe pour ramener le cadre à sa position initiale
    }
}
