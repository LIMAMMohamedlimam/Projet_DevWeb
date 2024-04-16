
// function that fetches the product available in the data base using the product availible php file
function fetchProducts(category) {
  fetch(`/src/php/fetch_product.php?category=${encodeURIComponent(category)}`)
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.json();
  })
  .then(data => {
      const productList = document.querySelector('.Product-list');
      console.log(data.legnth);
      // Check if there is valid data
      if (data.legnth !== 0) {
            // Clear the innerHtml of the div
          productList.innerHTML = ''; // Clear the list before adding new products
          data.forEach(productData => {
              productList.innerHTML += `
                  <li class="product">
                      <picture class="image">
                          <img id="product-image" src="${productData.imagelink}" alt="${productData.name}">
                      </picture>
                      <div class="info">
                          <h2 class="title">${productData.name}</h2>
                          <p class="description">${productData.description}</p>
                      </div>
                  </li>
              `;
          });
      }else if (data.legnth === 0){
          productList.innerHTML = '';
          productList.innerHTML = `
          <div class="no-products">
              <h2>No products available in this category</h2>
          </div>
          `;
      }
  })
  .catch(error => {
      console.error('Error fetching product data:', error);
  });
}

document.addEventListener('DOMContentLoaded', () => {
    // Select all <a> tags that have a data attribute 'data-category'
    const categoryLinks = document.querySelectorAll('a[category-name]');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            const category = this.getAttribute('category-name'); // Get the category from the data attribute
            fetchProducts(category); // Fetch products for this category
        });
    });
});



