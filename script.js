const tulipeCount = 100; // Nombre de tulipes à afficher

// Fonction pour générer des tulipes
function createTulipe() {
  const tulipe = document.createElement('div');
  tulipe.classList.add('tulipe');
  
  // Position aléatoire
  tulipe.style.top = Math.random() * window.innerHeight + 'px';
  tulipe.style.left = Math.random() * window.innerWidth + 'px';
  
  // Taille aléatoire pour varier les tulipes
  const size = Math.random() * 20 + 20; // Taille entre 20px et 40px
  tulipe.style.width = `${size}px`;
  tulipe.style.height = `${size}px`;

  // Durée aléatoire pour rendre l'animation unique pour chaque tulipe
  const duration = Math.random() * 10 + 5; // Durée entre 5s et 15s
  tulipe.style.animationDuration = `${duration}s`;

  document.querySelector('.tulipe-container').appendChild(tulipe);
}

// Générer plusieurs tulipes
for (let i = 0; i < tulipeCount; i++) {
  createTulipe();
}