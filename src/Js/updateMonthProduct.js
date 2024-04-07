
document.addEventListener('DOMContentLoaded', function() {
   

function fetchAndUpdateProduct() {
        fetch('/src/php/fetch_month_product.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        return response.json();
        
    })
            
            .then(data => {
                // Ensure the data contains the product details
              
                if(data.name && data.description && data.imagelink) {
                    document.getElementById('month-product-name').textContent = data.name;
                    document.getElementById('month-product-description').textContent = data.description;
                    document.getElementById('month-product-image').src = data.imagelink;
                } else {
                    console.error('No product data found');
                }
            })
            .catch(error => {
                console.error('Error fetching product data:', error);
            });
    }
    
    // Call the function immediately to update the product details when the page loads
    fetchAndUpdateProduct();
    
    
})    