document.getElementById('registrationForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting until validation is complete

  // Step 1: Get form field values
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var pronoun = document.getElementById('pronoun').value;

  // Step 2: Check for empty fields
  if (!name || !email || !password || !confirmPassword ||  !pronoun ) {
      alert('All fields are required.');
      return; // Stop the function if any field is empty
  }

  // Step 3: Validate email format
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple regex for email validation
  if (!emailRegex.test(email)) {
      alert('Please enter a valid email address.');
      return; // Stop the function if email is invalid
  }

  // Step 4: Check password criteria
  if (password.length < 8) {
      alert('Password must be at least 8 characters long.');
      return; // Stop the function if password is too short
  }

  // Step 5: Match passwords
  if (password !== confirmPassword) {
      alert('Passwords do not match.');
      return; // Stop the function if passwords don't match
  }

  // Step 6: Submit form
  var formData = {name: name, email: email, password: password, pronoun: pronoun};

  var xhr = new XMLHttpRequest();
  xhr.open('POST', '/src/php/registerUser.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'error') {
              alert(response.message); // Display error message
          } else {
            
            window.location.href = "/src/modules/acceuil.html" ;

          }
      }
  };
  xhr.send(JSON.stringify(formData));

 
});
