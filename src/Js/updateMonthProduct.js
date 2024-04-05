
document.addEventListener('DOMContentLoaded', function() {
    fetchMonthProduct();

    // Optionally, you can have a button or some other event trigger this function
    function fetchMonthProduct() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/src/php/fetch_month_product.php', true);
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Assuming the PHP script returns a JSON object with product details
                var product = JSON.parse(this.responseText);
                updateProductDisplay(product);
            }
        };
        xhr.send();
    }

    function updateProductDisplay(product) {
        document.getElementById('month-product-image').src = product.image_link;
        document.getElementById('month-product-image').alt = product.name;
        document.getElementById('month-product-name').textContent = product.name;
        document.getElementById('month-product-description').textContent = product.description;
    }
});

