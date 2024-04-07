document.getElementById('registrationForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting until validation is complete
  alert("hello");
  // Step 1: Get form field values
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var pronoun = document.getElementById('pronoun').value;

  // Step 2: Check for empty fields
  if (!name || !email || !password || !confirmPassword ) {
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
  // If all checks pass, submit the form. You might do this by sending an AJAX request to your PHP script, or you might allow the form to submit normally.
  // For this example, we'll just log a message and then submit the form normally.
  console.log('Validation passed. Submitting form...');
  console.log(name) // This refers to the form element, and submit() is the form's submit action
});
