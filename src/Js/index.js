
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
  
// Query all 'li' elements within elements with the class 'skew-menu'
document.querySelectorAll('.skew-menu li').forEach(item => {
    // Add a 'mouseenter' event listener to each 'li' element
    item.addEventListener('mouseenter', () => {
        // Find the '.dropdown-content' within the hovered 'li' and show it
        const dropdown = item.querySelector('.dropdown-content');
        dropdown.style.display = 'block';
    });

    // Add a 'mouseleave' event listener to each 'li' element
    item.addEventListener('mouseleave', () => {
        // Find the '.dropdown-content' within the hovered 'li' and hide it
        const dropdown = item.querySelector('.dropdown-content');
        dropdown.style.display = 'none';
    });
});