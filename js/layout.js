// Exemple de JS pour ajouter des effets de survol aux cartes
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.classList.add('shadow-lg');
    });
    card.addEventListener('mouseleave', () => {
        card.classList.remove('shadow-lg');
    });
});
