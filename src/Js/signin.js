document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    // Step 1: Get form field values
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Step 2: Check for empty fields
    if (!email || !password) {
        alert('All fields are required.');
        return; // Stop the function if any field is empty
    }

    // Step 3: Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple regex for email validation
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return; // Stop the function if email is invalid
    }

    // Step 4: Submit form
    var formData = {email: email, password: password};

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/src/php/loginUser.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log('Status Code:', xhr.status); // Log status code
            console.log('Status Text:', xhr.statusText); // Log status text
            console.log('Response Text:', xhr.responseText); // Log response text

            if (xhr.status == 200) {
                // Redirect to home page
                window.location.href = '/src/modules/acceuil.html';
            } else {
                // Handle error case
                alert('Error with request: ' + xhr.statusText);
            }
        }
    };

    xhr.send(JSON.stringify(formData));
});