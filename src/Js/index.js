
window.onload = function() {
    // Everything is fully loaded now
    const logo = document.getElementById('cy-logo');
    if (logo) {
        logo.addEventListener('click', () => {
            window.location.href = 'acceuil.html';
        });
    }
  
    const logoText = document.getElementById('cy-play-logo-Text');
    if (logoText) {
        logoText.addEventListener('click', () => {
            window.location.href = 'contact.html';
        });
    }
  };
  
  document.querySelectorAll('skew-menu').forEach(item => {
      item.addEventListener('mouseenter', () => {
          const dropdown = item.querySelector('.dropdown-content');
          dropdown.style.display = 'block';
      });
  
      item.addEventListener('mouseleave', () => {
          const dropdown = item.querySelector('.dropdown-content');
          dropdown.style.display = 'none';
      });
  });
  